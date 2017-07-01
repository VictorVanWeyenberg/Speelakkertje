<section class="right_col" role="main">

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
				<form action="index.php?page=weken" method="post">
					<select name="jaar" id="jaar">
						<?php for ($i = 2016; $i <= date("Y"); $i++): ?>
							<option value="<?php echo $i ?>"
								<?php if (isset($_GET["jaar"])): if($_GET["jaar"] == $i): echo "selected"; endif; endif; ?>
								<?php if (isset($_POST["jaar"])): if($_POST["jaar"] == $i): echo "selected"; endif; endif; ?>
							 ><?php echo $i ?></option>
						<?php endfor; ?>
					</select>
					<input type="submit">
				</form>
		</div>
	</div>
</div>

	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2> kiezen Settings</h2>
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
						<th>Naam</th>
						<?php for ($i = 1; $i < 6; $i++): ?>
				      <th class="center" >Week <?php echo $i; ?></th>
				    <?php endfor; ?>
						<th class="center" >TOTAAL dagen aanwezig</th>
					</thead>

					<?php if (count($overzicht) > 0): ?>
				    <?php foreach ($overzicht as $kind): ?>
				      <tr>
				        <td ><?php echo $kind["voornaam"] . " " . $kind["achternaam"]; ?></td>
				        <?php for ($i = 1; $i < 6; $i++): ?>
				          <td class="center">
										<?php var_dump($kind); ?>
				            <?php if (strpos($kind["weken"], strval($i)) !== false) { echo 'x'; } ?>
				          </td>
				        <?php endfor; ?>
								<td class="center">totaal</td>
				      </tr>
				    <?php endforeach; ?>
				  <?php else: ?>
				    <tr>
				      <td colspan="6"> Geen kinderen aanwezig. </td>
				    </tr>
				  <?php endif; ?>

				</table>

			</div>
		</div>
	</div>
</section>
