<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ExpenseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ExpenseDataTable $dataTable)
    {
        $date = date("d-m-Y");
        $today = Expense::where('date', $date)->get();
        return $dataTable->render('admin.expanse.index', compact('today'));
        // return view('admin.expanse.index')
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expanse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'details' => 'required',
            'amount' => 'required'
        ]);

        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->month = $request->month;
        $expense->year = $request->year;
        $expense->date = $request->date;
        $expense->created_at = Carbon::now();
        $expense->save();
        return redirect()->back()->with('success', 'Expense added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        return view('admin.expanse.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'details' => 'required',
            'amount' => 'required'
        ]);
        $expense = Expense::findOrFail($id);
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->month = $request->month;
        $expense->year = $request->year;
        $expense->date = $request->date;
        $expense->save();
        return redirect()->route('admin.expense.index')->with('success', 'Expense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response(['status' => 'success', 'message' => 'Advance salary deleted successfully!']);
    }
}
