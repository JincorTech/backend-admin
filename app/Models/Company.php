<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\BSON\Binary;

/**
 * Class Company
 * @package App\Models
 * @version July 4, 2017, 1:11 pm UTC
 */
class Company extends Model
{
    protected $collection = 'companies';

    protected $fillable = [
        'blocked'
    ];

    public function isBlocked()
    {
        return $this->blocked;
    }

    public function getCompanyTypeAttribute($value)
    {
        return CompanyType::find(new Binary($this->profile['companyType']['$id'], Binary::TYPE_OLD_UUID));
    }
}
