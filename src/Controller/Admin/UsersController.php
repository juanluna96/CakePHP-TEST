<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Users Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    // Controlador para el login de cakephp/admin
    public function login()
    {
        if ($this->request->is('post')) {
            $user=$this->Auth->identify();
            // debug($user);
            // exit;
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller'=>'Users','action'=>'index']);
            }else{
                $this->Flash->error("Usuario o contraseña incorrecto!");
            }
        }

    }

    // Metodo para el boton de deslogear
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Realizar busqueda con el key del users/index
        $key=$this->request->getQuery('key');
        if ($key) {
            // Query para un solo tipo de busqueda osea solo buscar por el nombre de usuario
            // $query=$this->Users->find('all')->where(['username like'=>'%'.$key.'%']);
            $query=$this->Users->find('all')
            ->where(['Or' =>['username like'=>'%'.$key.'%','correo like'=>'%'.$key.'%']]);
        } else {
            $query=$this->Users;
        }
        
        // Verificar los datos SESSION pero en vez de eso se usa $this->Auth->user()
        // debug($this->Auth->user('username'));
        // exit;
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
        /*============================================================================
        =            Insertar archivos o imagenes mediante el controlador            =
        ============================================================================*/

        if (!$user->getErrors) {
            $archivo_imagen = $this->request->getData('archivo_imagen');
            $nombre=$archivo_imagen->getClientFilename();

            // Crear un directorio nuevo para guardar imagenes y archivos
            if (!is_dir(WWW_ROOT.'img'.DS.'imagenes-usuarios')) {
                mkdir(WWW_ROOT.'img'.DS.'imagenes-usuarios',0775);
            }
            

            $targetPath=WWW_ROOT.'img'.DS.'imagenes-usuarios'.DS.$nombre;

            if ($nombre) {
                $archivo_imagen->moveTo($targetPath);
                $user->imagen='imagenes-usuarios/'.$nombre;
            }
        }

        // debug($archivo_imagen);
        // exit;

        /*=====  End of Insertar archivos o imagenes mediante el controlador  ======*/

        

        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $this->set(compact('user'));
}

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        $ruta_imagen=WWW_ROOT.'img'.DS.$user->image;

        if ($this->Users->delete($user)) {
            // Eliminar imagen de la carpeta al eliminar el usuario
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /*=====================================================================================
    =            Borrar los registros usando los checkbox de la tabla usuarios            =
    =====================================================================================*/

    public function borrarTodos()
    {

        $this->request->allowMethod(['post', 'delete']);
        $ids=$this->request->getData('ids');

        if ($this->Users->deleteAll(['Users.id IN'=>$ids])) {
            $this->Flash->success(__('The user has been deleted.'));
        }
        
        return $this->redirect(['action' => 'index']);

    }

    /*=====  End of Borrar los registros usando los checkbox de la tabla usuarios  ======*/


}
