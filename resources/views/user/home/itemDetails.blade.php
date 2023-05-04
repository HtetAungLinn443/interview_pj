@extends('user.layout.app')

@section('title', 'Details Page')
@section('extra_css')
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;

            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 40vh;

        }

        .swiper-slide img {
            display: block;
            width: auto;
            height: 100%;
            object-fit: cover;
        }

        .info {
            max-width: 1200px;
            margin: auto;
        }

        .info-card {
            margin: 30px 20px;
        }
    </style>
@endsection
@section('content')
    <section class="slider-section">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($item->image as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/item/' . $image) }}">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <section class="info">
        <div class="info-card">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{ $item->name }}</h4>
                    <p class="mb-3 theme-color h5">${{ $item->price }}</p>
                    <div class="d-flex justify-items-center">
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="">
                                <div class="mb-3">
                                    Type
                                </div>
                                @if ($item->type == 'buy')
                                    <div class="badge badge-info text-capitalize">{{ $item->type }}</div>
                                @elseif($item->type == 'sell')
                                    <div class="badge badge-danger text-capitalize">{{ $item->type }}</div>
                                @else
                                    <div class="badge badge-success text-capitalize">{{ $item->type }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="">
                                <div class="mb-3">Condition</div>
                                @if ($item->condition == 'new')
                                    <div class="badge badge-info text-capitalize">{{ $item->condition }}</div>
                                @else
                                    <div class="badge badge-success text-capitalize">{{ $item->condition }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4 col-md-4 d-flex justify-content-center">
                            <div class="">
                                <div class="mb-3">Status</div>
                                @if ($item->publish == 'on')
                                    <div class="badge badge-success">Available</div>
                                @elseif($item->publish == null)
                                    <div class="badge badge-danger">Sold Out</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5>Product Description</h5>
                        {!! $item->description !!}
                    </div>
                    <div class="mb-3 ">
                        <h5 class="mb-4">Owner Info</h5>
                        <div class="card ">
                            <div class="card-body">
                                <p class="mb-2"><i class="fa fa-phone me-2"></i>Contact Number</p>
                                <p class="mb-0">{{ $item->contact_number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card " style="background: #f5f5f5;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('image/logo.png') }}" class="profile_img" alt="">
                                <div class="px-3">
                                    <p class="mb-0">{{ $item->owner_name }}</p>
                                    <small><i> {{ $item->address }}</i></small>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-2 col-md-6 ">
                    <div class="">
                        <p><i class="fa-solid fa-location-dot me-2"></i> Location</p>
                        <b class="">{{ $item->address }}</b>
                    </div>
                    <div id="us2" style="height: 100%;"></div>
                    <div class="mt-2 row">
                        <div class="col-6">

                            <input type="hidden" id="us2-lat" value="{{ $item->latitude }}" name="latitude"
                                class="mb-2 form-control" />
                        </div>
                        <div class="col-6">

                            <input type="hidden" id="us2-lon" value="{{ $item->longitude }}" name="longitude"
                                class="mb-2 form-control" />
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
@section('script')

    <script>
        var swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
        });

        $('#us2').locationpicker({
            enableAutocomplete: true,
            enableReverseGeocode: true,
            radius: 0,
            inputBinding: {
                latitudeInput: $('#us2-lat'),
                longitudeInput: $('#us2-lon'),
                radiusInput: $('#us2-radius'),
                locationNameInput: $('#us2-address')
            },
            onchanged: function(currentLocation, radius, isMarkerDropped) {
                var addressComponents = $(this).locationpicker('map').location.addressComponents;
                console.log(currentLocation); //latlon
                updateControls(addressComponents); //Data
            }
        });

        function updateControls(addressComponents) {
            console.log(addressComponents);
        }
    </script>
@endsection
