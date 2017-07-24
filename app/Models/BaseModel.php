<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 24.07.17
 * Time: 16:41
 */

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\BSON\Binary;
use Ramsey\Uuid\Uuid;

class BaseModel extends Model
{
    public $timestamps  = false;

    public $incrementing = false;

    public function newInstance($attributes = [], $exists = false)
    {
        $model = parent::newInstance($attributes, $exists);
        $model->_id = new Binary(Uuid::uuid4(), Binary::TYPE_OLD_UUID);
        return $model;
    }
}
