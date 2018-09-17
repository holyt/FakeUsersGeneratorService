<?php
namespace  Test\Feature;
use TestCase;
use App\UserGenerator\UserGenerator;

class UsersGenerationTest extends TestCase
{
    protected function getResponseBody($response): array
    {
        return json_decode($response->response->getContent(), true);
    }

    /** @test */
    public function will_generate_user()
    {
        $response = $this->json('GET', 'users/random_one');

        $response->assertResponseStatus(200);
        $response->seeJsonStructure(UserGenerator::getUserFields());
    }

    /** @test */
    public function will_return_params_for_user_generation()
    {
        $response = $this->json('GET', 'users/available_params');

        $response->assertResponseStatus(200);
        $responseBody = $this->getResponseBody($response);
        $this->assertNotEmpty($responseBody);
        $this->assertEquals('number_of_users', array_keys($responseBody)[0] );
    }

    /** @test */
    public function will_generate_users_by_params()
    {
        $numberOfUsers = rand(2, 100);
        $requestBody = ['number_of_users' => $numberOfUsers];
        $response = $this->json('GET', 'users', $requestBody);

        $response->assertResponseStatus(200);
        $responseBody = $this->getResponseBody($response);
        $this->assertNotEmpty($responseBody);
        $this->assertCount($numberOfUsers, $responseBody);
    }

}