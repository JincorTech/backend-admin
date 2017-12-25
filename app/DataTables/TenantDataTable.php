<?php

namespace App\DataTables;

use App\Repositories\TenantRepository;
use Illuminate\Contracts\View\Factory;
use Yajra\Datatables\Datatables as YajraDatatables;
use Yajra\Datatables\Services\DataTable;
use Datatables;

class TenantDataTable extends DataTable
{

    private $tenantRepository;

    public function __construct(YajraDatatables $datatables, Factory $viewFactory, TenantRepository $tenantRepository)
    {
        parent::__construct($datatables, $viewFactory);
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return Datatables::of($this->tenantRepository->all())
            ->addColumn('action', 'tenants.datatables_actions')
            ->make(true);
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
            'email' => ['name' => 'email', 'data' => 'email'],
            'login' => ['name' => 'login', 'data' => 'login'],
            'ttl' => ['name' => 'ttl', 'data' => 'ttl']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'tenants';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        // TODO: Implement query() method.
    }
}
