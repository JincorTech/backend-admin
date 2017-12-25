<?php

namespace App\Http\Controllers;

use App\DataTables\TenantDataTable;
use App\Repositories\TenantRepository;
use Flash;
use Response;

class TenantController extends AppBaseController
{
    /** @var  TenantRepository */
    private $tenantRepository;

    public function __construct(TenantRepository $tenantRepo)
    {
        $this->tenantRepository = $tenantRepo;
    }

    /**
     * Display a listing of the Tenant.
     *
     * @param TenantDataTable $tenantDataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(TenantDataTable $tenantDataTable)
    {
        return $tenantDataTable->render('tenants.index');
    }


    /**
     * Remove the specified Tenant from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tenant = $this->tenantRepository->findWithoutFail($id);

        if (empty($tenant)) {
            Flash::error('Tenant not found');

            return redirect(route('tenants.index'));
        }

        $this->tenantRepository->delete($id);

        Flash::success('Tenant deleted successfully.');

        return redirect(route('tenants.index'));
    }
}
