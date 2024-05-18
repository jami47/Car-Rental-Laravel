
@extends('layouts.admindashlayout')

@section('page-title')
    Edit Cars
@endsection

@section('body')
    <div align="center" style="color: red">
        <h2>This is the car edit page</h2>
        <button type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#myModal">Add Car</button>
    </div>
    <div class="container-fluid px-4">
        <div class="row my-5">
            <h3 class="fs-4 mb-3">Your Cars</h3>
            <div class="col">
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">ID</th>
                            <th scope="col">Car Name</th>
                            <th scope="col">NamePlate</th>
                            <th scope="col">Price</th>
                            <th scope="col">Rent</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- <tr>
                            <th scope="row">1</th>
                            <td>Television</td>
                            <td>Jonny</td>
                            <td>$1200</td>
                            <td><button type="button" class="btn btn-success btn-sm">Update</button> <button type="button" class="btn btn-danger btn-sm">Delete</button></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Laptop</td>
                            <td>Kenny</td>
                            <td>$750</td>
                            <td><button type="button" class="btn btn-success btn-sm">Update</button> <button type="button" class="btn btn-danger btn-sm">Delete</button></td>
                        </tr> --}}

                        @foreach ($cars as $car)
                            @if($car->available == "no") {{--! If the car is sold or rented then skip the car  --}}
                                @continue;
                            @endif
                            <tr>
                                <th scope="row">{{ $car->id }}</th>
                                <td>{{ $car->name }}</td>
                                <td>{{ $car->nameplate }}</td>
                                <td>${{ $car->price }}</td>
                                <td>${{ $car->ratepd }}</td>
                                <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{ $car->id }}">Update</button> <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $car->id }}">Delete</button>
                                    <!-- Modal for deletion-->
                                    <div class="modal fade" id="deleteModal{{ $car->id }}" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('cars.destroy', $car) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                    </form>
                                                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">No</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Modal for update-->
                                    <div class="modal fade" id="updateModal{{ $car->id }}" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form id="carUpdateForm" action="{{ route('cars.update', $car) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Car</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter car name" value="{{ $car->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="img" class="form-label" >Car Image</label>
                                                            <input type="file" class="form-control" id="img" name="img" value="{{ $car->img }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="year" class="form-label" >Production Year</label>
                                                            <input type="number" class="form-control" id="year" name="year" placeholder="Enter year of production" value="{{ $car->year }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nameplate" class="form-label">Nameplate</label>
                                                            <input type="text" class="form-control" id="nameplate" name="nameplate" placeholder="Enter name plate" value="{{ $car->nameplate }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="ratepd" class="form-label">Rent per day</label>
                                                            <input type="number" class="form-control" id="ratepd" name="ratepd" placeholder="Enter rent" value="{{ $car->ratepd }}" required>
                                                          </div>
                                                        <div class="mb-3">
                                                            <label for="price" class="form-label">Price</label>
                                                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ $car->price }}" required>
                                                        </div>
                                                        <!-- Add other input fields as needed -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="submit">Ok</button>
                                                        {{-- <button class="btn btn-primary" onclick="document.getElementById('carUpdateForm').submit()">Ok</button> --}}
                                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

     {{--! Modal for Add Car --}}
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Car</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="carAddForm"  method="POST" action="/addCar" >
                        @csrf
                        <div class="mb-3">
                          <label for="carName" class="form-label" >Car Name</label>
                          <input type="text" class="form-control" id="carName" name="name" placeholder="Enter car name">
                        </div>
                        <div class="mb-3">
                          <label for="carImage" class="form-label" >Car Image</label>
                          {{-- <input type="text" class="form-control" id="carImage" name="img" placeholder="Enter car image"> --}}
                          <input type="file" class="form-control" id="carImage" name="img">
                          {{-- <input type="text" class="form-control" id="fileNameDisplay" name="img" readonly> --}}
                        </div>
                        <div class="mb-3">
                          <label for="carYear" class="form-label" >Production Year</label>
                          <input type="number" class="form-control" id="carYear" name="year" placeholder="Enter year of production">
                        </div>
                        {{-- <div class="mb-3">
                          <label for="carModel" class="form-label">Car Model</label>
                          <input type="text" class="form-control" id="carModel" placeholder="Enter car model">
                        </div> --}}
                        <div class="mb-3">
                          <label for="namePlate" class="form-label">Name Plate</label>
                          <input type="text" class="form-control" id="namePlate" name="nameplate" placeholder="Enter name plate">
                        </div>
                        <div class="mb-3">
                          <label for="ratepd" class="form-label">Rent per day</label>
                          <input type="number" class="form-control" id="ratepd" name="ratepd" placeholder="Enter rent">
                        </div>
                        <div class="mb-3">
                          <label for="price" class="form-label">Car Price</label>
                          <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                        </div>

                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="document.getElementById('carAddForm').submit()">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

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
