<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $estudiantes
 */
?>
<div class="estudiantes index content">
    <?= $this->Html->link(__('New Estudiante'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Estudiantes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('edad') ?></th>
                    <th><?= $this->Paginator->sort('pais') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $estudiante): ?>
                    <tr>
                        <td><?= $this->Number->format($estudiante->id) ?></td>
                        <td><?= h($estudiante->nombre) ?></td>
                        <td><?= $this->Number->format($estudiante->edad) ?></td>
                        <td><?= h($estudiante->pais) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $estudiante->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $estudiante->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $estudiante->id], ['confirm' => __('Are you sure you want to delete # {0}?', $estudiante->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
