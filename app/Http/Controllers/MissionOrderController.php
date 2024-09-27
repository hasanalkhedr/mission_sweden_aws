<?php

namespace App\Http\Controllers;

use App\Models\MissionOrder;
use App\Models\Bareme;
use App\Models\Employee;
use Illuminate\Http\Request;

class MissionOrderController extends Controller
{
    public function index()
    {
        $role = auth()->user()->employee->role;
        switch ($role) {
            case 'employee':
                $missionOrders = MissionOrder::where('employee_id', '=', auth()->user()->employee->id)->get();
                break;
            case 'supervisor':
                $missionOrders = MissionOrder::whereHas('employee', function ($query) {
                    $query->where('department_id', auth()->user()->employee->department_id);
                })->get();
                break;
            case 'hr':
            case 'sg':
                $missionOrders = MissionOrder::all();
                break;
            default:
                $missionOrders = null;
                break;
        }
        return view('mission_orders.index', compact('missionOrders'));
    }
    /*public function hrIndex(Request $request)
    {
        return view('dashboard');
    }
    public function sgIndex(Request $request)
    {
        return view('dashboard');
    }*/
    public function show(MissionOrder $missionOrder)
    {
        if((auth()->user()->employee->role == 'supervisor' && $missionOrder->employee->department_id != auth()->user()->employee->department_id)
        || (auth()->user()->employee->role == 'employee'&&$missionOrder->employee->id != auth()->user()->employee->id))
        {
            abort(404);
        } else {
            return view('mission_orders.show', compact('missionOrder'));
        }
    }


public function showReport($id)
{
    $missionOrder = MissionOrder::findOrFail($id);

    return view('mission_orders.mission_order_report', compact('missionOrder'));
}

    public function create()
    {
        $baremes = Bareme::all();
        return view('mission_orders.create', compact('baremes'));
    }

    public function store(Request $request, MissionOrder $missionOrder)
    {
        $request->validate([


            'employee_id' => 'required',
            'purpose' => 'required',
            'description' => 'required',
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

        MissionOrder::create($request->all());
        return redirect()->route('mission_orders.index');
    }

    public function edit(MissionOrder $missionOrder)
    {
        if ($missionOrder->employee_id == auth()->user()->employee->id) {
            $baremes = Bareme::all();
            return view('mission_orders.edit', compact('missionOrder', 'baremes'));
        } else {
            return abort(403, 'Unauthorized Action, you are not allowed to modify other employees missions');
        }
    }

    public function update(Request $request, MissionOrder $missionOrder)
    {
        $request->validate([
            'employee_id' => 'required',
            'purpose' => 'required',
            'description' => 'required',
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

        $missionOrder->update($request->all());

        return redirect()->route('mission_orders.index');
    }

    public function destroy(MissionOrder $missionOrder)
    {
        $missionOrder->delete();

        return redirect()->route('mission_orders.index');
    }
}
