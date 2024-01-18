<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10); // 10 items per page//Company::all();
        
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required|url',
            // Add more validation rules as needed
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
            // You can customize the response based on your application needs
        }
        $data = $request->all();

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('public/logos');
        $data['logo'] = $request->file('logo')->store('logos');//$logoPath;
    }
       Company::create($data);
        return redirect()->route('companies.index')->with('success', 'Company created successfully');
    }
    public function show($id)
    {
        $company = Company::find($id);
    
        return view('companies.show', ['company' => $company]);
    }
    public function edit($company)
    {
        $company =Company::find($company);
       
        return view('companies.edit', ['company' => $company]);
    }

    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required|url',
            // Add more validation rules as needed
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
            // You can customize the response based on your application needs
        }
        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    public function destroy($company)
    {
        $company =Company::find($company);
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}
