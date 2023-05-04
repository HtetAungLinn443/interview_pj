@extends('layouts.app')
@section('title', 'Item Create Page')
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
        <form action="{{ route('admin#itemStore') }}" method="post" enctype="multipart/form-data" id="store-item">
            @csrf
            <div class="row ">
                <div class="px-5 col-md-6 col-12">
                    <p class="mb-4"><b>Item Infomation</b></p>

                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Item Name</label>
                        <input type="text" name="name" class=" form-control" placeholder="Input Name">
                    </div>
                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Seclect Category</label>
                        <select name="category" class="form-select">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Price</label>
                        <input type="text" name="price" class=" form-control" placeholder="Ender Price">
                    </div>
                    <div class="mb-4 form-group">
                        <label for="description" class="mb-1">Description</label>
                        <textarea name="description" id="description" cols="30" rows="40"></textarea>
                    </div>
                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Seclect Condition</label>
                        <select name="condition" class="form-select">
                            <option value="">Select Condition</option>
                            <option value="new">New</option>
                            <option value="used">Used</option>

                        </select>
                    </div>
                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Seclect Item Type</label>
                        <select name="type" class="form-select">
                            <option value="">Select Item Type</option>
                            <option value="buy">Buy</option>
                            <option value="sell">Sell</option>
                            <option value="exchange">Exchange</option>
                        </select>
                    </div>
                    <p class="mb-0 ">Status</p>
                    <div class="mb-4 form-check">

                        <input class="form-check-input" name="publish" type="checkbox" id="status">
                        <label class="form-check-label text-muted" for="status">
                            Publish
                        </label>

                    </div>
                    <div class="mb-4 form-group">
                        <label for="itemPhoto" class="mb-1">Item Photo</label>
                        <input type="file" name="images[]" class=" form-control" accept="image/.png, .jpg, .jpeg"
                            id="itemPhoto" multiple>
                        <div class="my-4 preview_img" id="preview_img">

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <p class="mb-4"><b>Owner Infomation</b></p>
                    <div class="mb-4 form-group">
                        <label for="ownerName" class="mb-1">Owner Name</label>
                        <input type="text" name="ownerName" class=" form-control" id="ownerName"
                            placeholder="Ender Owner Name">
                    </div>

                    <div class="mb-4 form-group">
                        <label for="phone" class="mb-1">Contact Number</label>
                        <input type="number" name="contactNumber" class=" form-control" style="width: 100%" id="phone"
                            placeholder="Ender Contact Number">
                    </div>
                    <div class="mb-5 form-group">
                        <label for="" class="mb-1">Address</label>
                        <textarea name="address" placeholder="Ender Address" class=" form-control" placeholder="Ender Address" cols="30"
                            rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <div id="us2" style="height: 385px;"></div>
                        <div class="mt-2 row">
                            <div class="col-6">
                                <label for="">Lat.: </label>
                                <input type="text" id="us2-lat" name="latitude" class="mb-2 form-control" />
                            </div>
                            <div class="col-6">
                                <label for="">Long.: </label>
                                <input type="text" id="us2-lon" name="longitude" class="mb-2 form-control" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-end">
                    <a type="button" href="{{ route('admin#itemList') }}" class="btn btn-sm btn-outline-dark">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-theme">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\ItemStore'), 'store-item' !!}

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
