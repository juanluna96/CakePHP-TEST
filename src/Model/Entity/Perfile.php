<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Perfile Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $telefono
 * @property \Cake\I18n\FrozenTime $fecha_creacion
 * @property \Cake\I18n\FrozenTime|null $fecha_modificacion
 *
 * @property \App\Model\Entity\User $user
 */
class Perfile extends Entity
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
        'user_id' => true,
        'telefono' => true,
        'fecha_creacion' => true,
        'fecha_modificacion' => true,
        'user' => true,
    ];
}
