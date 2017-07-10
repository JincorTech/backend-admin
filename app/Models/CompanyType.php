<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\BSON\Binary;
use Ramsey\Uuid\Uuid;

/**
 * Class CompanyType
 * @package App\Models
 * @version July 5, 2017, 8:52 am UTC
 */
class CompanyType extends Model
{
    protected $collection = 'companyTypes';

    public $timestamps  = false;

    protected $fillable = [
        'code',
        'names',
    ];

    public $incrementing = false;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string',
        'nameEn' => 'string',
        'nameRu' => 'string'
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

    public function newInstance($attributes = [], $exists = false)
    {
        $model = parent::newInstance($attributes, $exists);
        $model->_id = new Binary(Uuid::uuid4(), Binary::TYPE_OLD_UUID);
        return $model;
    }

}
