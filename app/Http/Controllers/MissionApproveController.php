<?php

namespace App\Http\Controllers;

use App\Models\MissionApprove;
use App\Models\MissionOrder;
use Illuminate\Http\Request;

class MissionApproveController extends Controller
{
    public function supervisor_approve(MissionOrder $missionOrder)
    {
        if ($missionOrder->approvals->where('approval_role', '=', 'supervisor')->first()) {
            $missionApprove = $missionOrder->approvals->where('approval_role', '=', 'supervisor')->first();
            //return view('mission_approves.edit', compact('missionApprove', 'missionOrder'));
            return redirect()->route('mission_approves.edit', ['mission_approve' => $missionApprove]);
        }
        return view('mission_approves.create', compact('missionOrder'));
    }
    public function hr_approve(MissionOrder $missionOrder)
    {
        if ($missionOrder->approvals->where('approval_role', '=', 'hr')->first()) {
            $missionApprove = $missionOrder->approvals->where('approval_role', '=', 'hr')->first();
            //return view('mission_approves.edit', compact('missionApprove', 'missionOrder'));
            return redirect()->route('mission_approves.edit', ['mission_approve' => $missionApprove]);
        }
        return view('mission_approves.create', compact('missionOrder'));
    }
    public function sg_approve(MissionOrder $missionOrder)
    {
        if ($missionOrder->approvals->where('approval_role', '=', 'sg')->first()) {
            $missionApprove = $missionOrder->approvals->where('approval_role', '=', 'sg')->first();
            //return view('mission_approves.edit', compact('missionApprove', 'missionOrder'));
            return redirect()->route('mission_approves.edit', ['mission_approve' => $missionApprove]);
        }
        return view('mission_approves.create', compact('missionOrder'));
    }
    public function index()
    {
        $approvals = MissionApprove::with('missionOrder', 'employee')->get();
        return view('mission_approves.index', compact('approvals'));
    }

    public function show(MissionApprove $missionApprove)
    {
        return view('mission_approves.show', compact('missionApprove'));
    }
    public function create()
    {
        $missionOrders = MissionOrder::all();
        return view('mission_approves.create', compact('missionOrders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:sup_approve,hr_approve,sg_approve,rejected,draft',
        ]);
        $missionOrderId = $request->input('mission_order_id');
        $missionOrder = MissionOrder::find($missionOrderId);
        $missionOrder->status = $request->input('status');
        $missionOrder->save();
        MissionApprove::create($request->all());
        return redirect()->route('mission_orders.index');
    }

    public function edit(MissionApprove $missionApprove)
    {
        return view('mission_approves.edit', compact('missionApprove'));
    }

    public function update(Request $request, MissionApprove $missionApprove)
    {
        $request->validate([
            'status' => 'required|in:sup_approve,hr_approve,sg_approve,rejected,draft',
        ]);

        $missionApprove->missionOrder->status = $request->input('status');
        $missionApprove->missionOrder->save();
        $missionApprove->update($request->all());
        $missionApprove->save();
        return redirect()->route('mission_orders.index');
    }

    public function destroy(MissionApprove $missionApprove)
    {
        $missionApprove->delete();

        return redirect()->route('mission_approves.index');
    }
}
