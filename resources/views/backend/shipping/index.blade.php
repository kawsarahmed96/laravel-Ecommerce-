@extends('layouts.backendapp')

@section('content')
    <div class="row gy-5 g-xl-12">
        <div class="col-xl-8">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Shipping List</span>
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
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 ">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-20px">Sl</th>
                                    <th class="min-w-110px">Shipping Name</th>
                                    <th class="min-w-50px">Add. Price</th>     
                                    <th class="min-w-120px">Crtd At</th>
                                    <th class="min-w-120px text-end">Actions</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($shippings as $shipping)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="min-w-110px">{{ $shipping->shipping_name }}</td>
                                        <td class="min-w-110px">{{ $shipping->add_price }}</td>
                                        <td class="min-w-120px">{{ $shipping->created_at->format('d M Y') }}</td>
                                        <td class="min-w-120px text-end">Actions</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-4">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Create Coupon </span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->

                        <form action="{{route('backend.productmanagement.Shipping.store')}}" method="post">
                            @csrf
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Shipping Name</label>
                                <input type="text" class="form-control form-control-solid" name="shipping_name">
                                @error('shipping_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Additional Price</label>
                                <input type="number" class="form-control form-control-solid" name="add_price">
                                @error('add_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                           
                            <div class="text-start py-5">
                                <button type="reset" id="kt_modal_new_target_cancel"
                                    class="btn btn-light me-3">Cancel</button>
                                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                    <span class="indicator-label">Create +</span>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
