@extends('admin_dashboard')

@section('admin')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Pay Salary</h3>
                        <a href="{{ route('admin.pay-salary.create') }}"
                            class="btn btn-primary rounded-pill waves-effect waves-light">Add Salary </a>
                    </div>
                    <div class="card-body">
                        <h4 class="header-title">{{ date('F Y') }}</h4>
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            // Handle Pay Now button click
            $('body').on('click', '.pay-now-btn', function(event) {
                event.preventDefault();

                var button = $(this);
                var id = button.data('id');
                var due = button.data('due');

                // alert(id);

                // Show a confirmation dialog or form
                // var amount = prompt("Enter the paid amount:");

                $.ajax({
                    url: "{{ route('admin.advance-salary.pay') }}", // Define your route here
                    method: 'POST',
                    data: {
                        id: id,
                        paid_amount: due,
                        _token: "{{ csrf_token() }}" // Include CSRF token for security
                    },
                    success: function(response) {
                        // Handle success (e.g., update the DataTable, show a success message)
                        if (response.success) {
                            button.removeClass('btn-success').addClass(
                                'btn-secondary');
                            button.html('<i class="fas fa-money-bill-wave"></i> Paid');
                            toastr.success('Payment recorded successfully.');
                            $('#advancesalary-table').DataTable().ajax.reload();
                        } else {
                            toastr.error('An error occurred: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        // Handle error
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endpush
