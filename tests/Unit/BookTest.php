<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;


class BookTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    //fetch all local storage books
    public function test_local_get()
    {
        $response = $this->getJson('api/v1/books');
        $response->assertStatus(200);
    }

    // fetch single local storage books
    public function test_get_single_local_get()
    {
        $response = $this->getJson('api/v1/books/:1');
        $response
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('status_code', 200)
                    ->where('status', "success")
                    ->etc()
            );
        $response->assertStatus(200);
    }

    //post data to local book db 

    // PLEASE NOTE: This will fail after first test runn because fields has been created inn the database which duplicate is not allowed for isbn
    // public function test_post_local_books()
    // {
    //     $response = $this->postJson('api/v1/books', [
    //             "name" => "Six Book ",
    //             "isbn" => "132-2413243567",
    //             "authors" => [ "Solomon Ifeoluwa"],
    //             "country" => "Croatia",
    //             "number_of_pages" => 150,
    //             "publisher" => "Cro Book",
    //             "release_date" => "2022-1-18"
    //     ]);
    //     $response
    //     ->assertJson(
    //         fn (AssertableJson $json) =>
    //         $json->where('status_code', 201)
    //             ->where('status', "success")
    //             ->etc()
    //     );
    //     $response->assertStatus(200);
    // }

    //Update book in the local db
    public function test_update_local_books()
    {
        $response = $this->patchJson('api/v1/books/:3', [
            'name' => 'Third book Update'
        ]);
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->where('status_code', 200)
                ->where('status', "success")
                ->etc()
        );
        $response->assertStatus(200);
    }

    //Delete books in local db
    public function test_delete_local_book()
    {
        $response = $this->deleteJson('api/v1/books/:8');
        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->where('status_code', 204)
                ->where('status', "success")
                ->etc()
        );
        $response->assertStatus(200);
    }
}
