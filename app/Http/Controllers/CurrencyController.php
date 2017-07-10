<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Repositories\CurrencyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use MongoDB\BSON\Binary;

class CurrencyController extends AppBaseController
{
    /** @var  CurrencyRepository */
    private $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepo)
    {
        $this->currencyRepository = $currencyRepo;
    }

    /**
     * Display a listing of the Currency.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->currencyRepository->pushCriteria(new RequestCriteria($request));
        $currencies = $this->currencyRepository->all();

        return view('currencies.index')
            ->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new Currency.
     *
     * @return Response
     */
    public function create()
    {
        return view('currencies.create');
    }

    /**
     * Store a newly created Currency in storage.
     *
     * @param CreateCurrencyRequest $request
     *
     * @return Response
     */
    public function store(CreateCurrencyRequest $request)
    {
        $input = $request->all();

        $currency = $this->currencyRepository->create($input);

        Flash::success('Currency saved successfully.');

        return redirect(route('currencies.index'));
    }

    /**
     * Display the specified Currency.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $currency = $this->currencyRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        return view('currencies.show')->with('currency', $currency);
    }

    /**
     * Show the form for editing the specified Currency.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $currency = $this->currencyRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        return view('currencies.edit')->with('currency', $currency);
    }

    /**
     * Update the specified Currency in storage.
     *
     * @param  int              $id
     * @param UpdateCurrencyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCurrencyRequest $request)
    {
        $currency = $this->currencyRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        $currency = $this->currencyRepository->update($request->all(), new Binary($id, Binary::TYPE_OLD_UUID));

        Flash::success('Currency updated successfully.');

        return redirect(route('currencies.index'));
    }

    /**
     * Remove the specified Currency from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $currency = $this->currencyRepository->findWithoutFail(new Binary($id, Binary::TYPE_OLD_UUID));

        if (empty($currency)) {
            Flash::error('Currency not found');

            return redirect(route('currencies.index'));
        }

        $this->currencyRepository->delete(new Binary($id, Binary::TYPE_OLD_UUID));

        Flash::success('Currency deleted successfully.');

        return redirect(route('currencies.index'));
    }
}
