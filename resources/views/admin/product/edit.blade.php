@extends('admin_dashboard')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a class="btn btn-primary rounded-pill waves-effect waves-light mt-2"
                                    href="{{ route('admin.product.index') }}">Back </a></li>

                        </ol>
                        <h4 class="page-title">Edit Product</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">


                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">





                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('admin.product.update', $productData->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Product
                                    </h5>

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Product Name</label>
                                                <input type="text" value="{{ $productData->product_name }}"
                                                    name="product_name" class="form-control">

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Category </label>
                                                <select name="category_id" class="form-select" id="example-select">
                                                    <option selected disabled>Select Category </option>
                                                    @foreach ($category as $cat)
                                                        <option
                                                            {{ $cat->id == $productData->category_id ? 'selected' : '' }}
                                                            value="{{ $cat->id }}">{{ $cat->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier </label>
                                                <select name="supplier_id" class="form-select" id="example-select">
                                                    <option selected disabled>Select Supplier </option>
                                                    @foreach ($supplier as $sup)
                                                        <option
                                                            {{ $sup->id == $productData->supplier_id ? 'selected' : '' }}
                                                            value="{{ $sup->id }}">{{ $sup->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Product Garage </label>
                                                <input type="text" value="{{ $productData->product_garage }}"
                                                    name="product_garage" class="form-control ">

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Product Store </label>
                                                <input type="text" value="{{ $productData->product_store }}"
                                                    name="product_store" class="form-control ">

                                            </div>
                                        </div>






                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Buying Date </label>
                                                <input type="date" value="{{ $productData->buying_date }}"
                                                    name="buying_date" class="form-control ">

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Expire Date </label>
                                                <input type="date" value="{{ $productData->expire_date }}"
                                                    name="expire_date" class="form-control ">

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Buying Price </label>
                                                <input type="text" value="{{ $productData->buying_price }}"
                                                    name="buying_price" class="form-control ">

                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Selling Price </label>
                                                <input type="text" value="{{ $productData->selling_price }}"
                                                    name="selling_price" class="form-control ">

                                            </div>
                                        </div>




                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Product Image</label>
                                                <input type="file" name="product_image" id="image"
                                                    class="form-control">

                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"> </label>
                                                <img id="showImage" src="{{ asset($productData->product_image) }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div> <!-- end col -->



                                    </div> <!-- end row -->



                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i>Update</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->


                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->



    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
