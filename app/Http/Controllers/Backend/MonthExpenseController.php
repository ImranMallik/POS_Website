<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\MonthExpenseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class MonthExpenseController extends Controller
{
    public function monthExpense(MonthExpenseDataTable $dataTable)
    {
        $month = date("F");
        $today = Expense::where('month', $month)->get();
        return $dataTable->render('admin.expanse.month_expence', compact('today'));
    }
}
