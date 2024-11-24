<?php

class NegativeScoringControllerTest extends \App\Tests\LayoutTestCase
{
    public function testSuccess(): void
    {
        $this->requestJson('POST', '/client', [
            'first_name' => 'Ilyas',
            'last_name' => 'Makashev',
            'email' => 'example@gmail.com',
            'phone' => '+70001234567',
            'address' => '010000 Astana',
            'fico' => 300,
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

        $id = $responseData['id'];

        // Check scoring
        $this->requestJson('POST', '/credits/1/scoring/'.$id);
        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertFalse($responseData['is_allowed']);

        // Check issuance
        $this->requestJson('POST', '/credits/1/issuance/'.$id);
        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertFalse($responseData['is_issued']);
    }
}
