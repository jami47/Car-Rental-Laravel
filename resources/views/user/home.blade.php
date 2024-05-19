{{-- <a href="{{ route('logout') }}">Logout</a>
<h1>Welcome, {{ Auth::user()->username }}</h1> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Panel</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/userstyles.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="#" class="logo"><img src="{{ asset('images/cars/jeep.png') }}" alt=""></a>

        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#ride">Rides</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#reviews">Reviews</a></li>
            <li><a href="{{ route('home.return') }}">Return</a></li>
        </ul>
        <div class="header-btn">
            <a href="{{ route('logout') }}" class="sign-out">Sign Out</a>

        </div>
    </header>
    <!--! Home -->
    <section class="home" id="home">
        <div class="text">
            <h1><span>Looking</span> to <br>rent a car</h1>
            <p>Your Perfect Ride Awaits! Experience Luxury on Every Journey <br>Drive Your Dream!</p>
            <div class="app-stores">
                <img src="{{ asset('images/cars/ios.png') }}" alt="">
                <img src="{{ asset('images/cars/play.png') }}" alt="">
            </div>
        </div>

            {{-- <div style="position: absolute;
                                                    bottom: 2rem;
                                                    left: 80px;">
            <img src = "https://cdn.dribbble.com/users/966681/screenshots/2811861/media/89f3298982e10abb96d5059293ed3113.gif" width = "390" height="150" style="margin-top: 5rem; border-radius: 50px; padding: 20px;height=200px; object-fit: cover;" class="gifimg">
            </div> --}}
            <div {{-- align="center" --}} style="position: absolute;
                                                    bottom: 2rem;
                                                    left: 80px;">
            <img src = "https://cdn.dribbble.com/users/627335/screenshots/2778091/media/c3c471187fa161e2fb2fab61d1308f98.gif" width = "390" height="150" style="margin-top: 5rem; border-radius: 50px; padding: 20px;height=200px; object-fit: cover;" class="gifimg">
            </div>

        {{-- <div class="form-container">
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
                <input type="submit" name="" id="" class="btn" value="Submit">
            </form>
        </div> --}}
    </section>
    <!-- !Ride Section -->
    <section class="ride" id="ride">
        <div class="heading">
            <span>How It Works</span>
            <h1>Rent with 3 easy steps</h1>
        </div>
        <div class="ride-container">
            <div class="box">
                <i class='bx bxs-map'></i>
                <h2>Choose A Location</h2>
                <p>Select your preferred location, tailored for convenience. Choose from a wide array of options, ensuring seamless travel.</p>
            </div>

            <div class="box">
                <i class='bx bxs-calendar-check'></i>
                <h2>Pick-Up Date</h2>
                <p>Pick your desired date, ensuring optimal convenience. Select from a broad calendar, perfectly aligning with your plans.</p>
            </div>

            <div class="box">
                <i class='bx bxs-calendar-star'></i>
                <h2>Book A Car</h2>
                <p>Choose your dream vehicle, tailored for your comfort. Browse through a vast fleet, ensuring the perfect ride.</p>
            </div>
        </div>
    </section>
    <!-- !Services -->
    <section class="services" id="services">
        <div class="heading">
            <span>Best Services</span>
            <h1>Explore Our Top Deals <br> From Top Rated Dealers</h1>
        </div>
        <div class="services-container">

            {{--! Dynamic cars over here.  --}}
            @foreach ($cars as $car)
                @if($car->available == "yes")
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

                    <form method="POST" action="{{ route('home.rents', ['car' => $car]) }}">
                        @csrf
                        <button type="submit" class="btn">Rent Now</button>
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
                @endif
            @endforeach

            {{--
            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('images/cars/car1.jpg') }}" alt="">
                </div>
                <p>2017</p>
                <h3>2018 Honda Civic</h3>
                <h2>$58500 | $358 <span>/Day</span></h2>
                <a href="#" class="btn" id="">Rent Now</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('images/cars/car2.jpg') }}" alt="">
                </div>
                <p>2017</p>
                <h3>2018 Honda Civic</h3>
                <h2>$58500 | $358 <span>/month</span></h2>
                <a href="#" class="btn" id="">Rent Now</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('images/cars/car3.jpg') }}" alt="">
                </div>
                <p>2017</p>
                <h3>2018 Honda Civic</h3>
                <h2>$58500 | $358 <span>/month</span></h2>
                <a href="#" class="btn" id="">Rent Now</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('images/cars/car4.jpg') }}" alt="">
                </div>
                <p>2017</p>
                <h3>2018 Honda Civic</h3>
                <h2>$58500 | $358 <span>/month</span></h2>
                <a href="#" class="btn" id="">Rent Now</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('images/cars/car5.jpg') }}" alt="">
                </div>
                <p>2017</p>
                <h3>2018 Honda Civic</h3>
                <h2>$58500 | $358 <span>/month</span></h2>
                <a href="#" class="btn" id="">Rent Now</a>
            </div>

            <div class="box">
                <div class="box-img">
                    <img src="{{ asset('images/cars/car6.jpg') }}" alt="">
                </div>
                <p>2017</p>
                <h3>2018 Honda Civic</h3>
                <h2>$58500 | $358 <span>/month</span></h2>
                <a href="#" class="btn" id="">Rent Now</a>
            </div>
            --}}
        </div>
    </section>
    <!-- !About Section -->
    <section class="about" id="about">
        <div class="heading">
            <span>About Us</span>
            <h1>Best Customer Experience</h1>
        </div>
        <div class="about-container">
            <div class="about-img">
                <img src="{{ asset('images/cars/about.png') }}" alt="">
            </div>
            <div class="about-text">
                <span>About Us</span>
                <p>Welcome to a world of comfort, your journey starts here.  As a renowned company with a rich history, we’ve been providing exceptional service for many years. Our longevity in the industry is a testament to our commitment to excellence and customer satisfaction. We invite you to experience the difference with us.</p>
                <p>Experience the best customer service in the industry. Our commitment to quality ensures unparalleled satisfaction</p>
                <a href="https://en.wikipedia.org/wiki/Car_rental" target="_blank" class="btn" id="">Learn More</a>
            </div>
        </div>
    </section>
    <!-- !Reviews Section -->
    <section class="reviews" id="reviews">
        <div class="heading">
            <span>Reviews</span>
            <h1>What Our Customers Say</h1>
        </div>
        <div class="reviews-container">
            <div class="box">
                <div class="rev-img">
                    <img src="{{ asset('images/cars/rev1.jpg') }}" alt="">
                </div>
                <h2>Alex</h2>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half'></i>
                </div>
                <p>Absolutely fantastic, exceeded all my expectations. Reliability, customer satisfaction ensured!</p>
            </div>

            <div class="box">
                <div class="rev-img">
                    <img src="{{ asset('images/cars/rev2.jpg') }}" alt="">
                </div>
                <h2>Chris</h2>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                </div>
                <p>Simply outstanding, the service exceeded all expectations. Quality, customer satisfaction guaranteed!</p>
            </div>

            <div class="box">
                <div class="rev-img">
                    <img src="{{ asset('images/cars/rev3.jpg') }}" alt="">
                </div>
                <h2>Lucy</h2>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half'></i>
                </div>
                <p>Exceptional service, truly a memorable experience. Efficiency, customer delight achieved!</p>
            </div>

        </div>
    </section>
    <!-- !NwsLetter -->
    <section class="newsletter">
        <h2>Send Message</h2>
        <div class="box">
            <input type="text" placeholder="Enter Your Message...">
            <button class="btn" id="">Send</button>
        </div>
    </section>
    <div class="copyright">
        <p>&#169; Jami All Right Reserved</p>
        <div class="social">
            <a href="https://github.com/jami47" target="_blank"><i class='bx bxl-github'></i></a>
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
        </div>
    </div>
        {{-- @if (session('success'))
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
        @endif --}}
    <!-- !ScrollReveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    {{--! <!-- !JavaScript --> --}}
    <script src="{{ asset('js/userscripts.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        @if (session('success'))
            /* var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show(); */
            alert('Car Rented Successfully');
            @php
                session()->pull('success');
            @endphp
        @endif

        @if ($errors->any())
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    </script>
</body>
</html>
