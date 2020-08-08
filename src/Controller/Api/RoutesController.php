<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Routes Controller
 *
 * @method \App\Model\Entity\Route[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoutesController extends AppController
{
    use ResponseTrait;

    /**
     * Get sidebar array
     *
     * @return \Cake\Http\Response
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
