<?php

namespace App\DataTables;

use App\Models\Solar;
use App\Models\SolarCsv;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SolarDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('billingBackClass', function($query) {
                return $query->billing ? 'billing-true' : '';
            })
            ->addColumn('action', 'solar.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Solar::query();
        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">')

                    ->parameters([
                        "processing" => true,
                        "autoWidth" => false,
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'date', 'name' => 'date', 'title' => '利用年月', 'orderable' => false],
            ['data' => 'customer_number', 'name' => 'customer_number', 'title' => '顧客番号'],
            ['data' => 'serial_number', 'name' => 'serial_number', 'title' => 'GW製造番号'],
            ['data' => 'electricity_number', 'name' => 'electricity_number', 'title' => '電気番号'],
            ['data' => 'connection_date', 'name' => 'connection_date', 'title' => '連系日'],
            ['data' => 'start_date', 'name' => 'start_date', 'title' => '利用開始日'],
            ['data' => 'end_date', 'name' => 'end_date', 'title' => '利用終了日	'],
            ['data' => 'generation_billing', 'name' => 'generation_billing', 'title' => '発電量_請求'],
            ['data' => 'power_sales', 'name' => 'power_sales', 'title' => '余剰売電量(kWh)'],
            ['data' => 'self_consumption', 'name' => 'self_consumption', 'title' => '自家消費(kWh)'],
            ['data' => 'meter_reading_date', 'name' => 'meter_reading_date', 'title' => '基本検針日'],
            ['data' => 'address', 'name' => 'address', 'title' => '住所'],
            ['data' => 'billing', 'name' => 'billing', 'title' => '請求'],
            Column::computed('action')
                  ->title('操作')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center hide-search'),
        ];
    }

}
