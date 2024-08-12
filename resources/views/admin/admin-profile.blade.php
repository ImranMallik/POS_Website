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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Profile</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Admin Profile</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4 col-xl-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{ !empty($admindata->photo) ? url($admindata->photo) : url('upload/no_image.jpg') }}"
                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                            <h4 class="mb-0">{{ $admindata->name }}</h4>
                            <p class="text-muted">{{ $admindata->email }}</p>

                            <button type="button"
                                class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                            <button type="button"
                                class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>

                            <div class="text-start mt-3">

                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span
                                        class="ms-2">{{ $admindata->name }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span
                                        class="ms-2">{{ $admindata->phone ? $admindata->phone : 'Please Submit Your Number' }}</span>
                                </p>

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span
                                        class="ms-2">{{ $admindata->email }}</span></p>


                            </div>


                        </div>
                    </div> <!-- end card -->



                </div> <!-- end col-->

                <div class="col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-body">


                            <!-- end about me section content -->


                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('admin.profile-store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Personal Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Name</label>
                                                <input type="text" value="{{ $admindata->name }}" name="name"
                                                    class="form-control" id="firstname" placeholder="Enter first name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Email</label>
                                                <input type="email" value="{{ $admindata->email }}" name="email"
                                                    class="form-control" id="lastname">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Phone</label>
                                                <input type="text" value="{{ $admindata->phone }}" name="phone"
                                                    class="form-control" id="lastname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Admin Profile Image</label>
                                                <input type="file" name="photo" class="form-control" id="image">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"></label>
                                                <img id="showImage"
                                                    src="{{ !empty($admindata->photo) ? url($admindata->photo) : url('upload/no_image.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>

                                        </div>
                                    </div> <!-- end row -->




                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->

                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
