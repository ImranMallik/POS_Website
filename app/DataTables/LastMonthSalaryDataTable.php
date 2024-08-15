<?php

namespace App\DataTables;

use App\Models\LastMonthSalary;
use App\Models\PaySalary;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LastMonthSalaryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function ($query) {
                return $img = "<img width = '50px' src='" . asset($query->employeeDetails->image) . "'></img>";
            })
            ->addColumn('name', function ($query) {
                return $query->employeeDetails->name;
            })
            ->addColumn('salary', function ($query) {
                return '₹ ' . number_format($query->employeeDetails->salary, 2);
            })

            ->rawColumns(['image', 'name', 'salary',])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PaySalary $model): QueryBuilder
    {
        $lastMonth = now()->subMonth()->format('F'); // Get the previous month's name
        return $model->newQuery()->where('salary_month', $lastMonth);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('paysalary-table')
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
            Column::make('name'),
            Column::make('image'),
            Column::make('salary_month'),
            Column::make('salary'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LastMonthSalary_' . date('YmdHis');
    }
}
