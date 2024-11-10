@extends('admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="content">

        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Permission</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-pane" id="settings">
                                <form id="myForm" method="post"
                                    action="{{ route('admin.update-permission', $permissions->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit
                                        Permission</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Permission Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $permissions->name }}">


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Group Name </label>
                                                <select name="group_name" class="form-select" id="example-select">
                                                    <option selected disabled>Select Group</option>

                                                    <option value="pos"
                                                        {{ $permissions->group_name === 'pos' ? 'selected' : '' }}>Pos
                                                    </option>
                                                    <option value="employee"
                                                        {{ $permissions->group_name === 'employee' ? 'selected' : '' }}>
                                                        Employee</option>
                                                    <option value="customer"
                                                        {{ $permissions->group_name === 'customer' ? 'selected' : '' }}>
                                                        Customer</option>
                                                    <option value="supplier"
                                                        {{ $permissions->group_name === 'supplier' ? 'selected' : '' }}>
                                                        Supplier</option>
                                                    <option value="salary"
                                                        {{ $permissions->group_name === 'salary' ? 'selected' : '' }}>Salary
                                                    </option>
                                                    <option value="attendence"
                                                        {{ $permissions->group_name === 'attendence' ? 'selected' : '' }}>
                                                        Attendence</option>
                                                    <option value="category"
                                                        {{ $permissions->group_name === 'category' ? 'selected' : '' }}>
                                                        Category</option>
                                                    <option value="product"
                                                        {{ $permissions->group_name === 'product' ? 'selected' : '' }}>
                                                        Product</option>
                                                    <option value="expense"
                                                        {{ $permissions->group_name === 'expense' ? 'selected' : '' }}>
                                                        Expense</option>
                                                    <option value="orders"
                                                        {{ $permissions->group_name === 'orders' ? 'selected' : '' }}>
                                                        Orders</option>
                                                    <option value="stock"
                                                        {{ $permissions->group_name === 'stock' ? 'selected' : '' }}>Stock
                                                    </option>
                                                    <option value="roles"
                                                        {{ $permissions->group_name === 'roles' ? 'selected' : '' }}>Roles
                                                    </option>
                                                </select>


                                            </div>
                                        </div>

                                    </div>

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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    group_name: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: 'Please Enter Permission Name',
                    },
                    group_name: {
                        required: 'Please Select Group Name',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
