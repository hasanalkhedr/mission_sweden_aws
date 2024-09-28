<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();
        return view('employees.index', compact('employees'));
    }
    public function show(Employee $employee)
    {
        $departments = Department::all();
        $roles = [
            'employee',
            'supervisor',
            'hr',
            'sg'
        ];
        return view('employees.show', compact('employee', 'departments', 'roles'));
    }
    public function create()
    {
        $departments = Department::all();
        $roles = [
            'employee',
            'supervisor',
            'hr',
            'sg'
        ];
        return view('employees.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required',
            'department_id' => 'required',
            'role' => 'required|in:employee,supervisor,hr,sg',
            'position' => 'required',
            'administrativ_residence' => 'required',
            'service' => 'required',
            'password' => ['required', 'confirmed'],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt('password'),
        ]);

       $employee =  Employee::create(array_merge($request->all(), ['user_id' => $user->id]));
        if ($request->hasFile('profile_image')) {
            // Store the image in 'storage/app/public/profile_pictures'
            $file = $request->file('profile_image');
            $filename = $employee->full_name . '.' . $file->getClientOriginalExtension(); // e.g. 1609459200.jpeg
            $path = $file->storeAs('profile_images', $filename, 'public');

            // Save the image path to the user's profile
            $employee->profile_image = $path;
            $employee->save();
        }

        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $roles = [
            'employee',
            'supervisor',
            'hr',
            'sg'
        ];
        return view('employees.edit', compact('employee', 'departments', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => ['required', 'email', 'unique:employees,email,' . $employee->id],
            'phone' => 'required',
            'department_id' => 'required',
            'role' => 'required|in:employee,supervisor,hr,sg',
            'position' => 'required',
            'administrativ_residence' => 'required',
            'service' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index');
    }
}
