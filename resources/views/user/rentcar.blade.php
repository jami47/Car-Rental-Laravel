<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Rent Car</title>
    <style>
        .form-container form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1rem;
            /* position: absolute;
            bottom: 4rem;
            left: 100px; */
            background: #fff;
            padding: 20px;
            border-radius: 0.5rem;
        }
        .input-box {
            flex: 1 1 1 7rem;
            display: flex;
            flex-direction: column;
        }
        .input-box span {
            font-weight: 500;
        }
        .input-box input {
            padding: 7px;
            outline: none;
            border: none;
            background: #eeeff1;
            border-radius: 0.5rem;
            font-size: 1rem;
        }
        .form-container form .btn {
            flex: 1 1 7rem;
            padding: 10px 34px ;
            border: none;
            border-radius: 0.5rem;
            background: #474fa0;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
        }
        .form-container form .btn:hover {
            background: var(--main-color);
        }
    </style>
</head>
<body style="margin-left: 1rem; margin-right: 1rem; margin-top: 1rem; background-color: #009d63;">


    <div class="" align="center">
        <img src="{{ asset('images/cars/' . $car->img) }}" alt="{{ $car->name }}" style="width: 20rem; border-radius: 1rem;">
        <h1>{{ $car->name }}</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center" style="margin-top: 1rem">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Car Information</div>

                    <div class="card-body">
                        <p><strong>Nameplate:</strong> {{ $car->nameplate }}</p>
                        <p><strong>Price:</strong> {{ $car->price }}</p>
                        <p><strong>Rent:</strong> {{ $car->ratepd }}</p>
                        <p><strong>Year:</strong> {{ $car->year }}</p>
                        {{-- <div class="" align="center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rentModal">
                                Rent
                            </button>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="" align="center" style="margin-top: 2rem">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rentModal">
            Rent
        </button>
    </div>

    <!-- Modal -->
        <div class="modal fade" id="rentModal" tabindex="-1" aria-labelledby="rentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="rentModalLabel">Rent Car</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-container">
                                <form action="{{ route('home.addrent', ['car' => $car/* ->id */]) }}" id="rent-form" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-box">
                                        <span>Location</span>
                                        <input type="search" id="location" placeholder="Search Places" name="location">
                                    </div>
                                    <div class="input-box">
                                        <span>Pick-Up Date</span>
                                        <input type="date" id="start-date" name="start_date" value="{{-- {{ date('Y-m-d') }} --}}">
                                    </div>
                                    <div class="input-box">
                                        <span>Return Date</span>
                                        <input type="date" id="end-date" name="end_date" value="{{-- {{ date('Y-m-d') }} --}}">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" class="btn btn-primary" onclick="submitRentForm()">Confirm</button>
                        <button type="button" class="btn btn-success">Buy</button>
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

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

<script>
    function submitRentForm() {
        // Get the input values
        var location = document.getElementById('location').value;
        var startDate = new Date(document.getElementById('start-date').value);
        var endDate = new Date(document.getElementById('end-date').value);

        var now = new Date();
        now.setHours(0,0,0,0);

        // Check the conditions
        if (!location) {
            alert('Location cannot be empty.');
            return;
        }
        /* if (startDate < new Date()) {
            alert('Start date must be greater than or equal to the current date.');
            document.getElementById('start-date').value = new Date();
            return;
        } */
        if (startDate.setHours(0,0,0,0) < now) {
            alert('Start date must be greater than or equal to the current date.');
            document.getElementById('start-date').valueAsDate = now;
            return;
        }
        if (endDate.setHours(0,0,0,0) <= startDate) {
            alert('End date must be greater than the start date.');
            return;
        }

        // Submit the form
        document.getElementById('rent-form').submit();
    }
</script>

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


</html>
