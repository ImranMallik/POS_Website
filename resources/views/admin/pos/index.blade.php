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


                            </ol>
                        </div>
                        <h4 class="page-title">POS</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-4">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>SubTotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $allCart = Cart::content();
                                        // @dd($allCart);
                                    @endphp
                                    <tbody>
                                        @foreach ($allCart as $cartItem)
                                            <tr data-id="{{ $cartItem->rowId }}">
                                                <td>{{ $cartItem->name }}</td>
                                                <td>
                                                    <div class="input-group">
                                                        <button class="btn btn-outline-primary btn-sm" type="button"
                                                            onclick="decrementQty(this, '{{ $cartItem->rowId }}')">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <span class="form-control form-control-sm qty-display"
                                                            style="width:60px; text-align: center;">{{ $cartItem->qty }}</span>
                                                        <button class="btn btn-outline-primary btn-sm" type="button"
                                                            onclick="incrementQty(this,'{{ $cartItem->rowId }}')">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>₹ {{ $cartItem->price }}</td>
                                                <td class="subtotal">₹ {{ $cartItem->price * $cartItem->qty }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        data-row-id="{{ $cartItem->rowId }}" onclick="confirmDelete(this)">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="bg-primary p-3 rounded mt-4">
                                <p class="mb-2" style="font-size:18px; color:#fff">
                                    Quantity: <span class="font-weight-bold quantity-display">{{ Cart::count() }}</span>
                                </p>
                                <h2 class="text-white">Total Price</h2>
                                <h1 class="text-white font-weight-bold subtotal-display"> ₹ {{ Cart::subtotal() }}</h1>
                            </div>


                            <form class="mt-4">
                                <div class="form-group mb-3">
                                    <label for="example-select" class="form-label">All Customer</label>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <select name="supplier_id" class="form-select" id="example-select">
                                            <option selected disabled>Select Customer</option>
                                            @foreach ($coustomer as $cus)
                                                <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                                            @endforeach
                                        </select>
                                        <a href="#"
                                            class="btn btn-primary rounded-pill waves-effect waves-light ms-3">Add
                                            Customer</a>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn btn-success btn-block rounded-pill waves-effect waves-light">Create
                                    Invoice</button>
                            </form>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col-->

                <div class="col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">


                            {{ $dataTable->table() }}


                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->


        </div>

    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).on('click', '.add-to-cart-btn', function(e) {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var qty = 1;
            var price = $(this).data('price');

            $.ajax({
                url: '{{ route('admin.addToCart') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    name: name,
                    qty: qty,
                    price: price,
                },
                success: function(response) {
                    // Show Toastr notification on success
                    // toastr.success(response.success, 'Product Added to Cart');
                    window.location.reload();
                },
                error: function(xhr) {
                    // Handle errors
                    toastr.error('Something went wrong. Please try again.', 'Error');
                }

            });


        });
        // Handal Increment Or Decrement

        function decrementQty(button, rowId) {
            var qtyDisplay = button.nextElementSibling;

            if (qtyDisplay) {
                var currentQty = parseInt(qtyDisplay.textContent);
                if (currentQty > 1) {
                    currentQty -= 1;
                    qtyDisplay.textContent = currentQty;

                    // console.log("Row ID:", rowId);
                    // console.log("Updated Quantity:", currentQty);

                    updateSubtotal(rowId, currentQty);
                } else {
                    console.log("Minimum quantity reached.");
                }
            }
        }

        function incrementQty(button, rowId) {
            // alert("Increment function called");

            var qtyDisplay = button.previousElementSibling;
            // console.log("Current qtyDisplay element:", qtyDisplay);

            var currentQty = parseInt(qtyDisplay.textContent);
            // console.log("Current quantity:", currentQty);

            currentQty += 1;
            qtyDisplay.textContent = currentQty;
            // console.log("Updated quantity:", currentQty);

            updateSubtotal(rowId, currentQty);
        }

        function updateSubtotal(rowId, qty) {
            // alert();
            $.ajax({
                url: "{{ route('admin.update.cart') }}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    qty: qty,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var row = document.querySelector('tr[data-id="' + rowId + '"]');
                    if (row) {
                        var subtotalCell = row.querySelector('.subtotal');
                        if (subtotalCell) {
                            subtotalCell.textContent = '₹ ' + response.subtotal.toFixed(2);
                        } else {
                            console.error('Subtotal cell not found in row.');
                        }
                    } else {
                        console.error('Row not found with data-id:', rowId);
                    }
                },
                error: function(xhr) {
                    console.error('Error updating subtotal:', xhr.responseText);
                }
            });
        }
        // 
        function confirmDelete(button) {
            // Get the rowId from the data attribute
            var rowId = button.getAttribute('data-row-id');

            // Show an alert message to confirm deletion
            var confirmDelete = confirm("Are you sure you want to delete this item from the cart?");

            if (confirmDelete) {
                // Proceed with deletion if confirmed
                deleteCartItem(rowId);
            }
        }

        function deleteCartItem(rowId) {
            $.ajax({
                url: "{{ route('admin.delete.cart') }}", // Update with your delete route
                method: 'POST',
                data: {
                    rowId: rowId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    toastr.success('Item deleted successfully.');

                    $('tr[data-id="' + rowId + '"]').remove();

                    $('.quantity-display').text(response.quantity);
                    $('.subtotal-display').text('₹ ' + response.subtotal.toFixed(2));
                    setTimeout(function() {
                        location.reload();
                    }, 1000);

                },
                error: function(xhr) {
                    console.error('Error deleting item:', xhr.responseText);
                }
            });
        }
    </script>
@endpush
