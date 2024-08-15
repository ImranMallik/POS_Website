@extends('admin_dashboard')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Details Supplier</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Details Supplier</h4>
                        <a href="{{ url()->previous() }}" class="btn btn-primary mb-3 ml-3 ">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
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
                                <form>
                                    {{-- @csrf --}}

                                    <input type="hidden" name="id" value="{{ $detailsData->id }}">

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Details
                                        Supplier</h5>

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Name</label>
                                                <p class="text-danger">{{ $detailsData->name }}</p>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Email</label>
                                                <p class="text-danger">{{ $detailsData->email }}</p>

                                            </div>
                                        </div>




                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Phone </label>
                                                <p class="text-danger">{{ $detailsData->phone }}</p>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Address </label>
                                                <p class="text-danger">{{ $detailsData->address }}</p>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Shop Name </label>
                                                <p class="text-danger">{{ $detailsData->shopname }}</p>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Type </label>
                                                <p class="text-danger">{{ $detailsData->type }}</p>
                                            </div>
                                        </div>





                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Account Holder </label>


                                                <p class="text-danger">{{ $detailsData->account_holder }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Account Number </label>

                                                <p class="text-danger">{{ $detailsData->account_number }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Bank Name </label>

                                                <p class="text-danger">{{ $detailsData->bank_name }}</p>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Bank Branch </label>

                                                <p class="text-danger">{{ $detailsData->bank_branch }}</p>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier City </label>
                                                <p class="text-danger">{{ $detailsData->city }}</p>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"> </label>
                                                <img id="showImage" src="{{ asset($detailsData->image) }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div> <!-- end col -->



                                    </div> <!-- end row -->


                                </form>
                            </div>


                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>



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
