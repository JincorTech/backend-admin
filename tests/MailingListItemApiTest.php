<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MailingListItemApiTest extends TestCase
{
    use MakeMailingListItemTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMailingListItem()
    {
        $mailingListItem = $this->fakeMailingListItemData();
        $this->json('POST', '/api/v1/mailingListItems', $mailingListItem);

        $this->assertApiResponse($mailingListItem);
    }

    /**
     * @test
     */
    public function testReadMailingListItem()
    {
        $mailingListItem = $this->makeMailingListItem();
        $this->json('GET', '/api/v1/mailingListItems/'.$mailingListItem->id);

        $this->assertApiResponse($mailingListItem->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMailingListItem()
    {
        $mailingListItem = $this->makeMailingListItem();
        $editedMailingListItem = $this->fakeMailingListItemData();

        $this->json('PUT', '/api/v1/mailingListItems/'.$mailingListItem->id, $editedMailingListItem);

        $this->assertApiResponse($editedMailingListItem);
    }

    /**
     * @test
     */
    public function testDeleteMailingListItem()
    {
        $mailingListItem = $this->makeMailingListItem();
        $this->json('DELETE', '/api/v1/mailingListItems/'.$mailingListItem->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/mailingListItems/'.$mailingListItem->id);

        $this->assertResponseStatus(404);
    }
}
