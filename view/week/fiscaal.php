<section class="right_col" role="main">

		<div class="x_panel">
	    	<div class="x_title">
	    	  <h2><b class="error" style="color: #BA383C;"> Fiscale attesten </b></h2>
	    	  <ul class="nav navbar-right panel_toolbox">
	    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	    	  </ul>
	    	  <div class="clearfix"></div>
	    	</div>
	    	<div class="x_content">
					<span class="error" style="color: #BA383C;">
						voor fiscale attesten te vergemakkelijken..
					</span>
					<br />
	    	</div>
	    </div>
</section>

<!-- <section class="right_col" role="main">

	<div class="x_panel">
			<div class="x_title">
				<h2>Kies ouder</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

			<form action="index.php?page=fiscaal" method="POST">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-3 col-xs-12" hidden for="parents">Kind:</label>
					<div class="col-md-2 col-sm-3 col-xs-12">
						<input placeholder="Naam kind" class="form-control" list="parents" name="parents" id="answerInput" />
						<datalist id="parents">
							<option data-value="0">Kies kind</option>
							<?php foreach ($kinderen as $ouder): ?>
								<option data-value="<?php echo $ouder['ID'] ?>" value="<?php echo $ouder['achternaam'] ?> <?php echo $ouder['voornaam'] ?>" >
									<?php echo $ouder['achternaam'] ?> <?php echo $ouder['voornaam'] ?>
								</option>
							<?php endforeach; ?>
						</datalist>
					</div>
				</div>

				<input type="hidden" name="parent" id="answerInput-hidden">
				<button type="submit" name="submitParent" formmethod="post" formaction="index.php?page=fiscaal" class="btn btn-round btn-default">Voeg kind toe aan deze ouder!</button>
				</form>

			</div>
		</div>

				<div class="x_panel">
					<div class="x_title">
						<h2>NAAM KIND + datum</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li>
									<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							</ul>
						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<table  class="table">
							<tr>
								<th class="center" >Eerste dag</th>
								<th class="center" >Laatste dag</th>
								<th class="center" >Halve dagen aanwezig</th>
								<th class="center" >Volle dagen aanwezig</th>
								<th class="center" >Totaal ontvangen geld</th>
								<th class="center" >Jaar</th>
							</tr>
									<tr>
											<td class="center">datum</td>
											<td class="center">datum</td>
											<td class="center">aantal</td>
											<td class="center">aantal</td>
											<td class="center">geld</td>
											<td class="center">jaar dus</td>
									</tr>

						</table>
					</div>
				</div>

</section>
<script type="text/javascript" src="js/datalist.js"></script> -->
