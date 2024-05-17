@extends('layouts.admindashlayout')

@section('page-title')
    Admin Profile
@endsection

@section('body')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 13rem">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">User Information</div>

                <div class="card-body">
                    <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    {{-- <p><strong>Password:</strong> {{ Auth::user()->password }}</p> --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        Change Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('changeadpass') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
            <button type="submit" class="btn btn-primary">Update Password</button>
          </form>
        </div>
      </div>
    </div>
</div>

@if (session('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('js')
    {{-- <script>
        document.getElementById('carImage').addEventListener('change', function() {
        // Get the selected file
        var file = this.files[0];

        // Update the text display with the file name
        document.getElementById('fileNameDisplay').value = file.name;
        });
    </script> --}}
    {{-- ! Nicher jinish gula jaygamoto jate dekhay bujla, page er niche dekhaitese keno jani --}}
    {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <script>
        @if (session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif

        @if ($errors->any())
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    </script>


@endsection
