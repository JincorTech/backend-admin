<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 31.07.17
 * Time: 15:00
 */


namespace App\Http\Controllers;

use App\Repositories\EconomicalActivityTypeRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use MongoDB\BSON\Binary;
use App\Models\EconomicalActivityType;
use Doctrine\ODM\MongoDB\DocumentManager;
use App;
use App\Repositories\CompanyTypeRepository;

class DashboardController
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * @var CompanyTypeRepository
     */
    private $companyTypeRepository;

    public function __construct(
        CompanyRepository $companyRepository,
        CompanyTypeRepository $companyTypeRepository
    )
    {
        $this->companyRepository = $companyRepository;
        $this->companyTypeRepository = $companyTypeRepository;
    }

    /**
     * Display a listing of the EconomicalActivityType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        /**
         * @var $repo EconomicalActivityTypeRepository
         */
        $repo = App::make(DocumentManager::class)->getRepository(EconomicalActivityType::class);
        $tree = $repo->getTree();

        $economicalActivityCounts = [];
        foreach ($tree as $node) {
            $economicalActivityTypesCursor = Company::raw()->aggregate([
                [
                    '$project' => [
                        'haveType' => [
                            '$in' => [
                                new Binary($node->getId(), Binary::TYPE_OLD_UUID),
                                '$economicalActivityTypesIds',
                            ],
                        ],
                    ],
                ],
                [
                    '$match' => [
                        'haveType' => true,
                    ],
                ],
                [
                    '$count' => 'count',
                ],
            ]);
            $compCount = $economicalActivityTypesCursor->toArray();

            $tempCount = 0;
            if (count($compCount) > 0) {
                $tempCount = (int)$compCount[0]['count'];
            }

            $copy = $node;

            if ($tempCount > 0) {
                while ($parent = $copy->getParent()) {
                    if (isset($economicalActivityCounts[$parent->getId()])) {
                        $economicalActivityCounts[$parent->getId()] += $tempCount;
                    } else {
                        $economicalActivityCounts[$parent->getId()] = $tempCount;
                    }
                    $copy = $parent;
                }
            }

            $economicalActivityCounts[$node->getId()] = $tempCount;
        }

        $companyTypeCountStat = $this->companyTypeRepository->getCompanyTypeStat();

        $countryStat = $this->companyRepository->getCountryCountStat();

        $employeeCountStat = $this->companyRepository->getEmployeeCountStat();

        return view('dashboard.index')->with([
            'companyCount' => Company::count(),
            'employeeCount' => Employee::count(),
            'employeeRegistrations' => Employee::where('registeredAt', '>', new \DateTime('-1 day'))->count(),
            'companyTypeCountStat' => $companyTypeCountStat,
            'countryCountStat' => $countryStat,
            'employeeCountStat' => $employeeCountStat,
            'repo' => $repo,
            'economicalCounts' => $economicalActivityCounts,
        ]);
    }
}
