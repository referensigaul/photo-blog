<?php

/**
 * Class TokenResourceTest.
 */
class TokenResourceTest extends IntegrationApiV1TestCase
{
    protected $resourceName = 'token';

    protected $resourceStructure = [
        'user_id',
        'api_token',
    ];

    public function testCreateSuccess()
    {
        $user = $this->createTestUser($data = [
            'email' => $email = $this->fake()->safeEmail,
            'password' => $password = $this->fake()->password(),
        ]);

        $this
            ->json('POST', sprintf('/%s', $this->resourceName), [
                'email' => $data['email'],
                'password' => $data['password'],
            ])
            ->assertStatus(201)
            ->assertJsonStructure($this->resourceStructure)
            ->assertJson([
                'user_id' => $user->id,
            ]);
    }

    public function testCreateWithInvalidEmail()
    {
        $user = $this->createTestUser($data = [
            'email' => $email = $this->fake()->safeEmail,
            'password' => $password = $this->fake()->password(),
        ]);

        $this
            ->json('POST', sprintf('/%s', $this->resourceName), [
                'email' => $this->fake()->safeEmail,
                'password' => $data['password'],
            ])
            ->assertStatus(404);
    }

    public function testCreateWithInvalidPassword()
    {
        $user = $this->createTestUser($data = [
            'email' => $email = $this->fake()->safeEmail,
            'password' => $password = $this->fake()->password(),
        ]);

        $this
            ->json('POST', sprintf('/%s', $this->resourceName), [
                'email' => $data['email'],
                'password' => $this->fake()->password(),
            ])
            ->assertStatus(404);
    }
}
