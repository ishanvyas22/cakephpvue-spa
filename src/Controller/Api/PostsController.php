<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
    use ResponseTrait;

    /**
     * Iniitilization hook.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->viewBuilder()->setLayout(false);
    }

    /**
     * Get table heading
     *
     * @return void
     */
    public function getTableHeading()
    {
        // $fields = [
        //     [
        //         'title' => 'ID',
        //         'sortable' => true
        //     ]
        // ];
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $data['query'] = [
            'id' => [
                'sort' => 'id',
                'direction' => 'asc',
            ],
            'title' => [
                'sort' => 'title',
                'direction' => 'asc',
            ],
            'created' => [
                'sort' => 'created',
                'direction' => 'asc',
            ],
            'modified' => [
                'sort' => 'modified',
                'direction' => 'asc',
            ],
        ];

        if ($this->getRequest()->getQuery()) {
            $direction = 'asc';
            if ($this->getRequest()->getQuery('direction') === 'asc') {
                $direction = 'desc';
            }

            $data['query'][$this->getRequest()->getQuery('sort')]['direction'] = $direction;
        }

        $data['posts'] = $this->paginate($this->Posts);

        return $this->setJsonResponse($data);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);

        return $this->setJsonResponse(['post' => $post]);
    }

    /**
     * Handle add action used for `GET` request
     *
     * @return json
     */
    public function add()
    {
        return $this->setJsonResponse(['post' => $post]);
    }

    /**
     * Save request data into database,
     * Returns validation error(s) if unable to save.
     *
     * @return string|json
     */
    public function save()
    {
        if (! $this->request->is('post')) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!'
            ]);
        }

        $post = $this->Posts->newEntity();
        $post = $this->Posts->patchEntity($post, $this->request->getData());
        if ($result = $this->Posts->save($post)) {
            return $this->setJsonResponse(
                [
                    'data' => $result,
                    'success' => true,
                    'url' => '/posts',
                    'message' => __('The post has been saved.')
                ],
                201
            );
        }

        return $this->setJsonResponse(
            [
                'errors' => $post->getValidationErrors(),
                'message' => __('The post could not be saved. Please, try again.')
            ],
            422
        );
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return json Returns posts data.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);

        return $this->setJsonResponse(
            [
                'post' => $post,
                'success' => true,
            ]
        );
    }

    /**
     * Update existing data for given id.
     *
     * @param int $id Post id.
     * @return json Returns success/error data depend on post data
     */
    public function update($id)
    {
        if (! $this->request->is(['patch', 'post', 'put'])) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!'
            ]);
        }

        $result = $this->Posts->updatePost($id, $this->request->getData());

        if (isset($result['errors'])) {
            return $this->setJsonResponse(
                [
                    'errors' => $result['errors'],
                    'message' => __('The post could not be saved. Please, try again.')
                ],
                422
            );
        }

        return $this->setJsonResponse(
            [
                'data' => $result,
                'success' => true,
                'url' => '/posts',
                'message' => __('The post has been updated.')
            ]
        );
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            return $this->getResponse()
                ->withType('application/json')
                ->withStatus(200)
                ->withStringBody(json_encode([
                    'message' => __('The post has been deleted.'),
                    'success' => true,
                    'url' => '/posts'
                ]));
        } else {
            return $this->getResponse()
                ->withType('application/json')
                ->withStatus(204)
                ->withStringBody(json_encode([
                    'message' => __('The post has been deleted.'),
                    'success' => false,
                    'url' => '/posts'
                ]));
        }
    }
}
