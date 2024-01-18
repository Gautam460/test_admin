<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use Validator;
class ApiController extends Controller
{

//	Create api to get company details by id

    public function show(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 0, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
    }

    try {
        $id = $request->id;
        $company = Company::findOrFail($id);
        
        $logoPath = $company->logo;
         // Get the public URL using public_path
         $logoUrl = url('storage/'.$logoPath);
         $company['logo'] = $logoUrl;
        $response = [
            'status' => 1,
            'message' => 'Success',
            'data' => $company,
        ];

        return response()->json($response);
    } catch (ModelNotFoundException $e) {
        return response()->json(['status' => 0, 'message' => 'Company not found'], 404);
    } catch (\Exception $e) {
        // Handle other exceptions if needed
        return response()->json(['status' => 0, 'message' => 'An error occurred'], 500);
    }
}

     // 	Create api to add company
      public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'nullable|email|unique:employees,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }

        try {
            $companyEmail = Company::where('email', $request->email)->first();
            if($companyEmail){
                return response()->json(['status' => 0, 'message' => 'Validation Error', 'errors' => 'Already Email Exits please change Email'], 422);
            } 
            $data = $request->all();

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('public/logos');
        $data['logo'] = $request->file('logo')->store('logos');//$logoPath;
    }

    
            $company = Company::create($data);
            $logoPath = $company->logo;
            $logoUrl = url('storage/'.$logoPath);
            $company['logo'] = $logoUrl;
            return response()->json(['status' => 1, 'message' => 'Company added successfully', 'data' => $company], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    //Create api to get all Employee of a company by its ID

    public function get_employee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
        }
        $companyId =$request->company_id;
        try {
            $employees = Employee::where('company_id', $companyId)->get();

            return response()->json(['status' => 1, 'message' => 'Employees retrieved successfully', 'data' => $employees]);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

//	Create api to add employee in the company
    public function store_employee(Request $request)
{
    try {
    $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'nullable|email|unique:employees,email',
        'phone' => 'nullable',
        'company_id' => 'required',
        // Add more validation rules as needed
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 0, 'message' => 'Validation Error', 'errors' => $validator->errors()], 422);
    }
    $company = Company::where('id', $request->company_id)->first();

            if ($company) {
                $employeeData = $request->all();
                $employee = Employee::create($employeeData);

                return response()->json(['status' => 1, 'message' => 'Employee added successfully', 'data' => $employee], 201);
            } else {
                return response()->json(['status' => 0, 'message' => 'Failed to Company Id Not Validate. Company not found.', 'data' => null], 404);
            }
    } catch (\Exception $e) {
        return response()->json(['status' => 0, 'message' => 'An error occurred', 'error' => $e->getMessage()], 500);
    }
}
}

