@extends('user.layout.app')

@section('title', 'Home Page')
@section('content')
    <!-- Start Search -->
    <section id="search">

        <div class="image_header">
            <img src="{{ asset('image/Screenshot 2023-05-02 at 11.29.11 AM.png') }}" alt="">
        </div>
        <div class="search_div">
            <div class="mx-2 shadow search_bar rounded-2">
                <i class="m-auto mx-2 fa-solid fa-magnifying-glass"></i>
                <input type="text" id="input_field" name="searchKey" class="px-3 py-1" placeholder="Search...">
                <div id="select">
                    <p class="p-2 my-auto " id="selectText">Category</p>
                    <i class="px-2 fa-solid fa-angle-down"></i>
                    <ul class="p-3" id="list">
                        @foreach ($categories as $category)
                            <li class="mb-2 options">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button class="px-4 mx-3 btn btn-info rounded-1">Search</button>
        </div>

    </section>

    <!-- End Search -->

    <section id="body" class="mt-5 ">

        <div class="m-auto looking_for w-75 user-select-none">
            <div class="d-flex justify-content-between">
                <h4 class="">What are you looking for ?</h4>
                <a href="" class="fw-light viewmore">View More <i class="px-2 fa-solid fa-angle-right"></i></a>
            </div>

            <div class="mt-5 looking_for_logo d-flex justify-content-evenly">

                <a href="" class="py-2 text-decoration-none card rounded-2">
                    <div class="py-3 computer d-flex flex-column align-items-center">
                        <div class="mb-2 looking_logo d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-laptop fs-4"></i>
                        </div>
                        <p class="m-0">Computer</p>
                    </div>
                </a>
                <a href="" class="py-2 text-decoration-none card rounded-2">
                    <div class="py-3 computer d-flex flex-column align-items-center">
                        <div class="mb-2 looking_logo d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-mobile fs-4"></i>
                        </div>
                        <p class="m-0">Phone</p>
                    </div>
                </a>
                <a href="" class="py-2 text-decoration-none card rounded-2">
                    <div class="py-3 computer d-flex flex-column align-items-center">
                        <div class="mb-2 looking_logo d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-house fs-4"></i>
                        </div>
                        <p class="m-0">Property</p>
                    </div>
                </a>
                <a href="" class="py-2 text-decoration-none card rounded-2">
                    <div class="py-3 computer d-flex flex-column align-items-center">
                        <div class="mb-2 looking_logo d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-music fs-4"></i>
                        </div>
                        <p class="m-0">Music</p>
                    </div>
                </a>
                <a href="" class="py-2 text-decoration-none card rounded-2">
                    <div class="py-3 computer d-flex flex-column align-items-center">
                        <div class="mb-2 looking_logo d-flex justify-content-center align-items-center">
                            <i class="fa-sharp fa-solid fa-shirt fs-4"></i>
                        </div>
                        <p class="m-0">Fashions</p>
                    </div>
                </a>
                <a href="" class="py-2 text-decoration-none card rounded-2">
                    <div class="py-3 computer d-flex flex-column align-items-center">
                        <div class="mb-2 looking_logo d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-screwdriver-wrench fs-4"></i>
                        </div>
                        <p class="m-0">Service</p>
                    </div>
                </a>

            </div>
        </div>

        <div class="mx-auto mt-5 recent_items w-75">
            <div class="d-flex justify-content-between">
                <h4 class="">Recent Items</h4>
                <a href="" class="fw-light viewmore">View More <i class="px-2 fa-solid fa-angle-right"></i></a>
            </div>

            <div class="mb-5 items d-flex justify-content-around">

                @foreach ($item as $item)
                    <a href="{{ route('user#itemDetails', $item->id) }}" class="mt-3">
                        <div class="card item">
                            <div class="card-header item_img">
                                <img src="{{ asset('storage/item/' . $item->image[0]) }}" alt="">
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fs-4 item_title">{{ $item->name }}</span>
                                    @if ($item->condition == 'new')
                                        <span class="badge badge-danger">{{ $item->condition }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $item->condition }}</span>
                                    @endif
                                </div>
                                <p class="fs-6">$ {{ $item->price }}</p>

                                <div class="card_profile d-flex">
                                    <div class="profile_img">
                                        <img src="{{ asset('image/logo.png') }}" alt="">
                                    </div>
                                    <p class="mx-2 text-muted">{{ $item->owner_name }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <a class=" btn btn-danger btn-block" type="submit">Logout</a>
    </form>

@endsection
