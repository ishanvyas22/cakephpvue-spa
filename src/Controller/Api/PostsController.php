<?php
namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
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

        return $this->getResponse()
            ->withType('application/json')
            ->withStringBody(json_encode($data));
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

        return $this->getResponse()
            ->withType('application/json')
            ->withStringBody(json_encode(['post' => $post]));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($result = $this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->getResponse()
                    ->withType('application/json')
                    ->withStatus(201)
                    ->withStringBody(json_encode([
                        'data' => $result,
                        'success' => true,
                        'url' => '/posts'
                    ]));
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('post'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($result = $this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->getResponse()
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode([
                        'data' => $result,
                        'success' => true,
                        'url' => '/posts'
                    ]));
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('post'));
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
