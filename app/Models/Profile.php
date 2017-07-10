<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 04.07.17
 * Time: 21:25
 */

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = null;

    public $incrementing = false;

    public $timestamps  = false;

    public $fillable = [
        'legalName'
    ];
}
