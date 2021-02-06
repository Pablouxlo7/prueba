<!DOCTYPE html>
<?=$headGNRL?>
<body>
  
<?=$header?>
<?php  

	$pag=(isset($_GET['pag']))?$_GET['pag']:0;
	$prodspagina=(isset($_GET['prodspagina']))?$_GET['prodspagina']:20;
	$consulta = $CONEXION -> query("SELECT * FROM users");

	$numItems=$consulta->num_rows;
	$prodInicial=$pag*$prodspagina;

echo '


	<div class="uk-width-1-1">
		<div class="uk-container">
			<div class="uk-flex uk-flex-right">
				<a href="#add" uk-toggle  class="uk-button uk-button-success"><i uk-icon="icon:plus;ratio:1.4;"></i> &nbsp; Nuevo</a>
			</div>
			<div class="uk-container" style="max-width:1000px;">
				<table class="uk-table uk-table-striped uk-table-hover uk-table-middle uk-table-small uk-table-responsive">
					<thead>
						<tr>
							<th withd="60px;">ID</th>
							<th>Name</th>
							<th>Last name</th>
							<th>Job</th>
						</tr>
					</thead>
					<tbody>';
						$USER = $CONEXION -> query("SELECT * FROM users ORDER BY id LIMIT $prodInicial,$prodspagina");
						$numRows = $USER ->num_rows;
						while($row_USER = $USER -> fetch_assoc()){

							$idJob = $row_USER['job_id'];

							$CONSULTA = $CONEXION -> query("SELECT * FROM jobs WHERE id = $idJob");
							while ($row_CONSULTA = $CONSULTA -> fetch_assoc()) {
								$puesto = $row_CONSULTA['name'];
							}

							echo '
							<tr>
								<td>
									'.$row_USER['id'].'
								</td>
								<td>
									'.$row_USER['name'].'
								</td>
								<td>
									'.$row_USER['last_name'].'
								</td>
								<td>
									'.$puesto.'
								</td>
							</tr>';
						}

						echo '
					</tbody>
				</table>
			</div>
		</div>
	</div>
	';


		echo '
	<div class="uk-width-1-1 padding-top-50">
		<div class="uk-flex uk-flex-center">
			<ul class="uk-pagination uk-flex-center uk-text-center">';
				if ($pag!=0) {
					$link=($pag-1).'-pag';
					echo'
					<li><a href="'.$link.'" style="border: none; background: white; color: black;"><i class="fa fa-lg fa-angle-left"></i> &nbsp;&nbsp; Anterior</a></li>';
				}
				$pagTotal=intval($numItems/$prodspagina);
				$resto=$numItems % $prodspagina;
				if (($resto) == 0){
					$pagTotal=($numItems/$prodspagina)-1;
				}
				for ($i=0; $i <= $pagTotal; $i++) { 
					$clase='';
					if ($pag==$i) {
						$clase='bg-primary bg-black color-white';
					}
					$link=($i).'&pro-pag';
					echo '<li><a href="'.$link.'" class="'.$clase.'">'.($i+1).'</a></li>';
				}
				if ($pag!=$pagTotal AND $numItems!=0) {
					$link=($pag+1).'-pag';
					echo'
					<li><a href="'.$link.'" style="border: none; background: white; color: black;">Siguiente &nbsp;&nbsp; <i class="fa fa-lg fa-angle-right"></i></a></li>';
				}
				echo '
			</ul>
		</div>
	</div>';


?>

 
<div id="add" class="modal" uk-modal>
	<div class="uk-modal-dialog uk-modal-body">
		<button class="uk-modal-close-outside" type="button" uk-close></button>
		<form action="./includes/acciones.php" class="uk-form" method="post">
			<input type="hidden" name="new-user" value="1">
			
			<div class="uk-width-1-1 padding-top-10">
				<label class="uk-width-1-1">Name</label>
				<input type="text" class="uk-width-1-1 uk-input username" id="name" name="name">
			</div>

			<div class="uk-width-1-1 padding-top-10">
				<label class="uk-width-1-1">Last name</label>
				<input type="text" id="last_name" name="last_name" class="last_name uk-width-1-1 uk-input">
			</div>

			<div class="uk-width-1-1 padding-top-10">
				<label class="uk-width-1-1">Select your job</label>
				
				<select id="job_id" name="job_id" class="uk-select" required>
			<?php
				$CONSULTA = $CONEXION -> query("SELECT * FROM jobs ORDER BY name");
				while ($row_CONSULTA = $CONSULTA -> fetch_assoc()) {
					$id=$row_CONSULTA['id'];
					$name=$row_CONSULTA['name'];



					echo '
					<option value="'.$row_CONSULTA['id'].'">'.$row_CONSULTA['name'].'</option>';
				}
				echo '
				</select>';
			?>
			</div>

			<div class="uk-width-1-1 uk-text-center padding-top-20">
				<a class="uk-button uk-button-default uk-button-large uk-modal-close">Cerrar</a>
				<button id="save" type="submit" class="save uk-button uk-button-large uk-button-primary" data-origen="registro">Guardar</button>
			</div>
		</form>
	</div>
</div>

<?=$footer?>

<?=$scriptGNRL?>


</body>
</html>