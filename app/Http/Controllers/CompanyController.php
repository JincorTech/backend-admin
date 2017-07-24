<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use MongoDB\BSON\Binary;

class CompanyController extends AppBaseController
{
    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    /**
     * Display a listing of the Company.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $this->companyRepository->pushCriteria(new RequestCriteria($request));
        $companies = $this->companyRepository->all();

        return view('companies.index')
            ->with('companies', $companies);
    }

    /**
     * Display the specified Company.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $company = $this->companyRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($company)) {
            Flash::error('Company not found');

            return redirect(route('companies.index'));
        }

        return view('companies.show')->with('company', $company);
    }

    /**
     * Remove the specified Company from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function block($id)
    {
        $company = $this->companyRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($company)) {
            Flash::error('Company not found');

            return redirect(route('companies.index'));
        }

        $this->companyRepository->update(['blocked' => true], new Binary($id, Binary::TYPE_OLD_UUID));

        Flash::success('Company blocked successfully.');

        return redirect(route('companies.index'));
    }

    /**
     * Remove the specified Company from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function unblock($id)
    {
        $company = $this->companyRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($company)) {
            Flash::error('Company not found');

            return redirect(route('companies.index'));
        }

        $this->companyRepository->update(['blocked' => false], new Binary($id, Binary::TYPE_OLD_UUID));

        Flash::success('Company unblocked successfully.');

        return redirect(route('companies.index'));
    }
}
