@extends('layouts.backendapp')


@section('content')
    <div class="row gy-5 g-xl-12">


        <div class="col-xl-8">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Create Product </span>

                    </h3>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <form action="{{ route('backend.productmanagement.Product.update',$products->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Product Name</label>
                                    <input type="text" value="{{ old('name', $products->title) }}"
                                        class="form-control form-control-solid" name="name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Category Name</label>
                                    <select name="Cate_id[]" class="form-control form-control-solid active_selcet2" multiple
                                        id="">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, $products->categories->pluck('id')->ToArray()) ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Cate_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Short Description</label>

                                    <input type="text" value="{{ old('name', $products->short_description) }}"
                                        class="form-control form-control-solid" name="short_dec">
                                    @error('short_dec')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Price</label>

                                    <input type="number" value="{{ old('price', $products->price) }}"
                                        class="form-control form-control-solid" name="price">
                                    @error('price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Sale Price</label>

                                    <input type="number" value="{{ old('price', $products->price) }}"
                                        class="form-control form-control-solid" name="saleprice">
                                    @error('saleprice')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" class="fs-6 fw-bold mb-2">Description</label>
                                    <textarea class="form-control form-control-solid summernote " name="description">{{ old('price', $products->description) }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-start py-3">
                                    <label for="" id="" class= " fs-6 fw-bold mb-2">Additional
                                        Information</label>
                                    <textarea class="form-control form-control-solid summernote " name="add_info">{{ old('price', $products->additional_info) }}</textarea>
                                    @error('add_info')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                    </div>

                    <div class="text-start py-5">
                        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Update +</span>

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
