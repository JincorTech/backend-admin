<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * Class Company
 * @package App\Models
 * @version July 4, 2017, 1:11 pm UTC
 */
class Company extends Model
{
    use SoftDeletes;

    public $table = 'companies';
    

    protected $dates = ['deleted_at'];

    public function profile()
    {
        return $this->embedsOne(Profile::class);
    }

    public $fillable = [
        'legalName'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'legalName' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'profile.legalName' => 'required',
    ];
}
