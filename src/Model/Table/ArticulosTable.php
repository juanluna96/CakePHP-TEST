<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articulos Model
 *
 * @method \App\Model\Entity\Articulo newEmptyEntity()
 * @method \App\Model\Entity\Articulo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Articulo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Articulo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Articulo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Articulo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Articulo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Articulo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Articulo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Articulo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Articulo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Articulo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Articulo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ArticulosTable extends Table
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

        $this->setTable('articulos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 50)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('texto')
            ->maxLength('texto', 300)
            ->requirePresence('texto', 'create')
            ->notEmptyString('texto');

        $validator
            ->dateTime('fecha_creacion')
            ->notEmptyDateTime('fecha_creacion');

        $validator
            ->dateTime('fecha_modificacion')
            ->allowEmptyDateTime('fecha_modificacion');

        return $validator;
    }
}
