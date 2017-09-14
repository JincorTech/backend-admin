<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Profile;
use InfyOm\Generator\Common\BaseRepository;

class CompanyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'legalName'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Company::class;
    }

    public function create(array $attributes)
    {
        $model = parent::create($attributes);
        $profile = new Profile($attributes['profile']);
        $model->profile()->save($profile);
        return $model;
    }
}
