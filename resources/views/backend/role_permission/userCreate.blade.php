@extends('layouts.backendapp')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-xl-8 ">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Add User </span>

                    </h3>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <form action="{{ route('backend.user.store') }}" method="post">
                                @csrf

                                <input type="text" class="form-control form-control-solid mb-3"
                                    placeholder="Enter User Name" name="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <input type="email" class="form-control form-control-solid mb-3"
                                    placeholder="Enter User email" name="email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <input type="password" class="form-control form-control-solid mb-3"
                                    placeholder="Enter User password" name="password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <select name="role[]" class="form-control form-control-solid mb-3" id="">
                                    <option selected value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option selected value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>


                                {{-- <span class="form-control form-control-solid">
                                User Role:
                                <select name="user">

                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </span> --}}


                                <div class="text-start py-5">
                                    <button type="reset" id="kt_modal_new_target_cancel"
                                        class="btn btn-light me-3">Cancel</button>
                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>

                                    </button>
                                </div>
                            </form>
                        </table>
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
