<?php

namespace App\DataTables;

use App\Models\City;
use Form;
use Yajra\Datatables\Services\DataTable;
use Pimlie\DatatablesMongodb\Facades\DatatablesMongodb as Datatables;

class CityDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return Datatables::moloquent($this->query())
            ->addColumn('action', 'cities.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $cities = City::query();

        return $this->applyScopes($cities);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'Russian Name' => ['name' => 'names.values.ru', 'data' => 'names.values.ru'],
            'English Name' => ['name' => 'names.values.en', 'data' => 'names.values.en'],
            'Country' => ['name' => 'country.names.en', 'data' => 'country.names.en'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'cities';
    }
}
