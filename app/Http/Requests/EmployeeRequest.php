<?php

// app/Http/Requests/EmployeeRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic if needed
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            // Add more validation rules as needed
        ];
    }
}
