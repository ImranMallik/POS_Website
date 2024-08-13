@extends('admin_dashboard')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Employee</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">


                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- end timeline content-->
                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('admin.employees.update', $employee->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Employee
                                    </h5>

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Name</label>
                                                <input type="text" value="{{ $employee->name }}" name="name"
                                                    class="form-control @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Email</label>
                                                <input type="email" value="{{ $employee->email }}" name="email"
                                                    class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Phone </label>
                                                <input type="text" value="{{ $employee->phone }}" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror">
                                                @error('phone')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Address </label>
                                                <input type="text" value="{{ $employee->address }}" name="address"
                                                    class="form-control @error('address') is-invalid @enderror">
                                                @error('address')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Experience </label>
                                                <select name="experience"
                                                    class="form-select @error('experience') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Select Year </option>
                                                    <option {{ $employee->experience == '1 Year' ? 'selected' : '' }}
                                                        value="1 Year">1 Year</option>
                                                    <option {{ $employee->experience == '2 Year' ? 'selected' : '' }}
                                                        value="2 Year">2 Year</option>
                                                    <option {{ $employee->experience == '3 Year' ? 'selected' : '' }}
                                                        value="3 Year">3 Year</option>
                                                    <option {{ $employee->experience == '4 Year' ? 'selected' : '' }}
                                                        value="4 Year">4 Year</option>
                                                    <option {{ $employee->experience == '5 Year' ? 'selected' : '' }}
                                                        value="5 Year">5 Year</option>
                                                </select>
                                                @error('experience')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Salary </label>
                                                <input type="text" value="{{ $employee->salary }}" name="salary"
                                                    class="form-control @error('salary') is-invalid @enderror">
                                                @error('salary')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Vacation </label>
                                                <input type="text" value="{{ $employee->vacation }}" name="vacation"
                                                    class="form-control @error('vacation') is-invalid @enderror">
                                                @error('vacation')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee City </label>
                                                <input type="text" value="{{ $employee->city }}" name="city"
                                                    class="form-control @error('city') is-invalid @enderror">
                                                @error('city')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Employee Image</label>
                                                <input type="file" name="image" id="image"
                                                    class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"></label>
                                                <img id="showImage"
                                                    src="{{ $employee->image ? asset($employee->image) : url('upload/no_image.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>

                                        </div> <!-- end col -->



                                    </div> <!-- end row -->



                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Update</button>
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
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
