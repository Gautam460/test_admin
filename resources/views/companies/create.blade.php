@include('auth.include.header')
@include('auth.include.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class="content-header">
        <h1>Create Company</h1>
    </div>

    <div class="content">
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="logo">Logo:</label>
                <input type="file" name="logo" id="logo" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="website">Website:</label>
                <input type="text" name="website" id="website" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Create Company</button>
        </form>
    </div>
    </div>
    @include('auth.include.footer')