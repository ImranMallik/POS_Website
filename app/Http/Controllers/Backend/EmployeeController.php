<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\EmployeeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use ImageUploadTraits;
    //

    public function index(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('admin.employee.index');
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'experience' => 'required',
            'salary' => 'required',
            'vacation' => 'required',
            'city' => 'required',
            'image' => 'required|image|max:2048'
        ]);

        $employeeData = new Employee();
        $imagePath = $this->updateImage($request, 'image', 'upload');
        $employeeData->image = $imagePath;
        $employeeData->name = $request->name;
        $employeeData->email = $request->email;
        $employeeData->phone = $request->phone;
        $employeeData->address = $request->address;
        $employeeData->experience = $request->experience;
        $employeeData->salary = $request->salary;
        $employeeData->vacation = $request->vacation;
        $employeeData->city = $request->city;
        $employeeData->save();
        // toastr('Employee Added Successfully!', 'success');
        return redirect()->route('admin.employees.index')->with('success', 'Employee Added Successfully!');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('admin.employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'experience' => 'required',
            'salary' => 'required',
            'vacation' => 'required',
            'city' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);
        $employeeData = Employee::find($id);
        $imagePath = $this->updateImage($request, 'image', 'upload', $employeeData->image);
        $employeeData->image = empty(!$imagePath) ? $imagePath : $employeeData->image;
        // $employeeData->image = $imagePath;
        $employeeData->name = $request->name;
        $employeeData->email = $request->email;
        $employeeData->phone = $request->phone;
        $employeeData->address = $request->address;
        $employeeData->experience = $request->experience;
        $employeeData->salary = $request->salary;
        $employeeData->vacation = $request->vacation;
        $employeeData->city = $request->city;
        $employeeData->save();
        // toastr('Employee Updated Successfully!', 'success');
        return redirect()->route('admin.employees.index')->with('success', 'Employee Updated Successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $this->deleteImage($employee->image);
        $employee->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
