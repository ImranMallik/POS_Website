<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\LastMonthSalaryDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LastMonthSalaryController extends Controller
{
    public function get_last_month_pay(LastMonthSalaryDataTable $dataTable)
    {
        return $dataTable->render('admin.pay_salary.last_month_salary');
    }
}
