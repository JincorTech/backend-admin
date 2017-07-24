<?php

namespace App\DataTables;

use App\Models\MailingListItem;
use Form;
use Yajra\Datatables\Services\DataTable;
use Yajra\Datatables\Facades\Datatables;

class MailingListItemDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return Datatables::of(MailingListItem::query()->get())
                ->addColumn('action', 'mailing_list_items.datatables_actions')
                ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $mailingListItems = MailingListItem::query();

        return $this->applyScopes($mailingListItems);
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
            'email' => ['name' => 'email', 'data' => 'email'],
            'mailingListId' => ['name' => 'mailingListId', 'data' => 'mailingListId'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'mailingListItems';
    }
}
