@extends('layouts.admindashlayout')

@section('page-title')
    Used Cars
@endsection

@section('body')
    <div align="center" style="color: red">
        <h2>This is the used cars page</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4" style="margin-left: 1rem; margin-right:1rem; margin-top: 1.1rem;">

        @foreach ($cars as $car)
            <div class="col">
                <div class="card h-100" style="border-radius: 30px; box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;">
                    <img src="{{ $car->image }}" class="card-img-top hover-zoom" alt="..." style="border-radius: 50px; padding: 20px;height=200px; object-fit: cover;">
                    <h5 class="text-center">{{ $car->title }}</h5>
                    <div class="card-body flex-grow-1 d-flex flex-column" style="padding: 25px; margin-top: -15px;">
                        <div class="mt-auto">
                            <h6>Production Year: {{ $car->start_production }}</h6>
                            <h6>Class: {{ $car->class }}</h6>
                        </div>
                        {{-- <h5 class="card-title">Car Name</h5> --}}
                        {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col">
          <div class="card h-100" style="border-radius: 30px; box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;">
            <img src="{{ asset('images/login/login47.jpg') }}" class="card-img-top" alt="..." style="border-radius: 50px; padding: 20px;">
            <h5 class="text-center">Car Name</h5>
            <div class="card-body" style="padding: 25px; margin-top: -15px;">
                <h6>Production Year: Year</h6>
                <h6>Class: </h6>
              {{-- <h5 class="card-title">Car Name</h5> --}}
              {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
            </div>
          </div>
        </div>
        {{-- <div class="col">
          <div class="card h-100">
            <img src="{{ asset('images/login/login47.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a short card.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="{{ asset('images/login/login47.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="{{ asset('images/login/login47.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div> --}}
    </div>
@endsection
