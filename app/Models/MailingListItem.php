<?php

namespace App\Models;

/**
 * Class MailingListItem
 * @package App\Models
 * @version July 24, 2017, 10:31 am UTC
 */
class MailingListItem extends BaseModel
{
    protected $collection = 'mailingList';
    
    public $fillable = [
        'email',
        'mailingListId'
    ];

    public function getMailingListId()
    {
        return $this->mailingListId;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
