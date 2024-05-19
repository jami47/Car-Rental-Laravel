{{-- <a href="{{ route('logout') }}">Logout</a>
<h1>Hello, Admin Baisab {{ Auth::user()->username }}</h1>
 --}}
@extends('layouts.admindashlayout')

@section('page-title')
    Admin Dashboard
@endsection

@section('body')
    <div class="container-fluid px-4">
        <div class="row g-3 my-2">
            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">{{ count($cars) }}</h3> {{--! DataBase Entry  --}}
                        <p class="fs-5">Cars</p>
                    </div>
                    <i class="fas fa-car fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">{{ count($users)-1 }}</h3> {{--! DataBase Entry  --}}
                        <p class="fs-5">Users</p>
                    </div>
                    <i
                        class="fas fa-user fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">3899</h3>
                        <p class="fs-5">Delivery</p>
                    </div>
                    <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">%25</h3>
                        <p class="fs-5">Increase</p>
                    </div>
                    <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </div>
        </div>

    </div>

    <div align="center">
        <img src = "https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExbXVwbGNhd2huYW9yYzZmZXNxb3JwZmd4Mmt4djJpamF3NDduMzE3aCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/NJC2AVN5Zqoqcf6gxn/giphy.gif" width = "390" style="margin-top: 5rem; border-radius: 50px; padding: 20px;height=200px; object-fit: cover;">
        </div>

       {{--  <div class="tenor-gif-embed" data-postid="20333244" data-share-method="host" data-aspect-ratio="1.18081" data-width="100%"><a href="https://tenor.com/view/shellie-car-shellie-bellie-shellie-coffee-coffee-car-gif-20333244">Shellie Car Shellie Bellie Sticker</a>from <a href="https://tenor.com/search/shellie+car-stickers">Shellie Car Stickers</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script> --}}
@endsection
