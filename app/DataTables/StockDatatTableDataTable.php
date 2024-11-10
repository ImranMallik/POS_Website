<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\StockDatatTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StockDatatTableDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('product_store', function ($query) {
                if ($query->product_store > 20) {
                    return '<span class="badge bg-success" style="padding: 5px 10px;">' . $query->product_store . '</span>';
                } elseif ($query->product_store > 0 && $query->product_store <= 20) {
                    return '<span class="badge bg-warning" style="padding: 5px 10px;">' . $query->product_store . '</span>';
                } else {
                    return '<span class="badge bg-danger" style="padding: 5px 10px;">Out of Stock</span>';
                }
            })

            ->addColumn('image', function ($query) {
                return $img = "<img width = '50px' src='" . asset($query->product_image) . "'></img>";
            })
            ->addColumn('category', function ($query) {
                return $query->category->category_name;
            })
            ->addColumn('supplier', function ($query) {
                return $query->supplier->name;
            })
            ->addColumn('price', function ($query) {
                return '₹' . $query->selling_price;
            })
            ->rawColumns(['product_store', 'image', 'price', 'category', 'supplier'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('stockdatattable-table')
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
            Column::make('image'),
            Column::make('product_name'),
            Column::make('category'),
            Column::make('supplier'),
            Column::make('product_code'),
            Column::make('price'),
            Column::computed('product_store')
                ->title('Stock Status')
                ->exportable(true)
                ->printable(true)
                ->width(200)
                ->addClass('text-center')

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'StockDatatTable_' . date('YmdHis');
    }
}
