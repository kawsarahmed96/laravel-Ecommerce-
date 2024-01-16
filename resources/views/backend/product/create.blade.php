@extends('layouts.backendapp')


@section('content')
    <div class="row gy-5 g-xl-12 justify-content-center">


        <div class="col-xl-10">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="btn btn-sm bg-primary text-white  m-3 rounded-pill">
                        <span>Create Product </span>

                    </h3>
                    <h3 class="card-title align-items-start flex-column">
                        <span> <a class="btn btn-sm bg-primary text-white  me-5 rounded-pill"
                                href="{{ route('backend.productmanagement.Product.index') }}">
                                Active Product List
                            </a></span>

                    </h3>


                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <form action="{{ route('backend.productmanagement.Product.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Product Name</label>
                                    <input type="text" class="form-control form-control-solid" name="name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Category Id</label>
                                    <select name="Cate_id[]" class="form-control form-control-solid active_selcet2" multiple
                                        id="">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Cate_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Short Description</label>

                                    <input type="text" class="form-control form-control-solid" name="short_dec">
                                    @error('short_dec')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Price</label>

                                    <input type="number" class="form-control form-control-solid" name="price">
                                    @error('price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Sale Price</label>

                                    <input type="number" class="form-control form-control-solid" name="saleprice">
                                    @error('saleprice')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Description</label>
                                    <textarea class="form-control form-control-solid summernote " rows="5" cols="3" name="description"></textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" id="" class= " fs-6 fw-bold mb-2">Additional
                                        Information</label>
                                    <textarea class="form-control form-control-solid summernote " rows="5" cols="3" name="add_info"></textarea>
                                    @error('add_info')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Product Gallery</label>

                                    <input type="file" class="form-control form-control-solid" name="image_gallery[]"
                                        multiple>
                                    @error('image_gallery')
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
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>


    </div>
    <!--end::Tables Widget 9-->
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endsection
