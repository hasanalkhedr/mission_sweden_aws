<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\MissionOrder;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('missionOrder')->get();
        return view('expenses.index', compact('expenses'));
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }
    public function create()
    {
        $missionOrders = MissionOrder::all();
        return view('expenses.create', compact('missionOrders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mission_order_id' => 'required',
            'amount' => 'required|numeric',
            'currency' => 'required',
            'description' => 'required',
            'document' => 'required|file',
        ]);

        $documentPath = $request->file('document')->store('documents');

        Expense::create(array_merge($request->all(), ['document' => $documentPath]));

        return redirect()->route('expenses.index');
    }

    public function edit(Expense $expense)
    {
        $missionOrders = MissionOrder::all();
        return view('expenses.edit', compact('expense', 'missionOrders'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'mission_order_id' => 'required',
            'amount' => 'required|numeric',
            'currency' => 'required',
            'description' => 'required',
            'document' => 'nullable|file',
        ]);

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents');
            $expense->update(array_merge($request->all(), ['document' => $documentPath]));
        } else {
            $expense->update($request->all());
        }

        return redirect()->route('expenses.index');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index');
    }
}
