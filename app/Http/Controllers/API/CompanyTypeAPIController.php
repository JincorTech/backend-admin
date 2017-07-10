<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompanyTypeAPIRequest;
use App\Http\Requests\API\UpdateCompanyTypeAPIRequest;
use App\Models\CompanyType;
use App\Repositories\CompanyTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CompanyTypeController
 * @package App\Http\Controllers\API
 */

class CompanyTypeAPIController extends AppBaseController
{
    /** @var  CompanyTypeRepository */
    private $companyTypeRepository;

    public function __construct(CompanyTypeRepository $companyTypeRepo)
    {
        $this->companyTypeRepository = $companyTypeRepo;
    }

    /**
     * Display a listing of the CompanyType.
     * GET|HEAD /companyTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->companyTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->companyTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $companyTypes = $this->companyTypeRepository->all();

        return $this->sendResponse($companyTypes->toArray(), 'Company Types retrieved successfully');
    }

    /**
     * Store a newly created CompanyType in storage.
     * POST /companyTypes
     *
     * @param CreateCompanyTypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCompanyTypeAPIRequest $request)
    {
        $input = $request->all();

        $companyTypes = $this->companyTypeRepository->create($input);

        return $this->sendResponse($companyTypes->toArray(), 'Company Type saved successfully');
    }

    /**
     * Display the specified CompanyType.
     * GET|HEAD /companyTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CompanyType $companyType */
        $companyType = $this->companyTypeRepository->findWithoutFail($id);

        if (empty($companyType)) {
            return $this->sendError('Company Type not found');
        }

        return $this->sendResponse($companyType->toArray(), 'Company Type retrieved successfully');
    }

    /**
     * Update the specified CompanyType in storage.
     * PUT/PATCH /companyTypes/{id}
     *
     * @param  int $id
     * @param UpdateCompanyTypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompanyTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var CompanyType $companyType */
        $companyType = $this->companyTypeRepository->findWithoutFail($id);

        if (empty($companyType)) {
            return $this->sendError('Company Type not found');
        }

        $companyType = $this->companyTypeRepository->update($input, $id);

        return $this->sendResponse($companyType->toArray(), 'CompanyType updated successfully');
    }

    /**
     * Remove the specified CompanyType from storage.
     * DELETE /companyTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CompanyType $companyType */
        $companyType = $this->companyTypeRepository->findWithoutFail($id);

        if (empty($companyType)) {
            return $this->sendError('Company Type not found');
        }

        $companyType->delete();

        return $this->sendResponse($id, 'Company Type deleted successfully');
    }
}
