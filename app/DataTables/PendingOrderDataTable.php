<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\PendingOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendingOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('details', function ($query) {
                $detailsBtn = "<a href='" . route('admin.orderDetails', $query->id) . "' class='btn btn-info mx-2'><i class='fas fa-info-circle'></i> Details</a>";


                return $detailsBtn;
            })
            ->addColumn('image', function ($query) {
                return $img = "<img width = '50px' src='" . asset($query->customerDetails->image) . "'></img>";
            })


            ->addColumn('status', function ($query) {
                $checkboxId = 'statusSwitch_' . $query->id;

                $isChecked = $query->order_status != 'pending';

                $button = '<div class="form-check form-switch">
                    <input class="form-check-input change-status" data-id="' . $query->id . '" type="checkbox" id="' . $checkboxId . '" ' . ($isChecked ? 'checked' : '') . '>
                    <label class="form-check-label" for="' . $checkboxId . '"></label>
                </div>';

                return $button;
            })

            ->addColumn('name', function ($query) {
                return $query->customerDetails->name;
            })

            ->addColumn('payment', function ($query) {
                return $query->payment_status;
            })
            ->addColumn('invoice', function ($query) {
                return $query->invoice_no;
            })

            ->addColumn('pay', function ($query) {
                return '₹' . $query->pay;
            })
            ->addColumn('due', function ($query) {
                return '₹' . $query->due;
            })

            ->rawColumns(['details', 'status', 'image', 'name', 'payment'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->where('order_status', 'pending');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
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
            Column::make('name'),
            Column::make('order_date'),
            Column::make('payment'),
            Column::make('status'),
            Column::make('invoice'),
            Column::make('pay'),
            Column::make('due'),
            Column::computed('details')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PendingOrder_' . date('YmdHis');
    }
}
