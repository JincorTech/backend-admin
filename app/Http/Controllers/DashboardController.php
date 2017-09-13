<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 31.07.17
 * Time: 15:00
 */


namespace App\Http\Controllers;

use Doctrine\ODM\MongoDB\DocumentManager;
use App\Models\EconomicalActivityType;
use App;
use App\Repositories\StatisticsRepository;
use Illuminate\Http\Request;

class DashboardController extends AppBaseController
{
    /**
     * @var StatisticsRepository
     */
    private $statisticsRepository;

    public function __construct(
        StatisticsRepository $statisticsRepository
    )
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    /**
     * Display a listing of the EconomicalActivityType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('dashboard.index')->with([
            'companyCount' => $this->statisticsRepository->totalCompaniesCount(),
            'employeeCount' => $this->statisticsRepository->totalEmployeesCount(),
            'employeeRegistrations' => $this->statisticsRepository->last24hoursEmployeeRegistrationsCount(),
            'companyTypeCountStat' => $this->statisticsRepository->getCompanyCountByType(),
            'countryCountStat' => $this->statisticsRepository->getCompanyCountByCountry(),
            'employeeCountStat' => $this->statisticsRepository->getCompanyCountByEmployeeCount(),
            'economicalActivitiesRepo' => App::make(DocumentManager::class)->getRepository(EconomicalActivityType::class),
            'economicalCounts' => $this->statisticsRepository->getCompanyCountByEconomicalActivities(),
        ]);
    }
}
