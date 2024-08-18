@extends('admin_dashboard')

@section('admin')
    @php
        $year = date('Y');
        $expenseyear = App\Models\Expense::where('year', $year)->sum('amount');
    @endphp
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Year Expense</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">Year Total Expense : ₹{{ $expenseyear }}</h4>
                            <!-- New h4 tag -->
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
