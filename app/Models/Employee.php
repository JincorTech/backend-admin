<?php

namespace App\Models;

/**
 * Class Employee
 * @package App\Models
 * @version August 28, 2017, 10:26 am UTC
 */
class Employee extends BaseModel
{
    public $collection = 'employees';

    protected $dates = ['registeredAt'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId', '_id');
    }

    public function toArray()
    {
        $result = parent::toArray();
        $company = $this->department->getCompany;
        $result['name'] = $this->profile['firstName'] . ' ' . $this->profile['lastName'];
        $result['company'] = $company->profile['legalName'];
        return $result;
    }
}
