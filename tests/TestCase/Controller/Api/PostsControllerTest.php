<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Api;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Api\PostsController Test Case
 */
class PostsControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Posts',
    ];

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/api/posts');

        $response = $this->_getBodyAsString();
        $responseArray = json_decode($response, true);

        $this->assertEquals(2, count($responseArray));
        $this->assertEquals(3, count($responseArray['posts']));
        $this->assertEquals(4, count($responseArray['query']));
        $this->assertResponseOk();
    }
}
