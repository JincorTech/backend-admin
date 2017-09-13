<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 12.09.17
 * Time: 15:57
 */

namespace App\Repositories;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Employee;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Models\EconomicalActivityType;
use MongoDB\BSON\Binary;
use App;

class StatisticsRepository
{
    public function getCompanyCountByEmployeeCount()
    {
        $employeeCountCursor = Company::raw()->aggregate([
            [
                '$lookup' => [
                    'from' => 'departments',
                    'localField' => '_id',
                    'foreignField' => 'companyId',
                    'as' => 'departments',
                ],
            ],
            ['$unwind' => '$departments'],
            [
                '$lookup' => [
                    'from' => 'employees',
                    'localField' => 'departments._id',
                    'foreignField' => 'departmentId',
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
            [
                '$bucket' => [
                    'groupBy' => '$employeesCount',
                    'boundaries' => [0, 11, 51, 101],
                    'default' => 101,
                    'output' => [
                        'count' => ['$sum' => 1],
                    ],
                ],
            ],
        ]);

        $employeeCountLabels = [
            0 => 'From 0 to 10',
            11 => 'From 11 to 50',
            51 => 'From 51 to 100',
            101 => '101 and more',
        ];

        $employeeCountData = [
            0 => 0,
            11 => 0,
            51 => 0,
            101 => 0,
        ];

        foreach ($employeeCountCursor as $item) {
            $employeeCountData[(int)$item['_id']] = (int)$item['count'];
        }

        return [
            'labels' => array_values($employeeCountLabels),
            'data' => array_values($employeeCountData),
        ];
    }

    public function getCompanyCountByCountry()
    {
        $countryCountCursor = Company::raw()->aggregate([
            [
                '$group' => [
                    '_id' => '$profile.address.countryId',
                    'count' => ['$sum' => 1],
                ],
            ],
            [
                '$lookup' => [
                    'from' => 'countries',
                    'localField' => '_id',
                    'foreignField' => '_id',
                    'as' => 'country',
                ],
            ],
        ]);

        $countsByCountryLabels = [];
        $countsByCountryData = [];
        foreach ($countryCountCursor as $country) {
            $countsByCountryLabels[] = $country->country[0]->names['en'];
            $countsByCountryData[] = $country['count'];
        }

        return [
            'labels' => $countsByCountryLabels,
            'data' => $countsByCountryData,
        ];
    }

    public function getCompanyCountByType()
    {
        $companyTypesCursor = CompanyType::raw()->aggregate([
            [
                '$lookup' => [
                    'from' => 'companies',
                    'localField' => '_id',
                    'foreignField' => 'companyTypeId',
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

        return [
            'labels' => $labels,
            'data' => $counts,
        ];
    }

    public function last24hoursEmployeeRegistrationsCount()
    {
        return Employee::where('registeredAt', '>', new \DateTime('-1 day'))->count();
    }

    public function getCompanyCountByEconomicalActivities()
    {
        /**
         * @var $repo EconomicalActivityTypeRepository
         */
        $repo = App::make(DocumentManager::class)->getRepository(EconomicalActivityType::class);
        $allTypes = $repo->getTree();

        $economicalActivityCounts = [];
        foreach ($allTypes as $type) {
            //get company count of each economical activity type
            $economicalActivityTypesCursor = Company::raw()->aggregate([
                [
                    '$project' => [
                        'haveType' => [
                            '$in' => [
                                new Binary($type->getId(), Binary::TYPE_OLD_UUID),
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

            $companyCountArray = $economicalActivityTypesCursor->toArray();

            $companyCount = 0;
            if (count($companyCountArray) > 0) {
                $companyCount = (int)$companyCountArray[0]['count'];
            }

            //increase count for all parents of current activity type
            if ($companyCount > 0) {
                $typeCopy = $type;

                while ($parent = $typeCopy->getParent()) {
                    if (isset($economicalActivityCounts[$parent->getId()])) {
                        $economicalActivityCounts[$parent->getId()] += $companyCount;
                    } else {
                        $economicalActivityCounts[$parent->getId()] = $companyCount;
                    }
                    $typeCopy = $parent;
                }
            }

            $economicalActivityCounts[$type->getId()] = $companyCount;
        }

        return $economicalActivityCounts;
    }

    public function totalCompaniesCount()
    {
        return Company::count();
    }

    public function totalEmployeesCount()
    {
        return Employee::count();
    }
}
