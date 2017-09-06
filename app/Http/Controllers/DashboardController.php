<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 31.07.17
 * Time: 15:00
 */


namespace App\Http\Controllers;

use App\Repositories\EconomicalActivityTypeRepository;
use Illuminate\Http\Request;
use App\Models\CompanyType;
use App\Models\Company;
use MongoDB\BSON\Binary;
use App\Models\EconomicalActivityType;
use Doctrine\ODM\MongoDB\DocumentManager;
use App;
use App\Repositories\DepartmentRepository;
use App\Models\Department;

class DashboardController
{
    /**
     * Display a listing of the EconomicalActivityType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $companyTypesCursor = CompanyType::raw()->aggregate([
            [
                '$lookup' => [
                    'from' => 'companies',
                    'localField' => '_id',
                    'foreignField' => 'companyTypeID',
                    'as' => 'companies',
                ],
            ],
        ]);

        $labels = [];
        $counts = [];
        foreach ($companyTypesCursor as $item) {
            $labels[] = $item['names']['values']['en'];
            $counts[] = count($item['companies']);
        }

        /**
         * @var $repo EconomicalActivityTypeRepository
         */
        $repo = App::make(DocumentManager::class)->getRepository(EconomicalActivityType::class);
        $parentId = 'fe358a2e-4247-45db-8932-c8d00c8616d4';
        $parent = $repo->find($parentId);
        $tree = $repo->getTree();


        $results = [];
        foreach ($tree as $node) {
            $economicalActivityTypesCursor = Company::raw()->aggregate([
                [
                    '$project' => [
                        'haveType' => [
                            '$in' => [
                                new Binary($node->getId(), Binary::TYPE_OLD_UUID),
                                '$economicalActivityTypesIDs',
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
                    if (isset($results[$parent->getId()])) {
                        $results[$parent->getId()] += $tempCount;
                    } else {
                        $results[$parent->getId()] = $tempCount;
                    }
                    $copy = $parent;
                }
            }

            $results[$node->getId()] = $tempCount;
        }

        $employeeCountCursor = Company::raw()->aggregate([
            [
                '$lookup' => [
                    'from' => 'departments',
                    'localField' => '_id',
                    'foreignField' => 'companyID',
                    'as' => 'departments',
                ],
            ],
            ['$unwind' => '$departments'],
            [
                '$lookup' => [
                    'from' => 'employees',
                    'localField' => 'departments._id',
                    'foreignField' => 'departmentID',
                    'as' => 'employees',
                ],
            ],
            [
                '$project' => [
                    'profile.legalName' => true,
                    'employeesCount' => [
                        '$size' => '$employees',
                    ],
                ],
            ],
        ]);

        foreach ($employeeCountCursor as $company) {
            $company;
        }

        return view('dashboard.index')->with([
            'counter' => Company::count(),
            'labels' => $labels,
            'data' => $counts,
            'repo' => $repo,
            'economicalCounts' => $results,
        ]);
    }
}
