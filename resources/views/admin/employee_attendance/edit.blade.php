@extends('admin_dashboard')

@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Employee Attendance</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Edit Form -->
                            <form id="attendanceForm">
                                @csrf
                                @method('PUT')


                                <div class="form-group">
                                    <label for="employeeName">Employee Name</label>
                                    <input type="text" class="form-control" id="employeeName"
                                        value="{{ $employyeData->employeeName->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="attendStatus">Attendance Status</label>
                                    <select name="attend_status" id="attendStatus" class="form-control">
                                        <option value="present"
                                            {{ $employyeData->attend_status == 'present' ? 'selected' : '' }}>Present
                                        </option>
                                        <option value="leave"
                                            {{ $employyeData->attend_status == 'leave' ? 'selected' : '' }}>Leave</option>
                                        <option value="absent"
                                            {{ $employyeData->attend_status == 'absent' ? 'selected' : '' }}>Absent</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ \Carbon\Carbon::parse($employyeData->date)->format('Y-m-d') }}">
                                </div>

                                <button type="submit" id="updateAttendance" class="btn btn-primary mt-2">Update
                                    Attendance</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#attendanceForm').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                var url = "{{ route('admin.employee-attendance.update', $employyeData->id) }}";

                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        toastr.success('Attendance updated successfully.');
                        window.location.href = "{{ route('admin.employee-attendance-list') }}";
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred while updating attendance.');
                    }
                });
            });
        });
    </script>
@endsection
