@extends('admin_dashboard')

@section('admin')
    @php
        $date = date('d-m-Y');
        $expense = App\Models\Expense::where('date', $date)->sum('amount');
    @endphp
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Today Expense</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">Today Total Expense : ₹{{ $expense }}</h4>
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
