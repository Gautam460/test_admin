@include('auth.include.header')
@include('auth.include.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

        <h1>Employee List</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-success">Create Employee</a>
    </div>
    
    <div class="content">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->company->name }}</td> <!-- Assuming 'name' is the column for company name -->
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    <!-- Add more columns as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $employees->links() }}
    </div>
</div>
    @include('auth.include.footer')