@extends('layouts.app')
@section('title', 'Category Edit Page')
@section('extra_css')
    <style>
        .ck-editor__editable[role="textbox"] {

            min-height: 150px;
        }

        .form-control.is-invalid {
            margin-bottom: 0;
        }

        .iti {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="mb-5">
        <div class="mt-5 ">
            <h5 class="px-3 py-3 rounded bg-light">Add Categories</h5>
        </div>
        <form action="{{ route('admin#categoryUpdate', $category->id) }}" method="post" enctype="multipart/form-data"
            id="store-category">
            @csrf
            <div class="row ">
                <div class="px-5 col-md-6 col-12">
                    <p class="mb-4"><b>Item Infomation</b></p>

                    <div class="mb-4 form-group">
                        <label for="" class="mb-1">Category</label>
                        <input type="text" name="categoryName" class=" form-control" placeholder="Input Name"
                            value="{{ $category->name }}">
                    </div>


                    <div class="mb-4 form-group">
                        <label for="categoryImage" class="mb-1">Item Photo</label>
                        <small class="mb-1 text-muted" style="display: block;">Recommended Size 400 / 200</small>
                        <input type="file" name="image" class=" form-control" accept="image/.png, .jpg, .jpeg"
                            id="categoryImage">
                        <div class="my-4 preview_img" id="preview_img">
                            <img src="{{ asset('storage/category/' . $category->image) }}" alt="">
                        </div>
                    </div>
                    <p class="mb-0">Status</p>
                    <div class="mb-4 form-check">

                        <input class="form-check-input" name="publish" type="checkbox" id="status"
                            @if ($category->publish == 'on') checked @endif>
                        <label class="form-check-label text-muted" for="status">
                            Publish
                        </label>

                    </div>
                    <div class="text-end">
                        <a type="button" href="{{ route('admin#categoryList') }}"
                            class="btn btn-sm btn-outline-dark">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-theme">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\CategoryUpdate'), 'store-category' !!}
    <script>
        $(document).ready(function() {
            $('#categoryImage').on('change', function() {
                var file_length = document.getElementById('categoryImage').files.length;
                $('#preview_img').html('');
                for (let i = 0; i < file_length; i++) {
                    $('#preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}" />`);
                }
            });

        })
    </script>
@endsection
