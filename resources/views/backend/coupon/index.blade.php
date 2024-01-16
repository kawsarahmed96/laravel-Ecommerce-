@extends('layouts.backendapp')

@section('content')
    <div class="row gy-5 g-xl-12">
        <div class="col-xl-8">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Coupon List</span>
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
                                    <th class="min-w-110px">Coupon Code</th>
                                    <th class="min-w-50px">Create</th>
                                    <th class="min-w-50px">Expire</th>
                                    <th class="min-w-50px">Limit</th>
                                    <th class="min-w-100px">Coupon Discount</th>
                                    <th class="min-w-10px">Min_App.Amount</th>
                                    <th class="min-w-120px">Crtd At</th>
                                    <th class="min-w-120px text-end">Actions</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="min-w-110px">{{ $coupon->coupon_code }}</td>
                                        <td class="min-w-50px">{{ $coupon->start_date->format('d M Y') }}</td>
                                        <th class="min-w-50px">{{ $coupon->expire_date->format('d M Y') }}</th>
                                        <td class="min-w-50px">{{ $coupon->limit }}</td>
                                        <td class="min-w-100px">{{ $coupon->coupon_discount }}</td>
                                        <td class="min-w-100px">{{ $coupon->min_applicable_amount }}</td>
                                        <td class="min-w-120px">{{ $coupon->created_at->format('d M Y') }}</td>
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

                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Coupon Code</label>
                                <input type="text" class="form-control form-control-solid" name="coupon_code">
                                @error('coupon_code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Start Date</label>
                                <input type="date" class="form-control form-control-solid" name="start_date">
                                @error('start_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Expire date</label>
                                <input type="date" class="form-control form-control-solid" name="expire_date">
                                @error('expire_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Limit</label>
                                <input type="text" class="form-control form-control-solid" name="limit">
                                @error('limit')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Coupon Discount</label>
                                <input type="text" class="form-control form-control-solid" name="coupon_discount">
                                @error('coupon_discount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-start py-3">
                                <label for="" class="fs-6 fw-bold mb-2">Min_App._Amount</label>
                                <input type="text" class="form-control form-control-solid" name="min_applicable_amount">
                                @error('min_applicable_amount')
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
