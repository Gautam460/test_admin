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
    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="logo">Logo:</label>
                <input type="file" id="logo" name="logo">
        @if ($company->logo)
            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" width="50">
        @endif
            </div>

            <div class="form-group">
                <label for="website">Website:</label>
                <input type="text" name="website" id="website" value="{{ old('website', $company->website) }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Create Company</button>
        </form>
    


</div>
</div>
@include('auth.include.footer')