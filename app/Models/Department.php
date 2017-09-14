<?php

namespace App\Models;

/**
 * Class Department
 * @package App\Models
 * @version August 28, 2017, 10:13 am UTC
 */
class Department extends BaseModel
{
    protected $collection = 'departments';

    public function getCompany()
    {
        return $this->belongsTo(Company::class, 'companyId', '_id');
    }

    public function toArray()
    {
        $result = parent::toArray();
        $result['company'] = $this->getCompany->profile['legalName'];
        return $result;
    }
}
