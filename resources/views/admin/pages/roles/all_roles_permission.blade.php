@extends('admin_dashboard')

@section('admin')
    <style>
        .btn-primary-custom {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('admin.add-permission-to-role') }}"
                                    class="btn btn-primary-custom rounded-pill waves-effect waves-light">Add Role in
                                    Permission</a>
                            </ol>
                        </div>
                        <h4 class="page-title">All Roles Permission</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Roles Name</th>
                                        <th>Permission Name</th>
                                        <th width="18%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($roles as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @foreach ($item->permissions as $perm)
                                                    <span class="badge rounded-pill bg-danger"> {{ $perm->name }} </span>
                                                @endforeach
                                            </td>
                                            <td width="18%">
                                                <a href="{{ route('admin.edit.all-permission-for-role', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                                                <a href="{{ route('admin.delete.all-permission-for-role', $item->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light delet-item"
                                                    id="delete">Delete</a>
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
@endsection
