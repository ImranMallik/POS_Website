<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\EmployeeAttendanceDataTable;
use App\DataTables\EmployeeAttendanceListDataTable;
use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeeAttendanceDataTable $dataTable)
    {
        return $dataTable->render('admin.employee_attendance.index');
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
        $employyeData = EmployeeAttendance::with('employeeName')->findOrFail($id);

        return view('admin.employee_attendance.edit', compact('employyeData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $request->validate([
            'attend_status' => 'required|in:present,leave,absent',
            'date' => 'required|date',
        ]);

        $attendance = EmployeeAttendance::findOrFail($id);
        $attendance->attend_status = $request->attend_status;
        $attendance->date = $request->date;
        $attendance->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EmployeeAttendance::findOrFail($id);
        $data->delete();
        return response(['status' => 'success', 'message' => 'Advance salary deleted successfully!']);
    }

    public function attendancesubmit(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $attendStatus = $request->input('attend_status'); // This should be a string

        // Ensure $attendStatus is treated as a string, not as an array
        if (!is_string($attendStatus)) {
            return response()->json(['error' => 'Invalid attendance status'], 400);
        }

        // Proceed with saving the attendance status
        $attendance = EmployeeAttendance::updateOrCreate(
            ['employee_id' => $employeeId, 'date' => now()->format('Y-m-d')],
            ['attend_status' => $attendStatus]
        );

        return response()->json(['success' => true, 'message' => 'Attendance updated successfully']);
    }

    public function listAllAttendance(EmployeeAttendanceListDataTable $dataTable)
    {

        return $dataTable->render('admin.employee_attendance.list');
    }
}
