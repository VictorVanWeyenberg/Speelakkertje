<div class="right_col" role="main">
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
	<table>
		<tr>
			<th>Naam</th>
			<?php for ($i = 1; $i < 6; $i++): ?>
				<th>Week <?php echo $i; ?></th>
			<?php endfor; ?>
		</tr>
		<?php if (count($overzicht) > 0): ?>
			<?php foreach ($overzicht as $kind): ?>
				<tr>
					<td><?php echo $kind["voornaam"] . " " . $kind["achternaam"]; ?></td>
					<?php for ($i = 1; $i < 6; $i++): ?>
						<td>
							<?php if (strpos($kind["weken"], strval($i)) !== false) { echo 'x'; } ?>
						</td>
					<?php endfor; ?>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="6"> Geen kinderen aanwezig. </td>
			</tr>
		<?php endif; ?>
	</table>
</div>