<div class="right_col" role="main">
	<pre>
		<?php// var_dump($aantalAanwezigheden); ?>
	</pre>	
	<pre>
		<?php //var_dump($aanwezigheden); ?>
	</pre>
	<form action="index.php?page=week&id=<?php echo $_GET["id"]; ?>&jaar=<?php echo $_POST['jaar'] ?>&dag=<?php echo $_POST['dag'] ?>" id="weekform" name="weekform" method="POST">
		<label for="dag"> Dag: 
			<select name="dag" id="dag">
				<option value="1" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 1)): echo "selected"; endif; ?> >Maandag</option>
				<option value="2" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 2)): echo "selected"; endif; ?>>Dinsdag</option>
				<option value="3" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 3)): echo "selected"; endif; ?>>Woensdag</option>
				<option value="4" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 4)): echo "selected"; endif; ?>>Donderdag</option>
				<option value="5" <?php if (isset($_POST["dag"]) && ($_POST['dag'] == 5)): echo "selected"; endif; ?>>Vrijdag</option>
			</select>
		</label>
		<label for="jaar"> Jaar: 
			<select name="jaar" id="jaar">
				<?php for ($i = 2016; $i <= date("Y"); $i++): ?>
					<option value="<?php echo $i; ?>" <?php if (isset($_POST["jaar"])): if ($_POST["jaar"] == $i): echo "selected"; endif; else: if ($i == date("Y")): echo "selected"; endif; endif; ?> form="dag" onChange="this.form.submit()"><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</label>
		<input type="submit">
	</form>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" >
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
			if ($aantalAanwezigheden[0]["ID"] == $aanwezigheid["ID"]) {
				$volledagen = $aantalAanwezigheden[0]["volledagen_aanwezig"];
				$halvedagen = $aantalAanwezigheden[0]["halvedagen_aanwezig"];
			}
			?>
			<tr>
				<td><?php echo $aanwezigheid["voornaam"] . " " . $aanwezigheid["achternaam"]; ?><input type="text" class="hidden" name="id" value="<?php echo $aanwezigheid['ID']; ?>" form="weekform"></td>
				<td><input type="checkbox" name="dagtype" value="VM" form="aanwezigheidsform<?php echo $aanwezigheid['ID']; ?>" onChange="this.form.submit()" 
				<?php if (strpos($aanwezigheid["dagtypes"], "VM") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "VD") !== false): echo "disabled"; endif; ?> form="weekform"></td>
				<td><input type="checkbox" name="dagtype" value="VD" form="aanwezigheidsform<?php echo $aanwezigheid['ID']; ?>" onChange="this.form.submit()"
				<?php if (strpos($aanwezigheid["dagtypes"], "VD") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "M") !== false): echo "disabled"; endif; ?> form="weekform"></td>
				<td><input type="checkbox" name="dagtype" value="NM" form="aanwezigheidsform<?php echo $aanwezigheid['ID']; ?>" onChange="this.form.submit()" 
				<?php if (strpos($aanwezigheid["dagtypes"], "NM") !== false): echo "checked"; endif; if (strpos($aanwezigheid["dagtypes"], "VD") !== false): echo "disabled"; endif; ?> form="weekform"></td>
				<td><?php echo $halvedagen ?></td>
				<td><?php echo $volledagen ?></td>
				<td><?php echo $halvedagen / 2 + $volledagen; ?></td>
			</tr>
		<?php endforeach; ?>
		<script src="js/weekajax.js"></script>
		<input type="submit" name="submit_aanwezig" value="opslaan">
	</table>
	</form>
</div>