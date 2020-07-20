<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
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
        ->scalar('username')
        ->maxLength('username', 20)
        ->requirePresence('username', 'create')
        ->notEmptyString('username');

        $validator
        ->scalar('correo')
        ->maxLength('correo', 50)
        ->requirePresence('correo', 'create')
        ->notEmptyString('correo');

        $validator
        ->scalar('password')
        ->maxLength('password', 100)
        ->requirePresence('password', 'create')
        ->notEmptyString('password');

        $validator
        ->dateTime('fecha_creacion')
        ->notEmptyDateTime('fecha_creacion');

        $validator
        ->dateTime('fecha_modificacion')
        ->allowEmptyDateTime('fecha_modificacion');

        /*================================================================
        =            Validar la subida de un archivo o imagen            =
        ================================================================*/
        
        $validator
        ->allowEmptyFile('imagen')
        ->add( 'imagen', [
            'mimeType' => [
                'rule' => [ 'mimeType', [ 'imagen/jpg', 'imagen/png', 'imagen/jpeg' ] ],
                'message' => 'Porfavor solo sube archivos tipo JPG y PNG.',
            ],
            'fileSize' => [
                'rule' => [ 'fileSize', '<=', '1MB' ],
                'message' => 'Las imagenes deben pesar menos de 1MB.',
            ],
        ] );
        
        
        
        /*=====  End of Validar la subida de un archivo o imagen  ======*/
        

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }
}
