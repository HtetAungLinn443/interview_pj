@extends('layouts.app')
@section('title', 'Item Edit Page')
@section('extra_css')

    <style>
        .ck-editor__editable[role="textbox"] {

            min-height: 150px;
        }

        .iti {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="mb-5">
        <div class="mt-5 ">
            <h5 class="px-3 py-3 rounded bg-light">Add Items</h5>
        </div>
        <form action="{{ route('admin#itemUpdate', $item->id) }}" method="post" enctype="multipart/form-data" id="store-item">
            @csrf
            <div class="row ">
                <div class="px-5 col-md-6 col-12">
                    <p class="mb-4"><b>Item Infomation</b></p>

                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Item Name</label>
                        <input type="text" name="name" value="{{ $item->name }}" class="form-control"
                            placeholder="Input Name">
                    </div>
                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Seclect Category</label>
                        <select name="category" class="form-select">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($item->category_id == $category->id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Price</label>
                        <input type="text" name="price" value="{{ $item->price }}" class=" form-control"
                            placeholder="Ender Price">
                    </div>
                    <div class="mb-4 form-group">
                        <label for="description" class="mb-1">Description</label>
                        <textarea name="description" id="description" cols="30" rows="40">{{ $item->description }}</textarea>
                    </div>
                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Seclect Condition</label>
                        <select name="condition" class="form-select">
                            <option value="">Select Condition</option>
                            <option value="new" @if ($item->condition == 'new') selected @endif>New</option>
                            <option value="used" @if ($item->condition == 'used') selected @endif>Used</option>

                        </select>
                    </div>
                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Seclect Item Type</label>
                        <select name="type" class="form-select">
                            <option value="">Select Item Type</option>
                            <option value="buy" @if ($item->type == 'buy') selected @endif>Buy</option>
                            <option value="sell" @if ($item->type == 'sell') selected @endif>Sell</option>
                            <option value="exchange" @if ($item->type == 'exchange') selected @endif>Exchange</option>
                        </select>
                    </div>
                    <p class="mb-0 ">Status</p>
                    <div class="mb-4 form-check">

                        <input class="form-check-input" name="publish" type="checkbox" id="status"
                            @if ($item->publish == 'on') checked @endif>
                        <label class="form-check-label text-muted" for="status">
                            Publish
                        </label>

                    </div>
                    <div class="mb-4 form-group">
                        <label for="itemPhoto" class="mb-1">Item Photo</label>
                        <input type="file" name="images[]" class=" form-control" accept="image/.png, .jpg, .jpeg"
                            id="itemPhoto" multiple>
                        <div class="my-4 preview_img" id="preview_img">
                            @foreach ($item->image as $image)
                                <img src="{{ asset('storage/item/' . $image) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <p class="mb-4"><b>Owner Infomation</b></p>
                    <div class="mb-4 form-group">
                        <label for="ownerName" class="mb-1">Owner Name</label>
                        <input type="text" name="ownerName" value="{{ $item->owner_name }}" class=" form-control"
                            id="ownerName" placeholder="Ender Owner Name">
                    </div>

                    <div class="mb-4 form-group">
                        <label for="phone" class="mb-1">Contact Number</label>
                        <input type="number" name="contactNumber" value="{{ $item->contact_number }}" class=" form-control"
                            style="width: 100%" id="phone" placeholder="Ender Contact Number">
                    </div>
                    <div class="mb-5 form-group">
                        <label for="" class="mb-1">Address</label>
                        <textarea name="address" placeholder="Ender Address" class=" form-control" placeholder="Ender Address"
                            cols="30" rows="5">{{ $item->address }}</textarea>
                    </div>

                    <div class="mb-3">
                        <div id="us2" style="height: 385px;"></div>
                        <div class="mt-2 row">
                            <div class="col-6">
                                <label for="">Lat.: </label>
                                <input type="text" id="us2-lat" value="{{ $item->latitude }}" name="latitude"
                                    class="mb-2 form-control" />
                            </div>
                            <div class="col-6">
                                <label for="">Long.: </label>
                                <input type="text" id="us2-lon" value="{{ $item->longitude }}" name="longitude"
                                    class="mb-2 form-control" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-end">
                    <a type="button" href="{{ route('admin#itemList') }}"
                        class="btn btn-sm btn-outline-dark">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-theme">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\ItemUpdate'), 'store-item' !!}

    <script>
        $(document).ready(function() {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
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

            $('#itemPhoto').on('change', function() {
                var file_length = document.getElementById('itemPhoto').files.length;
                $('#preview_img').html('');
                for (let i = 0; i < file_length; i++) {
                    $('#preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}" />`);
                }
            });

        })
    </script>
@endsection
