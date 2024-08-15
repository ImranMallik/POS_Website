<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdvanceSalaryDataTable;
use App\Http\Controllers\Controller;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdvanceSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdvanceSalaryDataTable $dataTable)
    {
        return $dataTable->render('admin.advance_salary.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employee::latest()->get();
        return view('admin.advance_salary.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'advance_salary' => 'max:255',
        ]);

        $employee_id = $request->employee_id;
        $month = $request->month;
        $year = $request->year;
        $advance = AdvanceSalary::where('employee_id', $month)->where('month', $month)->where('year', $year)->first();

        if ($advance) {
            return redirect()->back()->with('error', 'Advance salary for this month and year already exists!');
        } else {
            $advanceSalary = new AdvanceSalary();
            $advanceSalary->employee_id = $request->employee_id;
            $advanceSalary->month = $request->month;
            $advanceSalary->year = $request->year;
            $advanceSalary->advance_salary = $request->advance_salary;
            $advanceSalary->created_at = Carbon::now();
            $advanceSalary->save();
            return redirect()->route('admin.advance-salary.index')->with('success', 'Advance salary added successfully!');
        }
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
        $employee = Employee::latest()->get();
        $salary = AdvanceSalary::findOrFail($id);
        return view('admin.advance_salary.edit', compact('salary', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'advance_salary' => 'max:255',
        ]);
        $advanceSalary = AdvanceSalary::findOrFail($id);
        $advanceSalary->month = $request->month;
        $advanceSalary->year = $request->year;
        $advanceSalary->advance_salary = $request->advance_salary;
        $advanceSalary->created_at = Carbon::now();
        // 'created_at' => Carbon::now(), 
        $advanceSalary->save();
        return redirect()->route('admin.advance-salary.index')->with('success', 'Advance salary updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $advanceData = AdvanceSalary::findOrFail($id);
        $advanceData->delete();
        // return redirect()->route('admin.advance-salary.index')->with('success', 'Advance salary deleted successfully!');
        return response(['status' => 'success', 'message' => 'Advance salary deleted successfully!']);
    }
}
