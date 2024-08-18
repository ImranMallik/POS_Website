<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\YearExpenseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class YearExpenseController extends Controller
{
    public function yearExpense(YearExpenseDataTable $dataTable)
    {
        $year = date("Y");
        $yearexpense = Expense::where('year', $year)->get();
        return $dataTable->render('admin.expanse.year_expence', compact('yearexpense'));
    }
}
