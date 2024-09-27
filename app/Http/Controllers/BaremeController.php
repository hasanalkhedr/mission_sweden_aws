<?php

namespace App\Http\Controllers;

use App\Models\Bareme;
use Illuminate\Http\Request;

class BaremeController extends Controller
{
    public function index()
    {
        $baremes = Bareme::all();
        return view('baremes.index', compact('baremes'));
    }
    public function show(Bareme $bareme)
    {
        return view('baremes.show', compact('bareme'));
    }
    public function create()
    {
        return view('baremes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pays' => 'required',
            'currency' => 'required',
            'pays_per_day' => 'required|numeric',
        ]);

        Bareme::create($request->all());

        return redirect()->route('baremes.index');
    }

    public function edit(Bareme $bareme)
    {
        return view('baremes.edit', compact('bareme'));
    }

    public function update(Request $request, Bareme $bareme)
    {
        $request->validate([
            'pays' => 'required',
            'currency' => 'required',
            'pays_per_day' => 'required|numeric',
        ]);

        $bareme->update($request->all());

        return redirect()->route('baremes.index');
    }

    public function destroy(Bareme $bareme)
    {
        $bareme->delete();

        return redirect()->route('baremes.index');
    }
}

