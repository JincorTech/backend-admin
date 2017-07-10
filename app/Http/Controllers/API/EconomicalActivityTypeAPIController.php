<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEconomicalActivityTypeAPIRequest;
use App\Http\Requests\API\UpdateEconomicalActivityTypeAPIRequest;
use App\Models\EconomicalActivityType;
use App\Repositories\EconomicalActivityTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EconomicalActivityTypeController
 * @package App\Http\Controllers\API
 */

class EconomicalActivityTypeAPIController extends AppBaseController
{
    /** @var  EconomicalActivityTypeRepository */
    private $economicalActivityTypeRepository;

    public function __construct(EconomicalActivityTypeRepository $economicalActivityTypeRepo)
    {
        $this->economicalActivityTypeRepository = $economicalActivityTypeRepo;
    }

    /**
     * Display a listing of the EconomicalActivityType.
     * GET|HEAD /economicalActivityTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->economicalActivityTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->economicalActivityTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $economicalActivityTypes = $this->economicalActivityTypeRepository->all();

        return $this->sendResponse($economicalActivityTypes->toArray(), 'Economical Activity Types retrieved successfully');
    }

    /**
     * Store a newly created EconomicalActivityType in storage.
     * POST /economicalActivityTypes
     *
     * @param CreateEconomicalActivityTypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEconomicalActivityTypeAPIRequest $request)
    {
        $input = $request->all();

        $economicalActivityTypes = $this->economicalActivityTypeRepository->create($input);

        return $this->sendResponse($economicalActivityTypes->toArray(), 'Economical Activity Type saved successfully');
    }

    /**
     * Display the specified EconomicalActivityType.
     * GET|HEAD /economicalActivityTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EconomicalActivityType $economicalActivityType */
        $economicalActivityType = $this->economicalActivityTypeRepository->findWithoutFail($id);

        if (empty($economicalActivityType)) {
            return $this->sendError('Economical Activity Type not found');
        }

        return $this->sendResponse($economicalActivityType->toArray(), 'Economical Activity Type retrieved successfully');
    }

    /**
     * Update the specified EconomicalActivityType in storage.
     * PUT/PATCH /economicalActivityTypes/{id}
     *
     * @param  int $id
     * @param UpdateEconomicalActivityTypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEconomicalActivityTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var EconomicalActivityType $economicalActivityType */
        $economicalActivityType = $this->economicalActivityTypeRepository->findWithoutFail($id);

        if (empty($economicalActivityType)) {
            return $this->sendError('Economical Activity Type not found');
        }

        $economicalActivityType = $this->economicalActivityTypeRepository->update($input, $id);

        return $this->sendResponse($economicalActivityType->toArray(), 'EconomicalActivityType updated successfully');
    }

    /**
     * Remove the specified EconomicalActivityType from storage.
     * DELETE /economicalActivityTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EconomicalActivityType $economicalActivityType */
        $economicalActivityType = $this->economicalActivityTypeRepository->findWithoutFail($id);

        if (empty($economicalActivityType)) {
            return $this->sendError('Economical Activity Type not found');
        }

        $economicalActivityType->delete();

        return $this->sendResponse($id, 'Economical Activity Type deleted successfully');
    }
}
