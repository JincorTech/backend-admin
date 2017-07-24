<?php

namespace App\Repositories;

use App\Models\MailingListItem;
use InfyOm\Generator\Common\BaseRepository;

class MailingListItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'mailingListId'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MailingListItem::class;
    }
}
