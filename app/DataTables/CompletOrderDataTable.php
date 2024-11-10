<?php

namespace App\DataTables;

use App\Models\CompletOrder;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompletOrderDataTable extends DataTable
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
                $downloadInvoiceBtn = "<a href='" . route('admin.invoice-download', $query->id) . "' class='btn btn-warning mx-2' target='_blank'><i class='fas fa-download'></i> Invoice</a>";


                return $downloadInvoiceBtn;
            })
            ->addColumn('image', function ($query) {
                return $img = "<img width = '50px' src='" . asset($query->customerDetails->image) . "'></img>";
            })


            ->addColumn('status', function ($query) {
                if ($query->order_status === 'complete') {
                    $badge = '<span class="badge bg-success">Complete</span>';
                    return $badge;
                } elseif ($query->order_status === 'pending') {
                    $badge = '<span class="badge bg-warning">Pending</span>';
                    return $badge;
                }
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
        return $model->where('order_status', 'complete');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('completorder-table')
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
        return 'CompletOrder_' . date('YmdHis');
    }
}
