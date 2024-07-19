<?php

namespace Tests\Feature;

use Tests\TestCase;

class SimpleEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_the_successful_response_of_the_simple_endpoint()
    {
        $response = $this->get(route('simple-endpoint.get'));

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Hello, World!'
        ]);
    }

    public function test_correct_response_of_the_simple_endpoint()
    {
        $number = rand(1, 10);
        $number2 = rand(1, 10);

        $response = $this->post(route('simple-endpoint.post'), [
            'number' => $number,
            'number2' => $number2
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'result' => $number + $number2
        ]);
    }

    public function test_correct_response_of_the_simple_endpoint_with_invalid_data()
    {
        $response = $this->post(route('simple-endpoint.post'), [
            'number' => 0,
            'number2' => "bad data"
        ]);

        $response->assertStatus(400);
        $response->assertJsonStructure([
            'error' => [
                'number',
                'number2'
            ]
        ]);
    }
}
