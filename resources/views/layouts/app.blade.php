<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

    {{-- DataTable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">

    {{-- sweet alert 1 --}}
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

    {{-- sweet alert 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    {{-- main css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('extra_css')
</head>

<body>
    <div class=" main-container">
        <div class="navigation active">
            <div class="d-flex nav-logo">
                <img src="{{ asset('image/logo.png') }}" alt="" class="logo">
                <h5 class="text-white">Admin Panel</h5>
            </div>
            <ul>
                <li class="list {{ Request::is('admin/item/list') ? 'active' : '' }}">
                    <b></b>
                    <b></b>
                    <a href="{{ route('admin#itemList') }}">
                        <span class="icon">
                            <ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="text">Item List</span>
                    </a>
                </li>

                <li class="list {{ Request::is('admin/category/list') ? 'active' : '' }}">
                    <b></b>
                    <b></b>
                    <a href="{{ route('admin#categoryList') }}">
                        <span class="icon">
                            <ion-icon name="list-outline"></ion-icon>
                        </span>
                        <span class="text">Category</span>
                    </a>
                </li>
                <li class="list">
                    <b></b>
                    <b></b>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="#" type="submit">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <button class="text-white logout-btn">
                                Logout
                            </button>
                        </a>
                    </form>
                </li>

            </ul>

        </div>

        <div class="content">
            <div class=" top-nav">
                <div class="profile">
                    <img src="{{ asset('image/logo.png') }}" alt="">
                </div>
            </div>

            @yield('content')

        </div>
    </div>
</body>
{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

{{-- Jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

{{-- ionicons --}}
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

{{-- DataTable --}}
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

{{-- map picker --}}
<script src="https://maps.google.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="https://cdn.rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.min.js">
</script>
{{-- sweet alert 1 --}}
<script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>

{{-- sweet alert 2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

{{-- main js --}}
<script src="{{ asset('js/script.js') }}"></script>


<script>
    $(document).ready(function() {
        $.extend(true, $.fn.dataTable.defaults, {
            processing: true,
            serverSide: true,
            responsive: true,
            mark: true,

            columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                },
                {
                    targets: 'no-search',
                    searchable: false,
                },
                {
                    targets: 'hidden',
                    visible: false,
                },
            ],
            language: {
                "paginate": {
                    'previous': '<i class="fa-solid fa-angles-left"></i>',
                    'next': '<i class="fa-solid fa-angles-right"></i>',
                },
                "processing": `<img src="{{ asset('image/loading.gif') }}" style="width:70px">`

            },
        });
    })
</script>
@yield('script')

</html>
