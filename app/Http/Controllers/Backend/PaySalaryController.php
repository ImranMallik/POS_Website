<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PaySalaryDataTable;
use App\Http\Controllers\Controller;
use App\Models\AdvanceSalary;
use App\Models\PaySalary;
use Illuminate\Http\Request;

class PaySalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaySalaryDataTable $dataTable)
    {
        return $dataTable->render('admin.pay_salary.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Pay Now
    public function payNow(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'id' => 'required|exists:advance_salaries,id',
        //     'paid_amount' => 'required|numeric|min:0',
        // ]);

        $advanceSalary = AdvanceSalary::find($request->id);

        // Calculate due salary
        $salary = $advanceSalary->employee->salary;
        $currentAdvance = $advanceSalary->advance_salary;
        $newAdvance = $currentAdvance + $request->paid_amount;
        $due_salary = $salary - $newAdvance;

        // Create a new PaySalary record
        $paySalary = PaySalary::create([
            'employee_id' => $advanceSalary->employee_id,
            'salary_month' => $advanceSalary->month,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $advanceSalary->advance_salary,
            'due_salary' => $due_salary,
        ]);
        $advanceSalary->update([
            'advance_salary' => 0,
            'is_paid' => true,
        ]);

        // Return a JSON response
        return response()->json(['success' => true]);
    }
}
