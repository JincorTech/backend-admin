<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMailingListItemAPIRequest;
use App\Http\Requests\API\UpdateMailingListItemAPIRequest;
use App\Models\MailingListItem;
use App\Repositories\MailingListItemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MailingListItemController
 * @package App\Http\Controllers\API
 */

class MailingListItemAPIController extends AppBaseController
{
    /** @var  MailingListItemRepository */
    private $mailingListItemRepository;

    public function __construct(MailingListItemRepository $mailingListItemRepo)
    {
        $this->mailingListItemRepository = $mailingListItemRepo;
    }

    /**
     * Display a listing of the MailingListItem.
     * GET|HEAD /mailingListItems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->mailingListItemRepository->pushCriteria(new RequestCriteria($request));
        $this->mailingListItemRepository->pushCriteria(new LimitOffsetCriteria($request));
        $mailingListItems = $this->mailingListItemRepository->all();

        return $this->sendResponse($mailingListItems->toArray(), 'Mailing List Items retrieved successfully');
    }

    /**
     * Store a newly created MailingListItem in storage.
     * POST /mailingListItems
     *
     * @param CreateMailingListItemAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMailingListItemAPIRequest $request)
    {
        $input = $request->all();

        $mailingListItems = $this->mailingListItemRepository->create($input);

        return $this->sendResponse($mailingListItems->toArray(), 'Mailing List Item saved successfully');
    }

    /**
     * Display the specified MailingListItem.
     * GET|HEAD /mailingListItems/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MailingListItem $mailingListItem */
        $mailingListItem = $this->mailingListItemRepository->findWithoutFail($id);

        if (empty($mailingListItem)) {
            return $this->sendError('Mailing List Item not found');
        }

        return $this->sendResponse($mailingListItem->toArray(), 'Mailing List Item retrieved successfully');
    }

    /**
     * Update the specified MailingListItem in storage.
     * PUT/PATCH /mailingListItems/{id}
     *
     * @param  int $id
     * @param UpdateMailingListItemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMailingListItemAPIRequest $request)
    {
        $input = $request->all();

        /** @var MailingListItem $mailingListItem */
        $mailingListItem = $this->mailingListItemRepository->findWithoutFail($id);

        if (empty($mailingListItem)) {
            return $this->sendError('Mailing List Item not found');
        }

        $mailingListItem = $this->mailingListItemRepository->update($input, $id);

        return $this->sendResponse($mailingListItem->toArray(), 'MailingListItem updated successfully');
    }

    /**
     * Remove the specified MailingListItem from storage.
     * DELETE /mailingListItems/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MailingListItem $mailingListItem */
        $mailingListItem = $this->mailingListItemRepository->findWithoutFail($id);

        if (empty($mailingListItem)) {
            return $this->sendError('Mailing List Item not found');
        }

        $mailingListItem->delete();

        return $this->sendResponse($id, 'Mailing List Item deleted successfully');
    }
}
