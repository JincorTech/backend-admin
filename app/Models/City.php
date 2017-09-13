<?php

namespace App\Models;
use MongoDB\BSON\Binary;

/**
 * Class City
 * @package App\Models
 * @version September 12, 2017, 12:07 pm UTC
 */
class City extends BaseModel
{
    protected $collection = 'cities';
    
    public $fillable = [
        'names',
        'countryId'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'names.values.ru' => 'required|string|min:2',
        'names.values.en' => 'required|string|min:2',
        'countryId' => 'required|string|size:36'
    ];

    public function getCountryAttribute($value)
    {
        return Country::find($value['$id']);
    }

    public function getCountryIdAttribute($value)
    {
        return $this->attributes['country']['$id'];
    }

    public function setCountryIdAttribute($value)
    {
        $this->attributes['country'] = [
            '_bsontype' => 'DBRef',
            '$ref' => 'countries',
            '$id' => new Binary($value, Binary::TYPE_OLD_UUID),
            '$db' => env('DB_DATABASE'),
        ];
    }
}
