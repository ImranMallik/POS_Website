<?php

namespace App\DataTables;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SupplierDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.supplier.edit', $query->id) . "' class='btn btn-primary mx-2'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.supplier.destroy', $query->id) . "' class='btn btn-danger ml-2 delet-item'><i class='fas fa-trash-alt'></i></a>";
                $detailsBtn = "<a href='" . route('admin.supplier-details', $query->id) . "' class='btn btn-info mx-2'><i class='fas fa-info-circle'></i></a>";

                return $editBtn . $deleteBtn . $detailsBtn;
            })
            ->addColumn('image', function ($query) {
                return $img = "<img width = '50px' src='" . asset($query->image) . "'></img>";
            })
            ->addColumn('type', function ($query) {
                if ($query->type == 'Distributor') {
                    return '<span class="badge bg-primary">Distributor</span>';
                } elseif ($query->type == 'Whole Seller') {
                    return '<span class="badge bg-success">Whole Seller</span>';
                } else {
                    return '<span class="badge bg-secondary">' . $query->type . '</span>';
                }
            })
            ->rawColumns(['image', 'action', 'type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Supplier $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('supplier-table')
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
            Column::make('image')->width(200),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('type'),
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
        return 'Supplier_' . date('YmdHis');
    }
}
