<?php

namespace App\Http\Controllers;

use App\Models\Bareme;
use Illuminate\Http\Request;

class BaremeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $baremes = Bareme::when($search, function ($query, $search) {
            return $query->where('pays', 'like', '%' . $search . '%');
        })->paginate(10);
        return view('baremes.index', compact('baremes', 'search'));
    }
    public function show(Bareme $bareme)
    {
        return view('baremes.show', compact('bareme'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'pays' => 'required',
            'currency' => 'required',
            'meal_cost' => 'nullable|numeric',
            'accomodation_cost' => 'nullable|numeric',
            'pays_per_day' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $meal_cost = $request->input('meal_cost');
                    if ($meal_cost) {
                        $accomodation_cost = $request->input('accomodation_cost');
                        if ($value != ($meal_cost * 2 + $accomodation_cost)) {
                            $fail("la somme de deux repas et d'un logement doit être égale au salaire par jour");
                        }
                    }
                },
            ],
        ]);

        Bareme::create($request->all());

        return redirect()->route('baremes.index');
    }
    public function update(Request $request, Bareme $bareme)
    {
        $request->validate([
            'pays' => 'required',
            'currency' => 'required',
            'meal_cost' => 'nullable|numeric',
            'accomodation_cost' => 'nullable|numeric',
            'pays_per_day' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $meal_cost = $request->input('meal_cost');
                    if ($meal_cost) {
                        $accomodation_cost = $request->input('accomodation_cost');
                        if ($value != ($meal_cost * 2 + $accomodation_cost)) {
                            $fail("la somme de deux repas et d'un logement doit être égale au salaire par jour");
                        }
                    }
                },
            ],
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

