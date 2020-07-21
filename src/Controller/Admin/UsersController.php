<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\FrozenTime;

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
                // Validar estado activo o inactivo
                if ($user['estado']== 0) {
                    $this->Flash->error("Usuario no activo por favor contacte con alguno activo!");
                    return $this->redirect(['controller'=>'Users','action'=>'logout']);
                }else{
                    return $this->redirect(['controller'=>'Users','action'=>'index']);
                }
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

        $user = $this->Users->get($id);
        

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            // Conseguir tiempo actual y ponerlo en modificacion
            date_default_timezone_set('America/Mexico_City');
            $now = FrozenTime::now();
            $user->fecha_modificacion=$now;
            /*==========================================================================
            =            Editar archivos o imagenes mediante el controlador            =
            ==========================================================================*/
            
            if (!$user->getErrors) {
                $archivo_imagen = $this->request->getData('cambiar_imagen');
                $nombre=$archivo_imagen->getClientFilename();

                if ($nombre) {
                // Crear un directorio nuevo para guardar imagenes y archivos
                    if (!is_dir(WWW_ROOT.'img'.DS.'imagenes-usuarios')) {
                        mkdir(WWW_ROOT.'img'.DS.'imagenes-usuarios',0775);
                    }

                    $ruta_imagen=WWW_ROOT.'img'.DS.'imagenes-usuarios'.DS.$nombre;

                    $archivo_imagen->moveTo($ruta_imagen);

                    $ruta_imagen_antigua=WWW_ROOT.'img'.DS.$user->imagen;
                    if (file_exists($ruta_imagen_antigua)) {
                        unlink($ruta_imagen_antigua);
                    }

                    $user->imagen='imagenes-usuarios/'.$nombre;
                }
            }
            
            /*=====  End of Editar archivos o imagenes mediante el controlador  ======*/

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

        $ruta_imagen=WWW_ROOT.'img'.DS.$user->imagen;

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

    /*=======================================================================
    =            Cambiar estado de inactivo a activo o viceversa            =
    =======================================================================*/
    
    public function usuarioEstado($id=null,$estado)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->get($id);

        if ($estado==1) {
            $user->estado=0;
        }else{
            $user->estado*1;
        }
        
        if ($this->Users->save($user)) {
            $this->Flash->success(__('El estado del usuario ha sido cambiado.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /*=====  End of Cambiar estado de inactivo a activo o viceversa  ======*/
    


}
