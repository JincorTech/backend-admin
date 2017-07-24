<?php

use Faker\Factory as Faker;
use App\Models\MailingListItem;
use App\Repositories\MailingListItemRepository;

trait MakeMailingListItemTrait
{
    /**
     * Create fake instance of MailingListItem and save it in database
     *
     * @param array $mailingListItemFields
     * @return MailingListItem
     */
    public function makeMailingListItem($mailingListItemFields = [])
    {
        /** @var MailingListItemRepository $mailingListItemRepo */
        $mailingListItemRepo = App::make(MailingListItemRepository::class);
        $theme = $this->fakeMailingListItemData($mailingListItemFields);
        return $mailingListItemRepo->create($theme);
    }

    /**
     * Get fake instance of MailingListItem
     *
     * @param array $mailingListItemFields
     * @return MailingListItem
     */
    public function fakeMailingListItem($mailingListItemFields = [])
    {
        return new MailingListItem($this->fakeMailingListItemData($mailingListItemFields));
    }

    /**
     * Get fake data of MailingListItem
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMailingListItemData($mailingListItemFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'email' => $fake->word,
            'mailingListId' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $mailingListItemFields);
    }
}
