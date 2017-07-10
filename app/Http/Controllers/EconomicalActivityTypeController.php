<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEconomicalActivityTypeRequest;
use App\Http\Requests\UpdateEconomicalActivityTypeRequest;
use App\Repositories\EconomicalActivityTypeRepository;
use App\Models\EconomicalActivityType;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Doctrine\ODM\MongoDB\DocumentManager;
use App;
use Illuminate\Support\Facades\Log;

class EconomicalActivityTypeController extends AppBaseController
{
    /** @var  EconomicalActivityTypeRepository */
    private $economicalActivityTypeRepository;

    public function __construct()
    {
        $this->economicalActivityTypeRepository = App::make(DocumentManager::class)->getRepository(EconomicalActivityType::class);
    }

    /**
     * Display a listing of the EconomicalActivityType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('economical_activity_types.index')
            ->with('repo', $this->economicalActivityTypeRepository);
    }

    /**
     * Show the form for creating a new EconomicalActivityType.
     *
     * @return View
     */
    public function create()
    {
        $allTypes = $this->economicalActivityTypeRepository->getAllForDropdown();
        return view('economical_activity_types.create')
                ->with('allTypes', $allTypes);
    }

    /**
     * Store a newly created EconomicalActivityType in storage.
     *
     * @param CreateEconomicalActivityTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateEconomicalActivityTypeRequest $request)
    {
        $input = $request->all();

        $economicalActivityType = new EconomicalActivityType($input['names'], $input['internalCode']);

        $parentId = $request->get('parent');
        if (!empty($parentId)) {
            $parent = $this->economicalActivityTypeRepository->find($parentId);
            $economicalActivityType->setParent($parent);
        }
        /**
         * @var $dm DocumentManager
         */
        $dm = App::make(DocumentManager::class);
        $dm->persist($economicalActivityType);
        $dm->flush();

        Flash::success('Economical Activity Type saved successfully.');

        return redirect(route('economicalActivityTypes.index'));
    }

    /**
     * Show the form for editing the specified EconomicalActivityType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $economicalActivityType = $this->economicalActivityTypeRepository->find($id);
        $allTypes = $this->economicalActivityTypeRepository->getAllForDropdown();

        if (empty($economicalActivityType)) {
            Flash::error('Economical Activity Type not found');

            return redirect(route('economicalActivityTypes.index'));
        }

        return view('economical_activity_types.edit')
                ->with('economicalActivityType', $economicalActivityType)
                ->with('allTypes', $allTypes);
    }

    /**
     * Update the specified EconomicalActivityType in storage.
     *
     * @param  int              $id
     * @param UpdateEconomicalActivityTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEconomicalActivityTypeRequest $request)
    {
        /**
         * @var $economicalActivityType EconomicalActivityType
         */
        $economicalActivityType = $this->economicalActivityTypeRepository->find($id);

        if (empty($economicalActivityType)) {
            Flash::error('Economical Activity Type not found');

            return redirect(route('economicalActivityTypes.index'));
        }

        $economicalActivityType->setNames($request->get('names'));
        $economicalActivityType->setCode($request->get('internalCode'));

        $parentId = $request->get('parent');
        if ($parentId !== $economicalActivityType->getParentId()) {
            $parent = $this->economicalActivityTypeRepository->find($parentId);
            $economicalActivityType->setParent($parent);
        }

        /**
         * @var $dm DocumentManager
         */
        $dm = App::make(DocumentManager::class);
        $dm->persist($economicalActivityType);
        $dm->flush();

        Flash::success('Economical Activity Type updated successfully.');

        return redirect(route('economicalActivityTypes.index'));
    }

    /**
     * Remove the specified EconomicalActivityType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * @var $dm DocumentManager
         */
        $dm = App::make(DocumentManager::class);

        $economicalActivityType = $dm->find(EconomicalActivityType::class, $id);

        if (empty($economicalActivityType)) {
            Flash::error('Economical Activity Type not found');

            return redirect(route('economicalActivityTypes.index'));
        }

        $this->economicalActivityTypeRepository->removeFromTree($economicalActivityType);
        $dm->clear();

        Flash::success('Economical Activity Type deleted successfully.');

        return redirect(route('economicalActivityTypes.index'));
    }
}
