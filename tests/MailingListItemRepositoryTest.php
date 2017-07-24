<?php

use App\Models\MailingListItem;
use App\Repositories\MailingListItemRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MailingListItemRepositoryTest extends TestCase
{
    use MakeMailingListItemTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MailingListItemRepository
     */
    protected $mailingListItemRepo;

    public function setUp()
    {
        parent::setUp();
        $this->mailingListItemRepo = App::make(MailingListItemRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMailingListItem()
    {
        $mailingListItem = $this->fakeMailingListItemData();
        $createdMailingListItem = $this->mailingListItemRepo->create($mailingListItem);
        $createdMailingListItem = $createdMailingListItem->toArray();
        $this->assertArrayHasKey('id', $createdMailingListItem);
        $this->assertNotNull($createdMailingListItem['id'], 'Created MailingListItem must have id specified');
        $this->assertNotNull(MailingListItem::find($createdMailingListItem['id']), 'MailingListItem with given id must be in DB');
        $this->assertModelData($mailingListItem, $createdMailingListItem);
    }

    /**
     * @test read
     */
    public function testReadMailingListItem()
    {
        $mailingListItem = $this->makeMailingListItem();
        $dbMailingListItem = $this->mailingListItemRepo->find($mailingListItem->id);
        $dbMailingListItem = $dbMailingListItem->toArray();
        $this->assertModelData($mailingListItem->toArray(), $dbMailingListItem);
    }

    /**
     * @test update
     */
    public function testUpdateMailingListItem()
    {
        $mailingListItem = $this->makeMailingListItem();
        $fakeMailingListItem = $this->fakeMailingListItemData();
        $updatedMailingListItem = $this->mailingListItemRepo->update($fakeMailingListItem, $mailingListItem->id);
        $this->assertModelData($fakeMailingListItem, $updatedMailingListItem->toArray());
        $dbMailingListItem = $this->mailingListItemRepo->find($mailingListItem->id);
        $this->assertModelData($fakeMailingListItem, $dbMailingListItem->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMailingListItem()
    {
        $mailingListItem = $this->makeMailingListItem();
        $resp = $this->mailingListItemRepo->delete($mailingListItem->id);
        $this->assertTrue($resp);
        $this->assertNull(MailingListItem::find($mailingListItem->id), 'MailingListItem should not exist in DB');
    }
}
