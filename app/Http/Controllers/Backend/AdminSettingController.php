<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index(AdminDataTable $dataTable)
    {
        // return view('admin.admin_setting.index');
        return $dataTable->render('admin.admin_setting.index');
    }
}
