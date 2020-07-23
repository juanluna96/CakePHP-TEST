<!--============================================================
=            Crear separador o indicador de paginas            =
=============================================================-->

<?php $this->Breadcrumbs->add(
	'Inicio',
	['controller' => 'Blogs', 'action' => 'index']
); ?>

<!--====  End of Crear separador o indicador de paginas  ====-->

<div class="mt-4 mx-auto row" >

	<ul class="list-group col-sm-3 m-3">
		<li class="list-group-item active"><h4>Lista de articulos</h4></li>
		<?php foreach ($articuloLista as $key => $TituloArticulo): ?>
			<li class="list-group-item"><a href=<?php echo $this->Url->build(['controller'=>'Blogs','action'=>'view',$key]);?>><?php echo $TituloArticulo ?></a></li>
		<?php endforeach ?>
	</ul>

	<div class="articulos col row">
		<?php foreach ($articulos as $key => $articulo) : ?>
			<div class="card m-3 col-sm-5 pl-0 pr-0">
				<div class="card-header bg-primary text-white">
					<h5 class="mb-0 float-left"><?php echo $articulo->titulo; ?></h5>
					<h5 class="mb-0 float-right">
						<time class="timeago" datetime="<?php echo $articulo->fecha_creacion;?>"></time>
					</h5>
				</div>

				<div class="card-body">
					<a class="text-decoration-none p-0 m-0" href=<?php echo $this->Url->build(['controller'=>'Blogs','action'=>'view',$articulo->id]);?>>
						<p class="card-title text-dark">
							<?php echo $this->Text->truncate(
								$articulo->texto,
								200,
								[
									'ellipsis' => '...',
									'exact' => true
								]
							);
							?>
						</p>
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

</div>

<div class="container">
	<ul class="pagination w-25 mx-auto">
		<?php
		$this->Paginator->setTemplates([
			'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
			'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>',
			'current' => '<li class="active page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
			'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
			'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
			'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
		]);
		echo $this->Paginator->prev('<<');
		echo $this->Paginator->numbers();
		echo $this->Paginator->next('>>');
		?>
	</ul>
</div>

<script>
	if (typeof($.timeago) != "undefined") {
		jQuery.timeago.settings.strings = {
			prefixAgo: "Hace",
			prefixFromNow: "Dentro de",
			suffixAgo: "",
			suffixFromNow: "",
			seconds: "Menos de un minuto",
			minute: "un minuto",
			minutes: "unos %d minutos",
			hour: "una hora",
			hours: "%d horas",
			day: "un día",
			days: "%d días",
			month: "un mes",
			months: "%d meses",
			year: "un año",
			years: "%d años"
		};
	}
	jQuery(document).ready(function() {
		jQuery("time.timeago").timeago();
	});
</script>