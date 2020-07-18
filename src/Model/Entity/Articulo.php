<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Articulo Entity
 *
 * @property int $id
 * @property string $title
 * @property string $texto
 * @property \Cake\I18n\FrozenTime $fecha_creacion
 * @property \Cake\I18n\FrozenTime|null $fecha_modificacion
 */
class Articulo extends Entity
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
        'title' => true,
        'texto' => true,
        'fecha_creacion' => true,
        'fecha_modificacion' => true,
    ];
}
