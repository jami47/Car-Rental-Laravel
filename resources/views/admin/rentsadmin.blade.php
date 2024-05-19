{{-- <h1>{{ count($cars) }}</h1> --}}
{{-- @foreach ($users as $user)
    <h1>{{ $user->username }}</h1>
@endforeach --}}
{{-- {{ $users[0]->username }} --}}
@extends('layouts.admindashlayout')

@section('page-title')
    Rented Cars
@endsection

@section('body')

    <div align="center" style="color: red">
        <h2>Cars rented by the customers</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4" style="margin-left: 1rem; margin-right:1rem; margin-top: 1.1rem;">
@php
    $i = -1;
@endphp
        @foreach ($cars as $car)
        @php
            $i = $i + 1;
        @endphp
            <div class="col">
                <div class="card h-100" style="border-radius: 30px; box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;">
                    <img src="{{ asset('images/cars/' . $car->img) }}" class="card-img-top hover-zoom" alt="..." style="border-radius: 50px; padding: 20px;height=200px; object-fit: cover;">
                    <h5 class="text-center">{{ $car->name }}</h5>
                    <div class="card-body flex-grow-1 d-flex flex-column" style="padding: 25px; margin-top: -15px;">
                        <div class="mt-auto">
                            <h6>Production Year: {{ $car->year }}</h6>
                            <h6>NamePlate: {{ $car->nameplate }}</h6>
                            {{-- <h6>Customer: {{ $users[$i]->username }}</h6>
                            <h6>Email: {{ $users[$i]->email }}</h6> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection


@section('js')

@endsection
