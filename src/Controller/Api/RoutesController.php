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

    /**
     * Get sidebar array
     *
     * @return string
     */
    public function getSidebar()
    {
        $sidebar = [
            [
                'title' => 'Dashboard',
                'routeName' => 'dashboard',
            ],
            [
                'title' => 'Posts',
                'routeName' => 'posts',
            ],
        ];

        return $this->setJsonResponse($sidebar);
    }
}
