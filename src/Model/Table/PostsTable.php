<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @method \App\Model\Entity\Post get($primaryKey, $options = [])
 * @method \App\Model\Entity\Post newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Post[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Post|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Post[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Post findOrCreate($search, callable $callback = null, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PostsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('posts');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): \Cake\Validation\Validator
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->minLength('title', 5)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('description')
            ->allowEmpty('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }

    /**
     * Update post data.
     *
     * @param  int $id Post id.
     * @param  array $data Data to update.
     * @return \App\Model\Entity\Post|array
     * @throws \Exception When exception is found.
     */
    public function updatePost($id, $data)
    {
        try {
            $post = $this->get($id, [
                'contain' => [],
            ]);

            $post = $this->patchEntity($post, $data);
            $result = $this->save($post);
            if ($result !== false) {
                return $result;
            }

            return ['errors' => $post->getValidationErrors()];
        } catch (\Exception $e) {
            return ['errors' => $e->getMessage()];
        }
    }

    /**
     * Delete post from table.
     *
     * @param  int $id Post id.
     * @return bool
     * @throws \Exception When exception is found.
     */
    public function remove($id)
    {
        try {
            $post = $this->get($id);

            if (! $this->delete($post)) {
                throw new \Exception(__('Unable to delete post'), 422);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
