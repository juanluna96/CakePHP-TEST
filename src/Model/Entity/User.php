<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $correo
 * @property string $password
 * @property \Cake\I18n\FrozenTime $fecha_creacion
 * @property \Cake\I18n\FrozenTime|null $fecha_modificacion
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'correo' => true,
        'password' => true,
        // Cambiar estado de inactivo a activo o viceversa 
        'estado'=>true,
        //Anadir de otra tabla de la base de datos perfiles a la validacion
        'perfile'=>true,
        //Al ser una relacion n a n las tablas usuario y skills entonces se coloca en plural en la validacion
        'skills'=>true,
        'fecha_creacion' => true,
        'fecha_modificacion' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
      }
  }
}
