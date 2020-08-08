<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Traits\ResponseTrait;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
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
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('');
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
            'contain' => [],
        ]);

        return $this->setJsonResponse(['post' => $post]);
    }

    /**
     * Save request data into database,
     * Returns validation error(s) if unable to save.
     *
     * @return \Cake\Http\Response
     */
    public function save()
    {
        if (! $this->request->is('post')) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!',
            ]);
        }

        $post = $this->Posts->newEmptyEntity();
        $post = $this->Posts->patchEntity($post, $this->request->getData());
        $result = $this->Posts->save($post);
        if ($result !== false) {
            return $this->setJsonResponse(
                [
                    'data' => $result,
                    'success' => true,
                    'url' => '/posts',
                    'message' => __('The post has been saved.'),
                ],
                201
            );
        }

        return $this->setJsonResponse(
            [
                'errors' => $post->getValidationErrors(),
                'message' => __('The post could not be saved. Please, try again.'),
            ],
            422
        );
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response Returns posts data.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [],
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
     * @return \Cake\Http\Response Returns success/error data depend on post data
     */
    public function update($id)
    {
        if (! $this->request->is(['patch', 'post', 'put'])) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!',
            ]);
        }

        $result = $this->Posts->updatePost($id, $this->request->getData());

        if (isset($result['errors'])) {
            return $this->setJsonResponse(
                [
                    'errors' => $result['errors'],
                    'message' => __('The post could not be saved. Please, try again.'),
                ],
                422
            );
        }

        return $this->setJsonResponse(
            [
                'data' => $result,
                'success' => true,
                'url' => '/posts',
                'message' => __('The post has been updated.'),
            ]
        );
    }

    /**
     * Delete method
     *
     * @param int|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (! $this->request->is(['post', 'delete'])) {
            return $this->setJsonResponse([
                'error' => true,
                'message' => 'Invalid request!',
            ]);
        }

        if (! $this->Posts->remove($id)) {
            return $this->setJsonResponse(
                [
                    'error' => true,
                    'message' => __('The post could not be deleted. Please, try again.'),
                ],
                422
            );
        }

        return $this->setJsonResponse([
            'message' => __('The post has been deleted.'),
            'success' => true,
            'url' => '/posts',
        ]);
    }
}
