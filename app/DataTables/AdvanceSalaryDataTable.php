<?php

namespace App\DataTables;

use App\Models\AdvanceSalary;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdvanceSalaryDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.advance-salary.edit', $query->id) . "' class='btn btn-primary mx-2'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.advance-salary.destroy', $query->id) . "' class='btn btn-danger ml-2 delet-item'><i class='fas fa-trash-alt'></i></a>";


                return $editBtn . $deleteBtn;
            })
            ->addColumn('image', function ($query) {
                return $img = "<img width = '50px' src='" . asset($query->employee->image) . "'></img>";
            })
            ->addColumn('name', function ($query) {
                return $query->employee->name;
            })
            ->addColumn('salary', function ($query) {
                $salary = $query->employee->salary;
                if ($salary) {

                    return '<span class="badge bg-primary">₹ ' . $salary . '</span>';
                } else {
                    return '<span class="badge bg-warning">Salary Not Set</span>';
                }
            })

            ->addColumn('advance', function ($query) {
                $advance = $query->advance_salary;

                if ($advance == 0) {
                    return '<span class="badge bg-success">Paid</span>';
                } else if (is_numeric($advance) && $advance > 0) {
                    return '<span class="badge bg-primary">₹ ' . number_format($advance, 2) . '</span>';
                } else {
                    return '<span class="badge bg-warning">Salary Not Set</span>';
                }
            })



            ->rawColumns(['action', 'image', 'name', 'salary', 'advance'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AdvanceSalary $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('advancesalary-table')
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

            Column::make('id'),
            Column::make('image'),
            Column::make('name'),
            Column::make('month'),
            Column::make('year'),
            Column::make('salary'),
            Column::make('advance'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AdvanceSalary_' . date('YmdHis');
    }
}
