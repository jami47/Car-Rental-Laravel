{{-- @foreach ($cars as $car)
    <h1>{{ $car->name }}</h1>
@endforeach --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/userstyles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Return Car</title>
</head>
<body>
    <!-- !Services -->
    <section class="services" id="services">
        <div class="d-flex justify-content-end align-items-top text-dark pt-3">
            <!-- Check if the login route is available -->
            @if (Route::has('login'))
                <!-- Login/Register links container -->
                <div class="top-0 end-0">
                    <!-- Authentication check -->
                    @auth
                        <!-- Home link with 'fa-home' icon from Font Awesome -->
                        <a href="{{ url('/home') }}" class="text-decoration-none text-dark me-3">
                            <i class="fa fa-home"></i> Home
                        </a>
                    @endauth
                </div>
            @endif
        </div>

        <div class="heading">
            <span>Best Services</span>
            <h1>Return Cars<br> That You Rented</h1>
        </div>
        <div class="services-container">

            {{--! Dynamic cars over here.  --}}
            @foreach ($cars as $car)
                {{-- @if($car->available == "yes") --}}
                <div class="box">
                    <div class="box-img">
                        <!-- Use the 'img' attribute from the Car model -->
                        <img src="{{ asset('images/cars/' . $car->img) }}" alt="{{ $car->name }}">
                    </div>
                    <!-- Display the 'year' attribute -->
                    <p>{{ $car->year }}</p>
                    <!-- Display the 'name' attribute -->
                    <h3>{{ $car->name }}</h3>
                    <!-- Display the 'price' and 'ratepd' attributes -->
                    <h2>${{ number_format($car->price, 0) }} | ${{ number_format($car->ratepd, 0) }} <span>/Day</span></h2>
                    <!-- Assuming you have a route to rent the car -->
                    {{-- <a href="{{ route('home.rents', ['car' => $car]) }}" class="btn">Rent Now</a> --}}

                    <form method="POST" action="{{ route('home.returncar', ['car' => $car]) }}">
                        @csrf
                        <button type="submit" class="btn">Return Car</button>
                    </form>

                    {{-- <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#rentModal">Rent Now</a> --}}

                    <!-- Modal -->
                    {{-- <div class="modal fade" id="rentModal" tabindex="-1" aria-labelledby="rentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="rentModalLabel">Rent Car</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-container">
                                            <form action="">
                                                <div class="input-box">
                                                    <span>Location</span>
                                                    <input type="search" placeholder="Search Places">
                                                </div>
                                                <div class="input-box">
                                                    <span>Pick-Up Date</span>
                                                    <input type="date" >
                                                </div>
                                                <div class="input-box">
                                                    <span>Return Date</span>
                                                    <input type="date" >
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Confirm</button>
                                    <button type="button" class="btn btn-success">Buy</button>
                                    </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
                {{-- @endif --}}
            @endforeach
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
    </section>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
        @if (session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            //alert('Car Returned Successfully');
        @endif

        @if ($errors->any())
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    </script>
</body>
</html>
