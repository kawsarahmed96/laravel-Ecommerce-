@extends('layouts.backendapp')

@section('content')
    <div class="row gy-5 g-xl-12">


        <div class="col-xl-8">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Edit Category </span>

                    </h3>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <form action="{{ route('backend.productmanagement.Category.update',$category->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Category Name</label>
                                    <input type="text" value="{{$category->name}}" class="form-control form-control-solid" name="name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Parent Id(optional)</label>
                                    <select name="parent_id" class="form-control form-control-solid active_selcet2"
                                        id="">
                                        <option value="">Select Category</option>
                                        {{-- @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('parent_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Image</label>

                                    <input type="file" class="form-control form-control-solid" name="image">
                                    @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Description</label>
                                    <textarea class="form-control form-control-solid" name="description" rows="6"> {{$category->name}}</textarea>
                                    @error('description')
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
