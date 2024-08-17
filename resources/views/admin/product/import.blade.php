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
                                <a href="{{ route('admin.product-export') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">
                                    <i class="mdi mdi-file-download"></i> <!-- Icon for Download -->
                                    Download Xlsx
                                </a>
                            </ol>
                        </div>

                        <h4 class="page-title">Import Product</h4>
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
                                <form method="post" action="{{ route('admin.product-import-data') }}"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <div class="row">


                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Xlsx file Import</label>
                                                <input type="file" name="import_file" class="form-control">

                                            </div>
                                        </div>


                                    </div> <!-- end row -->



                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Upload </button>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
