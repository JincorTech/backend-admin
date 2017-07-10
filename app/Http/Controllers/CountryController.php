<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use App\Repositories\CurrencyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use MongoDB\BSON\Binary;

class CountryController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    private $currencyRepository;

    public function __construct(CountryRepository $countryRepo, CurrencyRepository $currencyRepository)
    {
        $this->countryRepository = $countryRepo;
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Display a listing of the Country.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->countryRepository->pushCriteria(new RequestCriteria($request));
        $countries = $this->countryRepository->all();

        return view('countries.index')
            ->with('countries', $countries);
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */
    public function create()
    {
        $currencies = $this->currencyRepository->getAllForDropdown();

        return view('countries.create')
                ->with('currencies', $currencies);
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        $input = $request->all();

        $country = $this->countryRepository->create($input);

        Flash::success('Country saved successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Display the specified Country.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $country = $this->countryRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.show')->with('country', $country);
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $country = $this->countryRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));
        $currencies = $this->currencyRepository->getAllForDropdown();

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.edit')
                ->with('country', $country)
                ->with('currencies', $currencies);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param  int              $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        $country = $this->countryRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $country = $this->countryRepository->update($request->all(), new Binary($id, Binary::TYPE_OLD_UUID));

        Flash::success('Country updated successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $country = $this->countryRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $this->countryRepository->delete(new Binary($id, Binary::TYPE_OLD_UUID));

        Flash::success('Country deleted successfully.');

        return redirect(route('countries.index'));
    }
}
