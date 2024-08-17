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
                                <a href="{{ route('admin.product.create') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Add Product </a>
                            </ol>
                        </div>
                        <div class="page-title-right mx-2">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('admin.product-export') }}"
                                    class="btn btn-info rounded-pill waves-effect waves-light">
                                    <i class="mdi mdi-file-download"></i> <!-- Icon for Download -->
                                    Download Xlsx
                                </a>
                            </ol>
                        </div>
                        <h4 class="page-title">All Product</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
