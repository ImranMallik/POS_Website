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
                                <a href="{{ route('admin.coustomer.create') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Add Customer </a>
                            </ol>
                        </div>
                        <h4 class="page-title">Employee Attendance</h4>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '.submit-btn', function() {
                var employeeId = $(this).data('employee-id');
                var radioGroup = $(this).closest('.radio-group');
                var selectedStatus = radioGroup.find('input[type="radio"]:checked').val()

                // console.log('Employee ID:', employeeId);
                console.log('Selected Status:', selectedStatus);

                if (typeof selectedStatus === 'undefined' || !selectedStatus) {
                    alert('Please select an attendance status');
                    return;
                }

                // AJAX request
                $.ajax({
                    url: "{{ route('admin.attendance.submit') }}", // Replace with your route
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        employee_id: employeeId,
                        attend_status: selectedStatus
                    },
                    success: function(response) {
                        // alert('Data submitted successfully');
                        // console.log(response);
                        toastr.success('Data submitted successfully!');

                    },
                    error: function(xhr) {
                        alert('An error occurred');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
