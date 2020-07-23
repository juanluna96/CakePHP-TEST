<!--============================================================
=            Crear separador o indicador de paginas            =
=============================================================-->

<?php 
$this->Breadcrumbs->add([
	['title' => 'Inicio', 'url' => ['controller' => 'Blogs', 'action' => 'index']],
	['title' => $articulo->titulo, 'url' => ['controller' => 'Blogs', 'action' => 'view', $articulo->id]]
]);
?>

<!--====  End of Crear separador o indicador de paginas  ====-->


<div class="container-fluid m-3">
	<h2 class="text-primary"><?php echo $articulo->titulo ?></h2>
	<p class="w-50"><?php echo $articulo->texto ?></p>
</div>