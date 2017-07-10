<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyTypeRequest;
use App\Http\Requests\UpdateCompanyTypeRequest;
use App\Models\CompanyType;
use App\Repositories\CompanyTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use MongoDB\BSON\Binary;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Log;

class CompanyTypeController extends AppBaseController
{
    /** @var  CompanyTypeRepository */
    private $companyTypeRepository;

    public function __construct(CompanyTypeRepository $companyTypeRepo)
    {
        $this->companyTypeRepository = $companyTypeRepo;
    }

    /**
     * Display a listing of the CompanyType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->companyTypeRepository->pushCriteria(new RequestCriteria($request));
        $companyTypes = $this->companyTypeRepository->all();
        return view('company_types.index')
            ->with('companyTypes', $companyTypes);
    }

    /**
     * Show the form for creating a new CompanyType.
     *
     * @return Response
     */
    public function create()
    {
        return view('company_types.create');
    }

    /**
     * Store a newly created CompanyType in storage.
     *
     * @param CreateCompanyTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateCompanyTypeRequest $request)
    {
        $input = $request->all();

        $companyType = $this->companyTypeRepository->create($input);

        Flash::success('Company Type saved successfully.');

        return redirect(route('companyTypes.index'));
    }

    /**
     * Display the specified CompanyType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $companyType = $this->companyTypeRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($companyType)) {
            Flash::error('Company Type not found');

            return redirect(route('companyTypes.index'));
        }

        return view('company_types.show')->with('companyType', $companyType);
    }

    /**
     * Show the form for editing the specified CompanyType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $companyType = CompanyType::find(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($companyType)) {
            Flash::error('Company Type not found');

            return redirect(route('companyTypes.index'));
        }

        return view('company_types.edit')->with('companyType', $companyType);
    }

    /**
     * Update the specified CompanyType in storage.
     *
     * @param  string $id
     * @param UpdateCompanyTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompanyTypeRequest $request)
    {
        $companyType = $this->companyTypeRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));
        if (empty($companyType)) {
            Flash::error('Company Type not found');

            return redirect(route('companyTypes.index'));
        }

        $companyType = $this->companyTypeRepository->update($request->all(), new Binary($id, Binary::TYPE_OLD_UUID));

        Flash::success('Company Type updated successfully.');

        return redirect(route('companyTypes.index'));
    }

    /**
     * Remove the specified CompanyType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $companyType = CompanyType::find(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($companyType)) {
            Flash::error('Company Type not found');

            return redirect(route('companyTypes.index'));
        }

        $this->companyTypeRepository->delete(new Binary($id, Binary::TYPE_OLD_UUID));

        Flash::success('Company Type deleted successfully.');

        return redirect(route('companyTypes.index'));
    }
}
