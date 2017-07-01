
<!-- test -->


<section class="right_col" role="main">

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Settings </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				<form action="index.php?page=kinderen" method="POST">
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="">
							<label>
								<input type="checkbox" class="js-switch" name="allYear" <?php if(isset($_POST['allYear'])): echo 'checked'; endif; ?> /> Toon ingeschreven alle jaren
							</label>
							<input type="submit" name="years"  class="btn btn-round btn-default" value="Go">
						</div>
					</div>
				 </form>
			</div>
		</div>
	</div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Alle kinderen </h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
				<div class="clearfix"></div>
			</div>
				<div class="x_content">
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Naam</th>
								<th>Voornaam</th>
								<th>Geslacht</th>
								<th>Geboortedatum</th>
								<th>MEDISCH!</th>
								<th>Tel. 1</th>
								<th>Tel. 2</th>
								<th>Naan ouder</th>
								<th>Voornaam ouder</th>
								<th>E-mail</th>
								<th>Adres</th>
								<th>Postcode</th>
								<th>Gemeente</th>
								<th>Notitie</th>
								<th></th>
								<th></th>
								<th>Registratiedatum</th>
								<th>Updatedatum</th>
							</tr>
						</thead>


						<tbody>
							<?php
						   foreach ($kinderen as $row):

								echo '  <tr>
								<td nowrap>' . $row["ID"] . '</td>
								<td nowrap>' . $row['achternaam'] . '</td>
								<td nowrap>' . $row['voornaam'] . '</td>
								<td nowrap>' . $row['geslacht'] . '</td>
								<td nowrap>' . $row['geboortedatum'] . '</td>
								<td nowrap>' . $row['medische'] . '</td>
								<td nowrap>' . $row['tel1'] . '</td>
								<td nowrap>' . $row['tel2'] . '</td>
								<td nowrap>' . $row['oudernaam'] . '</td>
								<td nowrap>' . $row['oudervoornaam'] . '</td>
								<td nowrap>' . $row['email'] . '</td>
								<td nowrap>' . $row['adres'] . '</td>
								<td nowrap>' . $row['postcode'] . '</td>
								<td nowrap>' . $row['stad'] . '</td>
								<td nowrap>' . $row['notities'] . '</td>
								<td><b><a href="index.php?page=weizig&kind='. $row['voornaam'] .'-'.$row['achternaam'].'">weizig</a></b></td>
								<td></td>
								<td nowrap>' . $row['registratiedatum'] . '</td>
								<td nowrap>' . $row['updatedatum'] . '</td>
								</tr> ';
							endforeach;
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
