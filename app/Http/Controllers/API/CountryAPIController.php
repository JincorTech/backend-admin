<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCountryAPIRequest;
use App\Http\Requests\API\UpdateCountryAPIRequest;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CountryController
 * @package App\Http\Controllers\API
 */

class CountryAPIController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     * GET|HEAD /countries
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->countryRepository->pushCriteria(new RequestCriteria($request));
        $this->countryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $countries = $this->countryRepository->all();

        return $this->sendResponse($countries->toArray(), 'Countries retrieved successfully');
    }

    /**
     * Store a newly created Country in storage.
     * POST /countries
     *
     * @param CreateCountryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryAPIRequest $request)
    {
        $input = $request->all();

        $countries = $this->countryRepository->create($input);

        return $this->sendResponse($countries->toArray(), 'Country saved successfully');
    }

    /**
     * Display the specified Country.
     * GET|HEAD /countries/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Country $country */
        $country = $this->countryRepository->findWithoutFail($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        return $this->sendResponse($country->toArray(), 'Country retrieved successfully');
    }

    /**
     * Update the specified Country in storage.
     * PUT/PATCH /countries/{id}
     *
     * @param  int $id
     * @param UpdateCountryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Country $country */
        $country = $this->countryRepository->findWithoutFail($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        $country = $this->countryRepository->update($input, $id);

        return $this->sendResponse($country->toArray(), 'Country updated successfully');
    }

    /**
     * Remove the specified Country from storage.
     * DELETE /countries/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Country $country */
        $country = $this->countryRepository->findWithoutFail($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        $country->delete();

        return $this->sendResponse($id, 'Country deleted successfully');
    }
}
