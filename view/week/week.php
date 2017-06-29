<div class="right_col" role="main">
	<h1>Aanwezigheidslijst</h1>
	<form action="index.php?page=week" id="weekform" name="weekform" method="POST">
		<label for="dag"> Dag: 
			<select name="dag" id="dag">
				<option value="1" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 1)): echo "selected"; endif; ?>>Maandag</option>
				<option value="2" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 2)): echo "selected"; endif; ?>>Dinsdag</option>
				<option value="3" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 3)): echo "selected"; endif; ?>>Woensdag</option>
				<option value="4" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 4)): echo "selected"; endif; ?>>Donderdag</option>
				<option value="5" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 5)): echo "selected"; endif; ?>>Vrijdag</option>
			</select>
		</label>
		<label for="week">Week: <select name="week" id="week">
			<?php for ($i = 1; $i <= 5; $i++): ?>
				<option value="<?php echo $i ?>" <?php if (isset($_POST['week'])): if ($_POST['week'] == $i): echo "selected"; endif; endif; ?>>Week <?php echo $i; ?></option>
			<?php endfor; ?>
			</select></label>
		<label for="jaar"> Jaar: 
			<select name="jaar" id="jaar">
				<?php for ($i = 2016; $i <= date("Y"); $i++): ?>
					<option value="<?php echo $i; ?>" <?php if (isset($_POST["jaar"])): if ($_POST["jaar"] == $i): echo "selected"; endif; else: if ($i == date("Y")): echo "selected"; endif; endif; ?> form="dag" onChange="this.form.submit()"><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</label>
		<input type="text" name="filter" id="filter" value="<?php if (isset($_POST['filter'])): echo $_POST['filter']; endif; ?>" />
		<!-- <input type="submit"> -->
	</form>
	<?php if (isset($aanwezigheden) && isset($aantalAanwezigheden)): ?>
	<table id="aanwezigheid" class="table">
		<tr>
			<th>Naam</th>
			<th>Voormiddag</th>
			<th>Volle Dag</th>
			<th>Namiddag</th>
			<th>Halve dagen aanwezig</th>
			<th>Volle dagen aanwezig</th>
			<th>TOTAAL aanwezig</th>
		</tr>
		<?php foreach ($aanwezigheden as $aanwezigheid): ?>

			<?php $volledagen = $halvedagen = 0;
			if (!empty($aantalAanwezigheden)) {
				if ($aantalAanwezigheden[0]["ID"] == $aanwezigheid["ID"]) {
					$volledagen = $aantalAanwezigheden[0]["volledagen_aanwezig"];
					$halvedagen = $aantalAanwezigheden[0]["halvedagen_aanwezig"];
				}
			}
			?>
				<tr>
					<form action="index.php?page=week" method="post" id="<?php echo $aanwezigheid['ID']; ?>">
						<td>
							<?php echo $aanwezigheid["voornaam"] . " " . $aanwezigheid["achternaam"]; ?>
							<input type="text" class="hidden" name="id" value="<?php echo $aanwezigheid['ID']; ?>">
							<input type="text" class="hidden" value="<?php echo $_POST['jaar']; ?>" name="jaar" />
							<input type="text" class="hidden" value="<?php echo $_POST['week']; ?>" name="week" />
							<input type="text" class="hidden" value="<?php echo $_POST['dag']; ?>" name="dag" />
							<input type="text" class="hidden" value="<?php echo $_POST['filter']; ?>" name="filter" />
						</td>
						<td><input type="checkbox" name="dagtype" value="VM"
						<?php if (strpos($aanwezigheid["dagtypes"], "VM") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "VD") !== false): echo "disabled"; endif; ?> ></td>
						<td><input type="checkbox" name="dagtype" value="VD"
						<?php if (strpos($aanwezigheid["dagtypes"], "VD") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "M") !== false): echo "disabled"; endif; ?> ></td>
						<td><input type="checkbox" name="dagtype" value="NM"
						<?php if (strpos($aanwezigheid["dagtypes"], "NM") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "VD") !== false): echo "disabled"; endif; ?> ></td>
						<td><?php echo $halvedagen ?></td>
						<td><?php echo $volledagen ?></td>
						<td><?php echo $halvedagen / 2 + $volledagen; ?></td>
						<td><input type="submit" /></td>
					</form>
				</tr>
		<?php endforeach; ?>
		
	</table>
<?php endif; ?>
<script src="js/weekajax.js"></script>
</div>