<?php

namespace App\Controller;

use Cake\Event\EventInterface;
//Se declara para cambiar el layout o cabezera por defecto

class BlogsController extends AppController
{
    //Desaparecer el layout en todos los templates o vistas por defecto de cakephp a layout/ajax si quiere podemos crear uno nuevo
	public function beforeFilter(EventInterface $event)
	{
		$this->viewBuilder()->setLayout('blog');
        // debug($event);
        // exit;
	}
	public function index()
	{
        //$this->viewBuilder()->setLayout('blog'); //Desaparecer el layout por defecto de cakephp a layout/ajax si quiere podemos crear uno nuevo
		$this->loadModel('Articulos');
		$articulos = $this->Articulos->find('all')->order(['Articulos.id DESC']);

		$articuloLista=$this->Articulos->find('list', [
			//'keyField' => 'titulo', Si queremos enviar el titulo en vez del id a view/$id
			'valueField' => 'titulo'
		])->limit(5);
		//Paginar los articulos a mostrar a 3, paginar sive para dividir por paginas
		$this->set('articulos',$this->paginate($articulos, ['limit'=>'3']));

		$this->set('articuloLista',$articuloLista);
	}

	public function view($id=null)
	{
		$this->loadModel('Articulos');
		$articulo=$this->Articulos->get($id);
		$this->set('articulo',$articulo);
		//debug($articulo);
		//exit;
	}

	public function about()
	{
        //$this->viewBuilder()->setLayout('blog');
	}

	public function contact(){

	}
}
