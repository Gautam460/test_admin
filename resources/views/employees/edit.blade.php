@include('auth.include.header')
@include('auth.include.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
@if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('employees.update', $employee->id) }}" method="post">
        @csrf <!-- CSRF token for Laravel forms -->
        @method('PUT')
        <!-- First Name -->
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $employee->first_name) }}"  required>
        <br>

        <!-- Last Name -->
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}"  required>
        <br>

        <!-- Company -->
        <label for="company_id">Company:</label>
        <select name="company_id" id="company_id" class="form-control" required>
            <!-- Assuming you have a $companies variable containing the list of companies -->
            @foreach($companies as $company)
        <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>
            {{ $company->name }}
        </option>
    @endforeach
        </select>
        <br>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" id="email">
        <br>

        <!-- Phone -->
        <label for="phone">Phone:</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}"  id="phone">
        <br>

        <button type="submit">Add Employee</button>
    </form>
    
</div>
</div>
@include('auth.include.footer')