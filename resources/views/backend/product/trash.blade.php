@extends('layouts.backendapp')

@section('content')
    <div class="row gy-5 g-xl-12">
        <div class="col-xl-12">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-12">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <div data-bs-trigger="hover">
                        <a href="{{ route('backend.productmanagement.Product.index') }}"
                            class="btn btn-sm bg-primary text-white  me-5 rounded-pill">
                            Product List
                        </a>
                    </div>
                    <div data-bs-trigger="hover">
                        <a class="btn btn-sm bg-primary text-white  me-5 rounded-pill">
                            Trash Product List
                        </a>
                    </div>
                    <div data-bs-trigger="hover">
                        <a href="{{ route('backend.productmanagement.Product.create') }}"
                            class="btn btn-sm bg-primary text-white  me-5 rounded-pill">
                            Add New Product
                        </a>
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
                                    <th class="min-w-100px">Name</th>
                                    <th class="min-w-100px">Category</th>
                                    <th class="min-w-70px">price</th>
                                    <th class="min-w-70px">sale price</th>
                                    <th class="min-w-70px">status</th>
                                    <th class="min-w-100px">Created At</th>
                                    <th class="min-w-70px text-end">Actions</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>

                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary fs-6">{{ $loop->iteration }}</a>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary fs-6">{{ $product->title }}</a>

                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">
                                                        @foreach ($product->categories as $category)
                                                            <span class="badge bg-success">{{ $category->name }}</span>
                                                        @endforeach
                                                    </a>

                                                </div>
                                            </div>
                                        </td>



                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary fs-6">{{ $product->price }}</a>

                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary fs-6">{{ $product->sale_price }}</a>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary fs-6">{{ $product->status }}</a>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary fs-6">{{ $product?->created_at->format('d M Y') }}</a>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-shrink-0">

                                                <a href="{{ route('backend.productmanagement.product.trash.restore', $product->id) }}"
                                                    class="btn btn-sm bg-primary text-white  me-5 rounded-pill">
                                                    Restore
                                                </a>



                                                @can('delete product')
                                                    <form method="post"
                                                        action="{{ route('backend.productmanagement.product.trash.delete', $product->id) }}"
                                                        class="trashDelete">
                                                        @method('delete')
                                                        @csrf

                                                        <button type="submit"
                                                            class="btn btn-sm bg-warning text-white  me-5 rounded-pill">
                                                            Permanent Delete
                                                        </button>

                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                        <div class="footer">
                            {{ $products->links() }}
                        </div>
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 9-->
        </div>
        <!--end::Tables Widget 9-->

    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('.trashDelete').on('click', function(e) {
                e.preventDefault();
                var submitUrl = $(this);
                console.log(submitUrl)
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).submit()
                    }
                });
               
            })
        });
    </script>
@endsection
