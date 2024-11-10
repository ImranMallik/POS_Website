@extends('admin_dashboard')

@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Order Details </a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Order Details</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('admin.orderCustomerStored') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $details->id }}">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Order Details
                                </h5>

                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Image</label>
                                            <img id="showImage" src="{{ asset($details->customerDetails->image) }}"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Name</label>
                                            <p class="text-danger"> {{ $details->customerDetails->name }} </p>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Email</label>
                                            <p class="text-danger"> {{ $details->customerDetails->email }} </p>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Phone</label>
                                            <p class="text-danger"> {{ $details->customerDetails->phone }} </p>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Order Date </label>
                                            <p class="text-danger"> {{ $details->order_date }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Order Invoice </label>
                                            <p class="text-danger"> {{ $details->invoice_no }} </p>
                                        </div>
                                    </div>




                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Payment Status </label>
                                            <p class="text-danger"> {{ $details->payment_status }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Paid Amount </label>
                                            <p class="text-danger"> {{ $details->pay }} </p>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Due Amount </label>
                                            <p class="text-danger"> {{ $details->due }} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit"
                                        class="btn btn-success waves-effect waves-light mt-2 complete-order"><i
                                            class="mdi mdi-content-save"></i> Complete Order </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">


                                    <table class="table table-striped table-bordered dt-responsive nowrap w-100">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total (+VAT)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderDetailsData as $item)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset($item->Product->product_image) }}"
                                                            class="img-fluid rounded" style="width: 50px; height: 40px;">
                                                    </td>
                                                    <td>{{ $item->Product->product_name }}</td>
                                                    <td>{{ $item->Product->product_code }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>₹{{ number_format($item->Product->selling_price, 2) }}</td>
                                                    <td>₹{{ number_format($item->total, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.complete-order').on('click', function(event) {
                event.preventDefault();

                let orderId = {{ $details->id }};
                // alert(orderId);
                $.ajax({
                    url: "{{ route('admin.updateOrderQuantity') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        order_id: orderId,
                    },
                    success: function(response) {
                        if (response.success) {
                            alert("Order completed and product store updated successfully!");
                            location
                                .reload(); // Optional: Reload to reflect changes if necessary
                        } else {
                            alert("An error occurred. Please try again.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert("Error: " + error);
                    }
                });
            });

        });
    </script>
@endpush
