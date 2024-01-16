@extends('layouts.backendapp')

@section('content')
    <div class="row gy-5 g-xl-12">
        <div class="col-xl-8">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Color List</span>
                    </h3>
                    {{-- <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                        title="" data-bs-original-title="Click to add a user">
                        <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_invite_friends">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                        transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                        fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->New Member</a>
                    </div> --}}



                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table id="myTable" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 ">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-50px">Sl</th>
                                    <th class="min-w-100px">Name</th>
                                    <th class="min-w-100px">status</th>
                                    {{-- <th class="min-w-70px">Product</th> --}}
                                    <th class="min-w-100px">Created At</th>
                                    <th class="min-w-100px text-end">Actions</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            {{-- <tbody>
                         @foreach ($colors as $color)
                                    <tr>
                                        <td>{{ $color->name }}</td>
                                    </tr>
                                @endforeach  --}}
                            </tbody>
                            <!--end::Table body-->
                        </table>

                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 9-->

        </div>

        <div class="col-xl-4">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Create Color </span>

                    </h3>



                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->

                        <form action="{{ route('backend.productmanagement.Color.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Color Name</label>
                                <input type="text" class="form-control form-control-solid" name="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                    </div>

                    <div class="text-start py-5">
                        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Create +</span>

                        </button>
                    </div>
                    </form>

                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Tables Widget 9-->
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                datatype: 'json',
                ajax: {
                    url: "{{ route('backend.productmanagement.color.data.list') }}",

                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: "name"
                    },
                    {
                        data: 'slug',
                        name: "slug"
                    },
                    // {
                    //     data: 'status',
                    //     name: "status"
                    // },
                    {
                        data: 'created_at',
                        name: "created_at"
                    },
                    {
                        data: 'action',
                        name: "action"
                    }

                ]
            });
        })





        // $(function() {
        //     let table = $('#myTable').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: "{{ route('backend.productmanagement.color.data.list') }}",
        //         columns: [{
        //                 data: 'DT_RowIndex',
        //                 name: 'DT_RowIndex'
        //             },
        //             {
        //                 data: 'name',
        //                 name: 'name'
        //             },
        //             {
        //                 data: 'status',
        //                 name: 'status'
        //             },
        //             // {
        //             //     data: 'action',
        //             //     name: 'action',
        //             //     orderable: false,
        //             //     searchable: false
        //             // }
        //         ]
        //     });
        // });
    </script>
@endsection
