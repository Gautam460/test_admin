@include('auth.include.header')
@include('auth.include.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    <h1>Company Details</h1>

    @if($company)
        <h2>{{ $company->name }}</h2>
        
        @if($company->logo)
            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" width="200">
        @else
            <p>No logo available</p>
        @endif
    @else
        <p>Company not found</p>
    @endif

</div>
</div>
@include('auth.include.footer')
