@include('auth.include.header')
@include('auth.include.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="content-header">
<h1>Add Employee</h1>
    </div>

    <div class="content">
    <form action="{{ route('employees.store') }}" method="post">
        @csrf <!-- CSRF token for Laravel forms -->

        <!-- First Name -->
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" class="form-control"  required>
        <br>

        <!-- Last Name -->
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" class="form-control"  required>
        <br>

        <!-- Company -->
        <label for="company_id">Company:</label>
        <select name="company_id" id="company_id" class="form-control"  required>
            <!-- Assuming you have a $companies variable containing the list of companies -->
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>
        <br>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control"  id="email">
        <br>

        <!-- Phone -->
        <label for="phone">Phone:</label>
        <input type="text" name="phone" class="form-control"  id="phone">
        <br>

        <button type="submit">Add Employee</button>
    </form>
    </div>
    </div>
    @include('auth.include.footer')