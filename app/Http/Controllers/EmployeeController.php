<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {

        $employees =  Employee::paginate(10); // 10 items per page
        //Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all(); // assuming you have a Company model
        
        return view('employees.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'company_id' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            // Add more validation rules as needed
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
            // You can customize the response based on your application needs
        }
        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function show($id)
    {
        $employee = Employee::find($id);
    
        return view('employees.show', ['employee' => $employee]);
    }

    public function edit($employee)
    {
        $employee =Employee::find($employee);
        
        $companies = Company::all(); // assuming you have a Company model
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy($employee)
    {
        $employee =Employee::find($employee);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
