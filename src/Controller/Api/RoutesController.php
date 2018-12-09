<?php
namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Routes Controller
 *
 *
 * @method \App\Model\Entity\Route[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoutesController extends AppController
{

    public function getSidebar()
    {
        $sidebar = [
            [
                'title' => 'Posts',
                'routeName' => 'posts',
            ],
            [
                'title' => 'Users',
                'routeName' => 'users',
            ],
        ];

        return $this->getResponse()
            ->withType('application/json')
            ->withStringBody(json_encode($sidebar));
    }
}
