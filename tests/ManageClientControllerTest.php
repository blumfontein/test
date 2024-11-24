<?php

namespace App\Tests;
class CreateClientControllerTest extends LayoutTestCase
{
    public function testSuccess(): void
    {
        $this->requestJson('POST', '/client', [
            'first_name' => 'Ilyas',
            'last_name' => 'Makashev',
            'email' => 'example@gmail.com',
            'phone' => '+70001234567',
            'address' => '010000 Astana',
            'fico' => 500,
            'age' => 36,
            'income' => 3000,
            'state' => 'CA',
            'ssn' => '111222333444',
        ]);

        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertNotNull($responseData['id']);

        $this->requestJson('PATCH', '/client/'.$responseData['id'], [
            'first_name' => 'Ilyas',
            'last_name' => 'Makashev',
            'email' => 'example1@gmail.com',
            'phone' => '+70007654321',
            'address' => '010000 Astana',
            'fico' => 500,
            'age' => 36,
            'ssn' => '111222333444',
        ]);

        $this->assertResponseIsSuccessful();
    }
}
