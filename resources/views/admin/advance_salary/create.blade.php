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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Advance Salary</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Add Advance Salary</h4>
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
                            <h4 class="header-title">{{ date('F Y') }}</h4>
                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('admin.advance-salary.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Advance
                                        Salary</h5>

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Name </label>
                                                <select name="employee_id"
                                                    class="form-select @error('employee_id') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Select Employee </option>
                                                    @foreach ($employee as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        @php
                                            // Get the current month and year
                                            $currentMonth = date('F');
                                            $currentYear = date('Y');

                                            // Calculate the previous month
                                            $previousMonth = date('F', strtotime('first day of last month'));
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Salary Month </label>
                                                <select name="month"
                                                    class="form-select @error('month') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Select Month </option>
                                                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                        <option value="{{ $month }}"
                                                            {{ $month === $previousMonth ? 'selected' : '' }}>
                                                            {{ $month }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('month')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Salary Year </label>
                                                <select name="year"
                                                    class="form-select @error('year') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Select Year </option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                </select>
                                                @error('year')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Advance Salary </label>
                                                <input type="text" name="advance_salary" class="form-control">

                                            </div>
                                        </div>



                                    </div> <!-- end row -->



                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
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
