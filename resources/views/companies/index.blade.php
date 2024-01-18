@include('auth.include.header')
@include('auth.include.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

        <h1>Companies</h1>
        <a href="{{ route('companies.create') }}" class="btn btn-success">Create Company</a>
    </div>
    
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            @if($company->logo)
                            <!-- Displaying the image in a Blade view -->
                    <img src="{{ asset('storage/'.$company->logo) }}" alt="Company Logo" width="50">

                            @else
                                No Logo
                            @endif
                        </td>
                        <td>{{ $company->website }}</td>
                        <td>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $companies->links() }}
    </div>
</div>
    @include('auth.include.footer')