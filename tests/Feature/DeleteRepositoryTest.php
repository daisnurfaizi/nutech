<?php

namespace Tests\Feature;

use App\Http\repository\ItemRepositoryImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Delete_Repository()
    {
        $deleteRepository = new ItemRepositoryImpl();
        $result = $deleteRepository->Delete(9);
        $this->assertEquals(1, $result);
    }
}
