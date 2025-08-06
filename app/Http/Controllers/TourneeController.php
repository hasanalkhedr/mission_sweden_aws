<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Bareme;
use App\Models\Tournee;
use App\Models\User;
use App\Notifications\MemoireTourneeLevelNotification;
use App\Notifications\TourneeLevelNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class TourneeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = auth()->user()->employee->role;
        switch ($role) {
            case 'employee':
                $tournees = Tournee::where('employee_id', '=', auth()->user()->employee->id)->when($search, function ($query, $search) {
                    return $query->where('order_number', 'like', '%' . $search . '%')->orWhere('purpose', 'like', '%' . $search . '%');
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case 'supervisor':
                $tournees = Tournee::whereHas('employee', function ($query) {
                    $query->where('department_id', auth()->user()->employee->department_id);
                })->when($search, function ($query, $search) {
                    return $query->where('order_number', 'like', '%' . $search . '%')->orWhere('purpose', 'like', '%' . $search . '%');
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case 'hr':
            case 'sg':
                $tournees = Tournee::when($search, function ($query, $search) {
                    return $query->where('order_number', 'like', '%' . $search . '%')->orWhere('purpose', 'like', '%' . $search . '%');
                })->orderBy('id', 'desc')->paginate(10);
                break;
            default:
                $tournees = null;
                break;
        }
        return view('tournees.index', compact('tournees', 'search'));
    }
    public function show(Tournee $tournee)
    {
        if (
            (auth()->user()->employee->role == 'supervisor' && $tournee->employee->department_id != auth()->user()->employee->department_id)
            || (auth()->user()->employee->role == 'employee' && $tournee->employee->id != auth()->user()->employee->id)
        ) {
            abort(404);
        } else {
            return view('tournees.show', compact('tournee'));
        }
    }
    public function showReport($id)
    {
        $tournee = Tournee::findOrFail($id);

        return view('tournees.tournee_report', compact('tournee'));
    }
    public function create()
    {
        if (auth()->user()->employee->allow_order) {
            $bareme = Bareme::where('pays', '=', 'LIBAN')->limit(1)->get();
            $tour_number = Tournee::generateOrderNumber();
            return view('tournees.create', compact('bareme', 'tour_number'));
        } else {
            return abort(403, 'You are not authorized to do this');
        }
    }
    public function store(Request $request, Tournee $tournee)
    {
        $request->validate([
            //'order_date' => 'required|date|before_or_equal:start_date',
            'employee_id' => 'required',
            'purpose' => 'required',
            'arrive_location' => 'required',
            'departure_location' => 'required',

            'bareme_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'charge' => 'required',
            'ijm' => 'required',

        ]);
        $action = $request->input('action');
        $status = '';
        if ($action === 'draft') {
            $status = 'draft';
        } else if ($action === 'submit') {
/*            switch (Auth::user()->employee->role) {
                case 'employee':
                    $status = 'sup_approve';
                    break;
                case 'supervisor':
                    $employee_dep_id = Auth::user()->employee->department_id;
                    $sg_dep_id = array_column(Department::where('name', 'like', 'Secrétariat Général')
                        ->get('id')->toArray(), 'id');
                    if (!in_array($employee_dep_id, $sg_dep_id))
                        $status = 'hr_approve';
                    else {
                        $status = 'sg_approve';
                    }
                    break;
                case 'hr':
                    $status = 'sg_approve';
                    break;
                case 'sg':
                    $status = 'sg_approve';
                    break;
            }
*/
$status = 'approved';
      }
        $tournee = Tournee::create(array_merge($request->all(), ['status' => $status]));
        $notification = new TourneeLevelNotification($tournee);
        switch ($tournee->status) {
            case 'sup_approve':
                $tournee->employee->department->manager->user->notify($notification);
                break;
            case 'hr_approve':
                $users = User::whereHas('employee', function ($query) {
                    $query->where('role', 'hr');
                })->get();
                foreach ($users as $user) {
                    $user->notify($notification);
                }
                break;
            case 'sg_approve':
case 'approved':
                $users = User::whereHas('employee', function ($query) {
                    $query->where('role', 'sg');
                })->get();
                foreach ($users as $user) {
                    $user->notify($notification);
                }
                break;
        }
        return redirect()->route('tournees.index');
    }
    public function edit(Tournee $tournee)
    {
        if ($tournee->employee_id == auth()->user()->employee->id) {
            $bareme = Bareme::where('pays', '=', 'LIBAN')->limit(1)->get();
            return view('tournees.edit', compact('tournee', 'bareme'));
        } else {
            return abort(403, 'Unauthorized Action, you are not allowed to modify other employees tournees');
        }
    }
    public function update(Request $request, Tournee $tournee)
    {
        $request->validate([
            //'order_date' => 'required|date|before_or_equal:start_date',
            'employee_id' => 'required',
            'purpose' => 'required',
            'arrive_location' => 'required',
            'departure_location' => 'required',

            'bareme_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'charge' => 'required',
            'ijm' => 'required',
        ]);
        $action = $request->input('action');
        $status = '';
        if ($action === 'draft') {
            $status = 'draft';
        } else if ($action === 'submit') {
        /*    switch (Auth::user()->employee->role) {
                case 'employee':
                    $status = 'sup_approve';
                    break;
                case 'supervisor':
                    $employee_dep_id = Auth::user()->employee->department_id;
                    $sg_dep_id = array_column(Department::where('name', 'like', 'Secrétariat Général')
                        ->get('id')->toArray(), 'id');
                    if (!in_array($employee_dep_id, $sg_dep_id))
                        $status = 'hr_approve';
                    else {
                        $status = 'sg_approve';
                    }
                    break;
                case 'hr':
                    $status = 'sg_approve';
                    break;
                case 'sg':
                    $status = 'sg_approve';
                    break;
            }*/
$status = 'approved';
        }
        $tournee->update(array_merge($request->all(), ['status' => $status]));
        $notification = new TourneeLevelNotification($tournee);
        switch ($tournee->status) {
            case 'sup_approve':
                $tournee->employee->department->manager->user->notify($notification);
                break;
            case 'hr_approve':
                $users = User::whereHas('employee', function ($query) {
                    $query->where('role', 'hr');
                })->get();
                foreach ($users as $user) {
                    $user->notify($notification);
                }
                break;
            case 'sg_approve':
case 'approved':
 $users = User::whereHas('employee', function ($query) {
                    $query->where('role', 'sg');
                })->get();
                foreach ($users as $user) {
                    $user->notify($notification);
                }
                break;
        }
        return redirect()->route('tournees.index');
    }
    public function changeDates(Request $request, Tournee $tournee)
    {
        $request->validate([
            'order_date' => 'required|date|before_or_equal:start_date',
            'start_date' => 'required|date|after:order_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);
        $tournee->update($request->all());
        return redirect()->route('mission_orders.show',$tournee->id);
    }
    public function destroy(Tournee $tournee)
    {
        $tournee->delete();

        return redirect()->route('tournees.index');
    }
    public function m_index(Request $request)
    {
        $search = $request->input('search');
        $role = auth()->user()->employee->role;
        switch ($role) {
            case 'employee':
                $tournees = Tournee::where('employee_id', '=', auth()->user()->employee->id)
                    ->where('status', 'like', 'approved')->when($search, function ($query, $search) {
                        return $query->where('order_number', 'like', '%' . $search . '%')->orWhere('purpose', 'like', '%' . $search . '%');
                    })->orderBy('id', 'desc')->paginate(10);
                break;
            case 'supervisor':
                $tournees = Tournee::whereHas('employee', function ($query) {
                    $query->where('department_id', auth()->user()->employee->department_id);
                })->where('status', 'like', 'approved')->when($search, function ($query, $search) {
                    return $query->where('order_number', 'like', '%' . $search . '%')->orWhere('purpose', 'like', '%' . $search . '%');
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case 'hr':
            case 'sg':
                $tournees = Tournee::when($search, function ($query, $search) {
                    return $query->where('order_number', 'like', '%' . $search . '%')->orWhere('purpose', 'like', '%' . $search . '%');
                })->where('status', 'like', 'approved')->orderBy('id', 'desc')->paginate(10);
                break;
            default:
                $tournees = null;
                break;
        }
        return view('tournees.m_index', compact('tournees', 'search'));
    }
    public function m_show(Request $request, Tournee $tournee)
    {
        if (
            (auth()->user()->employee->role == 'supervisor' && $tournee->employee->department_id != auth()->user()->employee->department_id)
            || (auth()->user()->employee->role == 'employee' && $tournee->employee->id != auth()->user()->employee->id)
        ) {
            abort(404);
        } else {
            return view('tournees.m_show', compact('tournee'));
        }
    }
    public function m_create(Request $request, Tournee $tournee)
    {
        return view('tournees.m_create', compact('tournee'));
    }
    public function m_edit(Request $request, Tournee $tournee)
    {

    }
    public function m_update(Request $request, Tournee $tournee)
    {
        $request->validate([
            'no_ded_accomodation' => 'required|numeric',
            'no_ded_meals' => 'required|numeric',
            'advance' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'memor_date' => 'required|date|after_or_equal:end_date',

        ]);
        $action = $request->input('action');
        $memor_status = null;
        if ($action === 'partialSubmit') {
            $tournee->update($request->all());
            return redirect()->route('mission_orders.m_create', $tournee);
        } else
        if ($action === 'draft') {
            $memor_status = 'draft';
        } else if ($action === 'submit') {
           /* switch (Auth::user()->employee->role) {
                case 'employee':
                    $memor_status = 'sup_approve';
                    break;
                case 'supervisor':
                    $employee_dep_id = Auth::user()->employee->department_id;
                    $sg_dep_id = array_column(Department::where('name', 'like', 'Secrétariat Général')
                        ->get('id')->toArray(), 'id');
                    if (!in_array($employee_dep_id, $sg_dep_id))
                        $memor_status = 'hr_approve';
                    else {
                        $memor_status = 'sg_approve';
                    }
                    break;
                case 'hr':
                    $memor_status = 'sg_approve';
                    break;
                case 'sg':
                    $memor_status = 'sg_approve';
                    break;
            }*/
$memor_status = 'approved';
        }
        $tournee->update(array_merge($request->all(), ['memor_status' => $memor_status]));

        $notification = new MemoireTourneeLevelNotification($tournee);
        switch ($tournee->memor_status) {
            case 'sup_approve':
                $tournee->employee->department->manager->user->notify($notification);
                break;
            case 'hr_approve':
                $users = User::whereHas('employee', function ($query) {
                    $query->where('role', 'hr');
                })->get();
                foreach ($users as $user) {
                    $user->notify($notification);
                }
                break;
            case 'sg_approve':
case 'approved':
 $users = User::whereHas('employee', function ($query) {
                    $query->where('role', 'sg');
                })->get();
                foreach ($users as $user) {
                    $user->notify($notification);
                }
                break;
        }

        return redirect()->route('tournees.m_index');
    }
    public function m_report(Request $request, Tournee $tournee)
    {
        return view('tournees.memoire_report', compact('tournee'));
    }
    public function m_destroy(Request $request, Tournee $tournee)
    {
        $tournee->expenses()->delete();
        $tournee->update([
            'no_ded_accomodation' => 0,
            'no_ded_meals' => 0,
            'advance' => 0,
            'total_amount' => 0,
            'memor_status' => null,
        ]);
        return redirect()->route('mission_orders.m_index');
    }
}
