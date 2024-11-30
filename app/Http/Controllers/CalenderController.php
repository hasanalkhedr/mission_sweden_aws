<?php

namespace App\Http\Controllers;

use App\Models\MissionOrder;
use App\Models\Tournee;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $events = [];
        foreach (MissionOrder::all() as $mission) {
            $e = $mission->employee;
            $b = $mission->bareme;
$title = "Employee: $e->first_name $e->last_name ,\nLocation:  $b->pays ,\nObjet: $mission->purpose ";
            $events[] = [
                'title' => $title,
                'start' => $mission->start_date,
                'end' => $mission->end_date,
                'classNames' => ['bg-blue-500','text-white-700', 'text-md'],
            ];
        }
        foreach (Tournee::all() as $tournee) {
            $e = $tournee->employee;
            $b = $tournee->bareme;
$title = "Employee: $e->first_name $e->last_name ,\nLocation:  $b->pays ,\nObjet: $tournee->purpose ";
            $events[] = [
                'title' => $title,
                'start' => $tournee->start_date,
                'end' => $tournee->end_date,
                'classNames' => ['bg-green-500','text-white-700', 'text-md'],
            ];
        }

        return view('calender', compact('events'));
    }
}
