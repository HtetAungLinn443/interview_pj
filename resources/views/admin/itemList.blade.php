@extends('layouts.app')
@section('title', 'Item List')
@section('extra_css')
    <style>

    </style>
@endsection

@section('content')
    <div class="p-3 d-flex justify-content-center">
        <div class="col-12">
            <h5 class="mb-3 text-theme">Item List</h5>
            <div class="text-end">
                <a href="{{ route('admin#itemCreate') }}" class="btn btn-theme text-capitalize"><i
                        class="fa-solid fa-plus me-2"></i>Add Item</a>
            </div>
            <div class="table p-3 ">
                <table id="item" class="table rounded table-striped " style="width:100%">
                    <thead class="text-white bg-theme">
                        <tr>
                            <th class="text-center no-sort no-search">No</th>
                            <th class="text-center">Action</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Owner</th>
                            <th class="text-center">Publish</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            var t = $('#item').DataTable({

                ajax: '/admin/item/datatable',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        class: 'text-center'
                    }, {
                        data: 'action',
                        name: 'action',
                        class: "text-center"
                    }, {
                        data: 'name',
                        name: 'name',
                        class: 'text-center'
                    },
                    {
                        data: 'category',
                        name: 'category',
                        class: 'text-center'
                    }, {
                        data: 'description',
                        name: 'description',
                        class: 'text-center'
                    }, {
                        data: 'price',
                        name: 'price',
                        class: 'text-center'
                    }, {
                        data: 'owner_name',
                        name: 'owner_name',
                        class: 'text-center'
                    }, {
                        data: 'publish',
                        name: 'publish',
                        class: 'text-center'
                    },

                ],

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

            })
            t.on('order.dt search.dt', function() {
                let i = 1;

                t.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();

            @if (session('createSuccess'))
                Swal.fire({
                    title: 'Success',
                    text: "{{ session('createSuccess') }}",
                    icon: 'success',
                    confirmButtonText: 'Confirm',

                })
            @endif

            // Delete Btn
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    method: "get",
                    url: `/admin/item/delete/${id}`,
                }).done(function(res) {
                    $('#item').DataTable().ajax.reload();
                })
            })
        });
    </script>
@endsection
