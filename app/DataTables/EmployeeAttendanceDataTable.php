<?php

namespace App\DataTables;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeeAttendanceDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('employee_name', function ($employee) {
                return $employee->name;
            })
            ->addColumn('attendance_status', function ($employee) {
                return view('admin.employee_attendance.attendance_checkboxes', compact('employee'))->render();
            })


            ->rawColumns(['attendance_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Employee $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('employee-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('Sl.')->addClass('text-center'),
            Column::make('employee_name')
                ->title('Employee Name')
                ->addClass('text-center font-weight-bold'),
            Column::computed('attendance_status')->width(200)
                ->title('Attendance Status')
                ->addClass('text-center')
                ->orderable(false)
                ->exportable(false)
                ->printable(false),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'EmployeeAttendance_' . date('YmdHis');
    }
}
