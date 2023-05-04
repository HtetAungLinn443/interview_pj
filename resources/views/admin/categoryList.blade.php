@extends('layouts.app')
@section('title', 'Item List')
@section('extra_css')
    <style>

    </style>
@endsection

@section('content')
    <div class="p-3 d-flex justify-content-center">
        <div class="col-12">
            <h5 class="mb-3 text-theme">Categories</h5>
            <div class="text-end">
                <a href="{{ route('admin#categoryCreate') }}" class="btn btn-theme text-capitalize"><i
                        class="fa-solid fa-plus me-2"></i>Add Item</a>
            </div>
            <div class="table p-3 ">
                <table id="item" class="table rounded table-striped " style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center no-sort no-search">No</th>
                            <th class="text-center ">Action</th>
                            <th class="text-center ">Category</th>
                            <th class="text-center ">Publish</th>
                            <th class="hidden text-center"></th>
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

                ajax: '/admin/category/datatable',
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
                    }, {
                        data: 'publish',
                        name: 'publish',
                        class: 'text-center'
                    }, {
                        data: 'updated_at',
                        name: 'updated_at',
                        class: 'text-center'
                    },

                ],
                order: [
                    [2, 'desc']
                ],
                columnDefs: [{
                        targets: [0],
                        'class': "control",
                    },
                    {
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
                    }, {
                        "searchable": false,
                        "orderable": false,
                        "targets": 2
                    }
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
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    method: "get",
                    url: `/admin/category/delete/${id}`,
                }).done(function(res) {

                    $('#item').DataTable().ajax.reload();
                })
            })
        });
    </script>
@endsection
