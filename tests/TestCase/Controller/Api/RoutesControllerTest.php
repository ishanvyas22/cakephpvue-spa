<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Api;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Api\RoutesController Test Case
 */
class RoutesControllerTest extends IntegrationTestCase
{
    /**
     * Total sidebar actions
     */
    public const TOTAL_ACTIONS = 2;

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
     * Test getSidebar method
     *
     * @return void
     */
    public function testGetSidebar()
    {
        $this->get('/api/routes/get-sidebar');

        $response = $this->_getBodyAsString();
        $responseArray = json_decode($response, true);

        $this->assertResponseOk();
        $this->assertEquals(self::TOTAL_ACTIONS, count($responseArray));
        $this->assertJson('[{"title":"Dashboard","routeName":"dashboard"},{"title":"Posts","routeName":"posts"}]');
    }
}
