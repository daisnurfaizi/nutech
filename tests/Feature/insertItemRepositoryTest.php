<?php

namespace Tests\Feature;

use App\Http\repository\ItemRepositoryImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class insertItemRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_RepositoryItem()
    {
        $repository = new ItemRepositoryImpl();
        $data = [
            'name' => 'ssasasa1',
            'buying_price' => '100',
            'selling_price' => '200',
            'quantity' => '10',
            'picture' => 'test.jpg',
        ];
        // array to object request
        $item = (object) $data;

        $result = $repository->Insert($item);
        $this->assertDatabaseHas('items', $data);
    }
}
