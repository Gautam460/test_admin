@include('auth.include.header')
@include('auth.include.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    <h1>Employee Details</h1>

    @if($employee)
        <h2>{{ $employee->first_name }}</h2>
        <h2>{{ $employee->last_name }}</h2>
        <h2>{{ $employee->company->name }}</h2>
        <h2>{{ $employee->email }}</h2>
        <h2>{{ $employee->phone }}</h2>
    @else
        <p>employee not found</p>
    @endif

</div>
</div>
@include('auth.include.footer')
