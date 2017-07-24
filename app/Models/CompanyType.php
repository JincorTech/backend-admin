<?php

namespace App\Models;

/**
 * Class CompanyType
 * @package App\Models
 * @version July 5, 2017, 8:52 am UTC
 */
class CompanyType extends BaseModel
{
    protected $collection = 'companyTypes';

    protected $fillable = [
        'code',
        'names',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'names.values.en' => 'required',
        'names.values.ru' => 'required'
    ];

}
