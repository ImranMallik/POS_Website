<?php

namespace App\DataTables;

use App\Models\EmployeeAttendance;
use App\Models\EmployeeAttendanceList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeeAttendanceListDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('admin.employee-attendance.edit', $query->id) . "' class='btn btn-primary mx-1'><i class='far fa-edit'></i> </a>";
                $deleteBtn = "<a href='" . route('admin.employee-attendance.destroy', $query->id) . "' class='btn btn-danger mx-1 delet-item'><i class='fas fa-trash-alt'></i> </a>";
                $viewBtn = "<a href='" . route('admin.employee-attendance.show', $query->id) . "' class='btn btn-info mx-1'><i class='far fa-eye'></i> </a>";

                return $editBtn . $viewBtn . $deleteBtn;
            })
            ->addColumn('name', function ($query) {
                return $query->employeeName->name;
            })
            ->addColumn('attend_status', function ($query) {
                $status = $query->attend_status; // Assuming 'status' is the column in your database

                switch ($status) {
                    case 'present':
                        $badge = "<span class='badge badge-success text-success'>Present</span>";
                        break;
                    case 'leave':
                        $badge = "<span class='badge badge-warning text-warning'>Leave</span>";
                        break;
                    case 'absent':
                        $badge = "<span class='badge badge-danger text-danger'>Absent</span>";
                        break;
                    default:
                        $badge = "<span class='badge badge-secondary'>Unknown</span>";
                        break;
                }

                return $badge;
            })

            ->rawColumns(['action', 'name', 'attend_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(EmployeeAttendance $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('employeeattendance-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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

            Column::make('id'),
            Column::make('name'),
            Column::make('attend_status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'EmployeeAttendanceList_' . date('YmdHis');
    }
}
