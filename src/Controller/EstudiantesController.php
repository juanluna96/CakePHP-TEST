<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Estudiantes Controller
 *
 * @method \App\Model\Entity\Estudiante[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EstudiantesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // index es la vista de proyecto/nombretabla
        $estudiantes = $this->paginate($this->Estudiantes);
        

        $this->set(compact('estudiantes'));
        // Obtener todos los valores de la tabla de base de datos
        // echo '<pre>'; print_r(json_encode($estudiantes)); echo '</pre>';
        // exit();
    }

    /**
     * View method
     *
     * @param string|null $id Estudiante id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // view es la vista de proyecto/nombretabla/id de su id en la base de datos proyecto/estudiantes/1 ej
        $estudiante = $this->Estudiantes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('estudiante'));
        // // Obtener todos los valores del estudiante segun su id en la base de datos
        // echo '<pre>'; print_r(json_encode($estudiante)); echo '</pre>';
        // exit();
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $estudiante = $this->Estudiantes->newEmptyEntity();
        if ($this->request->is('post')) {
            $estudiante = $this->Estudiantes->patchEntity($estudiante, $this->request->getData());
            if ($this->Estudiantes->save($estudiante)) {
                $this->Flash->success(__('The estudiante has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The estudiante could not be saved. Please, try again.'));
        }
        $this->set(compact('estudiante'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Estudiante id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $estudiante = $this->Estudiantes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estudiante = $this->Estudiantes->patchEntity($estudiante, $this->request->getData());
            if ($this->Estudiantes->save($estudiante)) {
                $this->Flash->success(__('The estudiante has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The estudiante could not be saved. Please, try again.'));
        }
        $this->set(compact('estudiante'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Estudiante id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $estudiante = $this->Estudiantes->get($id);
        if ($this->Estudiantes->delete($estudiante)) {
            $this->Flash->success(__('The estudiante has been deleted.'));
        } else {
            $this->Flash->error(__('The estudiante could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
