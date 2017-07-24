<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMailingListItemRequest;
use App\Http\Requests\UpdateMailingListItemRequest;
use App\Repositories\MailingListItemRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use MongoDB\BSON\Binary;
use App\Services\MailgunService;
use App\DataTables\MailingListItemDataTable;

class MailingListItemController extends AppBaseController
{
    /** @var  MailingListItemRepository */
    private $mailingListItemRepository;

    private $mailgunService;

    /**
     * MailingListItemController constructor.
     * @param MailingListItemRepository $mailingListItemRepo
     * @param MailgunService $mailgunService
     */
    public function __construct(
        MailingListItemRepository $mailingListItemRepo,
        MailgunService $mailgunService
    )
    {
        $this->mailingListItemRepository = $mailingListItemRepo;
        $this->mailgunService = $mailgunService;
    }

    /**
     * Display a listing of the MailingListItem.
     *
     * @param MailingListItemDataTable $mailingListItemDataTable
     * @return Response
     */
    public function index(MailingListItemDataTable $mailingListItemDataTable)
    {
        return $mailingListItemDataTable->render('mailing_list_items.index');
    }

    /**
     * Show the form for creating a new MailingListItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('mailing_list_items.create');
    }

    /**
     * Store a newly created MailingListItem in storage.
     *
     * @param CreateMailingListItemRequest $request
     *
     * @return Response
     */
    public function store(CreateMailingListItemRequest $request)
    {
        $input = $request->all();

        $mailingListItem = $this->mailingListItemRepository->create($input);

        $this->mailgunService->addItemToList($mailingListItem);

        Flash::success('Mailing List Item saved successfully.');

        return redirect(route('mailingListItems.index'));
    }

    /**
     * Display the specified MailingListItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mailingListItem = $this->mailingListItemRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($mailingListItem)) {
            Flash::error('Mailing List Item not found');

            return redirect(route('mailingListItems.index'));
        }

        return view('mailing_list_items.show')->with('mailingListItem', $mailingListItem);
    }

    /**
     * Remove the specified MailingListItem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mailingListItem = $this->mailingListItemRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($mailingListItem)) {
            Flash::error('Mailing List Item not found');

            return redirect(route('mailingListItems.index'));
        }

        $this->mailingListItemRepository->delete(new Binary($id, Binary::TYPE_OLD_UUID));

        $this->mailgunService->deleteItemFromList($mailingListItem);

        Flash::success('Mailing List Item deleted successfully.');

        return redirect(route('mailingListItems.index'));
    }
}
