<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\BSON\Binary;
use Ramsey\Uuid\Uuid;

/**
 * Class Currency
 * @package App\Models
 * @version July 6, 2017, 8:58 am UTC
 */
class Currency extends Model
{
    public $table = 'currencies';

    public $timestamps  = false;

    protected $fillable = [
        'names',
        'ISOCodes',
        'sign'
    ];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'names.en' => 'required',
        'names.ru' => 'required',
        'ISOCodes.alpha3Code' => 'required|size:3|regex:/[A-Z]/',
        'ISOCodes.numericCode' => 'required|integer|min:1|max:999'
    ];

    public function newInstance($attributes = [], $exists = false)
    {
        $model = parent::newInstance($attributes, $exists);
        $model->_id = new Binary(Uuid::uuid4(), Binary::TYPE_OLD_UUID);
        return $model;
    }

    public function setISOCodesAttribute($value)
    {
        $value['numericCode'] = (int)$value['numericCode'];
        $this->attributes['ISOCodes'] = $value;
    }

    public function setSignAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['sign'] = $value;
        } else {
            $this->attributes['sign'] = '';
        }
    }
}
