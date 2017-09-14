<?php

namespace App\DataTables;

use App\Models\Employee;
use Form;
use Yajra\Datatables\Services\DataTable;
use Pimlie\DatatablesMongodb\Facades\DatatablesMongodb as Datatables;

class EmployeeDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return Datatables::moloquent(Employee::query())
            ->addColumn('action', 'employees.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $employees = Employee::query();

        return $this->applyScopes($employees);
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
     * Get columns
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'First Name' => ['name' => 'profile.firstName', 'data' => 'profile.firstName'],
            'Last Name' => ['name' => 'profile.lastName', 'data' => 'profile.lastName'],
            'Company' => ['name' => 'company', 'data' => 'company'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'employees';
    }
}
