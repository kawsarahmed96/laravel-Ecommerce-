@extends('layouts.backendapp')

@section('content')
    <div class="row gy-5 g-xl-12">
        <div class="col-xl-8">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1"><a href="#"
                                                    class="text-dark fw-bolder text-hover-primary fs-6">{{ $size->name }}</a></span>

                    </h3>
                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
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
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-50px">Sl</th>


                                    {{-- <th class="min-w-70px">Product</th> --}}

                                    <th class="min-w-100px text-end">Actions</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>


                                <tr>
                                    <th class="min-w-100px">Name</th>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#"
                                                    class="text-dark fw-bolder text-hover-primary fs-6">{{ $size->name }}</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="min-w-100px">status</th>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#"
                                                    class="text-dark fw-bolder text-hover-primary fs-6">{{ $size->status }}</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                      <th class="min-w-100px">Time</th>
                                  
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">
                                                    <span class="badge bg-success">{{ $size->created_at }}</span>
                                                </a>

                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                {{-- <td>

                                            <a href="#"
                                                class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $size->created_at->format('d M Y') }}
                                            </a>
                                        </td> --}}



                                </tr>

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


    </div>
    </div>
@endsection
