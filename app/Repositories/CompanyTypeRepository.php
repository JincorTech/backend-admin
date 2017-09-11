<?php

namespace App\Repositories;

use App\Models\CompanyType;
use InfyOm\Generator\Common\BaseRepository;

class CompanyTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'nameEn',
        'nameRu'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CompanyType::class;
    }

    public function getCompanyTypeStat()
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
}
