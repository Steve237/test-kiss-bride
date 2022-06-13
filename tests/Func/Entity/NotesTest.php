<?php

namespace App\Tests\Func\Entity;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\Security\Core\Security;

class NotesTest extends ApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Request to api to get authentication token
        $response = static::createClient()->request('POST', '/api/login_check', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'email' => 'adouessono@yahoo.fr',
                'password' => 'test'
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent());
        
        //authentication token
        $this->token = $data->token;
    }

    public function testGetNotes(): void
    {
        //request to get notes list from api
        $response = static::createClient()->request('GET', '/api/notes', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testGetNote(): void
    {
        //request to get note from api
        $response = static::createClient()->request('GET', '/api/notes/1', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }


    // Test get note nonexistent in database
    public function testGetNoteWithError(): void
    {
        $response = static::createClient()->request('GET', '/api/notes/999999', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ]
        ]);

        $this->assertResponseStatusCodeSame(404);
    }


    // Test post note to api with value data
    public function testPostNote(): void
    {
        $response = static::createClient()->request('POST', '/api/notes', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ],

            'json' => [

                'date' => '2022-06-12',
                'amount' => 10.00,
                'type' => 'essence',
                'registrationDate' => '2022-06-12',
                'society' => 'api/societies/1'
            ]

        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }


    // Test post note to api with wrong type
    public function testPostNoteWithError(): void
    {
        $response = static::createClient()->request('POST', '/api/notes', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ],

            'json' => [

                'date' => '2022-06-12',
                'amount' => 10.00,
                'type' => 'test',
                'registrationDate' => '2022-06-12',
                'society' => 'api/societies/1'
            ]



        ]);

        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    // Test update note to api with valid data
    public function testUpdateNote(): void
    {
        $response = static::createClient()->request('PUT', '/api/notes/1', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ],

            'json' => [

                'type' => 'essence',
            ]

        ]);

        $this->assertResponseIsSuccessful();
    }

    // Test update note nonexistent in database
    public function testUpdateNoteWithError(): void
    {
        $response = static::createClient()->request('PUT', '/api/notes/9999', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ],

            'json' => [
                
                'type' => 'essence',
            ]

        ]);

        $this->assertResponseStatusCodeSame(404);
    }


    // Test delete note to api
    public function testDeleteNote(): void
    {
        $response = static::createClient()->request('DELETE', '/api/notes/1', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ]
        ]);

        $this->assertResponseIsSuccessful();
    }


    // Test delete note nonexistent in database
    public function testDeleteNoteInvalid(): void
    {
        $response = static::createClient()->request('DELETE', '/api/notes/9999', [
            'headers' => [
                'Content-Type' => 'application/json',
                'authorization' => 'Bearer ' . $this->token
            ]
        ]);

        $this->assertResponseStatusCodeSame(404);
    }
}
