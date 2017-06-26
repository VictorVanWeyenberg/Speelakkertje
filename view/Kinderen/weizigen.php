<?php

	// kind  = $kind
		$pieces = explode("-", $kind['geboortedatum']);

		$_POST['naam'] = $kind['voornaam'];
		$_POST['lastname'] = $kind['achternaam'];
		$_POST['geslacht'] = $kind['geslacht'];
		$_POST['geboortedag'] = $pieces[0];
		$_POST['geboortemaand'] = $pieces[1];
		$_POST['geboortejaar'] = $pieces[2];
		$_POST['alleen_naar_huis'] = $kind['alleen_naar_huis'];
		$_POST['actief'] = $kind['actief'] ;
		$_POST['medische'] = $kind['medische'];
		$_POST['notities'] = $kind['notities'];

	// ouder = $ouder


?>


<section class="right_col" role="main">

	<div class="x_panel">
    	<div class="x_title">
    	  <h2><b><?php  echo $kind['voornaam']." ".$kind['achternaam'] ?> </b>weizigen</h2>
    	  <ul class="nav navbar-right panel_toolbox">
    	    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
    	  </ul>
    	  <div class="clearfix"></div>
    	</div>
    	<div class="x_content">

          <form method="POST" action="index.php?page=kinderen" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						<?php if(!empty($errors)): ?>
							<span class="error" style="color: #BA383C;">
								registratie is mislukt! er zijn velden leeg!
								<?php if(!empty($errors['bestaatal'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['bestaatal']}</p>";?>
								<?php //var_dump($_POST); ?>
							</span>
						<?php endif; ?>
            <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="naam">Voornaam kind:<span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="text" id="naam" name="naam" placeholder="Spelen" value="<?php if(!empty($_POST['lastname'])) echo $_POST['lastname']; ?>" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['email']) && !empty($_POST['email'])):  echo $_POST['email']; endif; ?>" >
                 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['naam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['naam']}</p>";?></span>

               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="voornaam">voornaam<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="text" id="voornaam" name="voornaam" placeholder="speelplein" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['voornaam'])):  echo $_POST['voornaam']; endif; ?>">
                 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['voornaam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['voornaam']}</p>";?></span>

               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12">familienaam<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="text" id="familienaam" name="familienaam" required="required" placeholder="spelen" for="familienaam"  class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['familienaam'])):  echo $_POST['familienaam']; endif; ?>">
                 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['familienaam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['familienaam']}</p>";?></span>

               </div>
             </div>
           <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="functie">Functie<span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <div id="functie" class="btn-group" data-toggle="buttons">
                   <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                     <input type="radio" name="functie" value="m" <?php if (!empty($_POST['functie']) && $_POST['functie'] == "m"): echo "checked"; endif; ?> > &nbsp; Mama &nbsp;
                   </label>
                   <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                     <input type="radio" name="functie" value="p" <?php if (!empty($_POST['functie']) && $_POST['functie'] == "p"): echo "checked"; endif; ?>> Papa
                   </label>
                 </div>
                 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['functie'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['functie']}</p>";?></span>
               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adres">Straat en nummer<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="text" id="adres" name="adres" required="required" placeholder="Sint-josefstraat 10" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['adres'])):  echo $_POST['adres']; endif; ?>">
                 <span class="error" style="color: #BA383C;"><?php if(!empty($errors['adres'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['adres']}</p>";?></span>

               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="postcode">Postcode<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="text" id="postcode" name="postcode"  placeholder="9041" required="required" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['postcode'])):  echo $_POST['postcode']; endif; ?>">
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['postcode'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['postcode']}</p>";?></span>
               </div>
             </div>

            <div class="form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stad">Gemeente<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="text" id="stad" name="stad" required="required" placeholder="Oostakker" class="form-control col-md-7 col-xs-12" value="<?php if (isset($_POST['stad'])):  echo $_POST['stad']; endif; ?>">
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['stad'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['stad']}</p>";?></span>
               </div>
             </div>

             <div class="form-group">
               <label for="tel1" class="control-label col-md-3 col-sm-3 col-xs-12">Telefoonnummer<span class="required">*</span></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                   <input id="tel1" name="tel1" class="form-control col-md-7 col-xs-12" type="text" placeholder="0477 47 52 09" value="<?php if (isset($_POST['tel1'])):  echo $_POST['tel1']; endif; ?>">
                   <span class="error" style="color: #BA383C;"><?php if(!empty($errors['tel1'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['tel1']}</p>";?></span>
               </div>
             </div>

             <div class="form-group">
               <label for="tel2" class="control-label col-md-3 col-sm-3 col-xs-12">Nood nummer</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                   <input id="tel2" name="tel2" class="form-control col-md-7 col-xs-12" type="text" placeholder="0477 47 52 09" value="<?php if (isset($_POST['tel2'])):  echo $_POST['tel2']; endif; ?>">

               </div>
             </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                 <button class="btn btn-primary" type="reset">Reset</button>
                 <input type="submit" class="btn btn-success" name="action_insert_parent" value="Doorgaan" class="form-submit" />
              </div>
            </div>

          </form>

    	</div>
    </div>

	<!-- kind -->

    <form class="register-form" action="<?php //$_SERVER['PHP_SELF']; ?>" method="POST" class="forum">
        <article class="basic">
        <p><b> Gelieve dit formulier in Google Chrome, Mozilla firefox of Safari in te vullen,<br /> Internet Explorer is afgeraden</b> </p>
			<?php if(!empty($errors)): ?>
			<span class="error" style="color: #BA383C;">
				registratie is mislukt! er zijn velden leeg!
				<?php if(!empty($errors['bestaatal'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['bestaatal']}</p>";?>
				<?php //var_dump($_POST); ?>
			</span>
			<?php endif; ?>
			 <div class="input-container text">
                <label class="form-label" for="naam">Voornaam kind:</label>
                <input type="text" id="naam" name="naam" class="form-input" placeholder="Floris" value="<?php if(!empty($_POST['naam'])) echo $_POST['naam']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['naam'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['naam']}</p>";?></span>
            </div>

            <div class="input-container text">
                <label class="form-label" for="lastname">Familienaam kind:</label>
                <input type="text" id="lastname" name="lastname" class="form-input" placeholder="Spelen" value="<?php if(!empty($_POST['lastname'])) echo $_POST['lastname']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['lastname'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['lastname']}</p>";?></span>
            </div>

			<div class="input-container text">
				<label style="padding-bottom: 20px;" class="form-label">Geslacht: </label>
				<input type="radio" id="v" value="v" name="geslacht" class="form-input" <?php if (!empty($_POST['geslacht']) && $_POST['geslacht'] == 'v'){ echo 'checked="true"'; }?> />
				<label style="padding-bottom: 20px;" class="form-label" for="v" >meisje</label>
				<input type="radio" id="m" value="m" name="geslacht" class="form-input" <?php if ( !empty($_POST['geslacht']) && $_POST['geslacht'] == 'm'){ echo 'checked="true"'; }?> />
				<label style="padding-bottom: 20px;" class="form-label" for="m">jongen</label>
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['geslacht'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['geslacht']}</p>";?></span>
            </div>

            <div class="input-container text">
                <label class="form-label">Geboortedatum kind:</label>
                <input type="text" name="geboortedag" class="form-input" maxlength="2" pattern="[0-9]{2}" placeholder="23 (dag)" value="<?php if(!empty($_POST['geboortedag'])) echo $_POST['geboortedag']; ?>" />
                <input type="text" name="geboortemaand" class="form-input" maxlength="2" pattern="[0-9]{2}" placeholder="02 (maand)" value="<?php if(!empty($_POST['geboortemaand'])) echo $_POST['geboortemaand']; ?>" />
                <input type="text" name="geboortejaar" class="form-input" maxlength="4" pattern="[0-9]{4}" placeholder="2005 (jaar)" value="<?php if(!empty($_POST['geboortejaar'])) echo $_POST['geboortejaar']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['geboortedatum'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['geboortedatum']}</p>";?></span>
            </div>

            <div class="input-container text">
				<label class="form-label">Mag alleen naar huis: Gelieve dit te melden bij opmerkingen.</label>
				<!--
                <input type="radio" id="j" name="alleen_naar_huis" class="form-input" value="1" />
				<label class="form-label" for="j" >ja</label>
				<input type="radio" id="n" name="alleen_naar_huis" class="form-input" value="0" />
				<label class="form-label" for="n">neen</label>
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['alleen_naar_huis'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['alleen_naar_huis']}</p>";?></span>
-->
            </div>


			<div class="input-container text">
                <label class="form-label" for="medische">medische opmerkingen (Als er geen zijn vul "geen" in):</label>
                <input type="text" id="medische" name="medische" class="form-inut" placeholder="Noten allergie" value="<?php if(!empty($_POST['medische'])) echo $_POST['medische']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['medische'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['medische']}</p>";?></span>
            </div>

            <div class="input-container text">
				<h3 style="color:#f16c20;"> Ik wil graag mijn kind voor deze zomer inschrijven</h3>
				<label style="padding-bottom: 20px;" class="form-label">Komt dit jaar: </label>
				<input type="radio" id="1" name="actief" value="1" class="form-input" <?php if (!empty($_POST['actief']) && $_POST['actief'] == '1'){ echo 'checked="true"'; }?> />
				<label style="padding-bottom: 20px;" class="form-label" for="1" >ja</label>
				<input type="radio" id="0" name="actief" value="0" class="form-input" <?php if (!empty($_POST['actief']) && $_POST['actief'] == '0'){ echo 'checked="true"'; }?> />
				<label style="padding-bottom: 20px;" class="form-label" for="0">neen</label>
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['actief'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['actief']}</p>";?></span>
            </div>

            <div>
                <label class="form-label">Opmerkingen over het kind of vragen (niet verpicht):</label>
                <textarea id="text_3" placeholder="Mijn kind heeft hooikoorts dit is niet ernstig" rows="10" cols="75" name="notities"><?php if(!empty($_POST['notities'])) echo $_POST['notities']; ?></textarea>
            </div>


            <div class="submit">
                <input type="submit" name="action" value="Opslaan" class="form-submit" />
                <input type="submit" name="add" value="Opslaan en nog een kind toevoegen" class="form-submit" />
            </div>
        </article>
    </form>

	<!-- ouder -->
	<form class="register-form" action="<?php //$_SERVER['PHP_SELF']; ?>" method="post" class="forum">
        <article class="basic" >
        <h3>ouder</h3>
        <p><b> Gelieve dit formulier in Google Chrome, Mozilla firefox of Safari in te vullen,<br /> Internet Explorer is afgeraden</b> </p>
			<?php if(!empty($errors)): ?>
			<span class="error" style="color: #BA383C;">
				registratie is mislukt! er zijn velden leeg!
			</span>
			<?php endif; ?>
			<div class="input-container text">
                <label class="form-label" for="adres">voornaam ouder:</label>
                <input type="text" id="adres"  name="adres" class="form-input" placeholder="Sint-jozefstraat 10" value="<?php if(!empty($_POST['adres'])) echo $_POST['adres']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['adres'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['adres']}</p>";?></span>
            </div>
            <div class="input-container text">
                <label class="form-label" for="adres">achternaam ouder:</label>
                <input type="text" id="adres"  name="adres" class="form-input" placeholder="Sint-jozefstraat 10" value="<?php if(!empty($_POST['adres'])) echo $_POST['adres']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['adres'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['adres']}</p>";?></span>
            </div>
            <div class="input-container text">
                <label class="form-label" for="adres">E-mail adress:</label>
                <input type="text" id="adres"  name="adres" class="form-input" placeholder="Sint-jozefstraat 10" value="<?php if(!empty($_POST['adres'])) echo $_POST['adres']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['adres'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['adres']}</p>";?></span>
            </div>
			<div class="input-container text">
				<label class="form-label-function">Functie: </label><br />
				<input type="radio" id="m" name="functie" value="m" class="form-input" checked="<?php if ($_POST['functie'] == 'm'){ echo true; }?>" />
				<label class="form-label" for="m" >Mama</label>
				<input type="radio" id="p" name="functie" value="p" class="form-input" checked="<?php if ($_POST['functie'] == 'p'){ echo true; }?>" />
				<label class="form-label" for="p">Papa</label>
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['functie'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['functie']}</p>";?></span>
            </div>
            <div class="input-container text">
                <label class="form-label" for="adres">Straat en nummer:</label>
                <input type="text" id="adres"  name="adres" class="form-input" placeholder="Sint-jozefstraat 10" value="<?php if(!empty($_POST['adres'])) echo $_POST['adres']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['adres'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['adres']}</p>";?></span>
            </div>
            <div class="input-container text">
                <label class="form-label" for="gemeente">Gemeente of stad:</label>
                <input type="text" id="gemeente" name="gemeente" class="form-input" placeholder="Oostakker" value="<?php if(!empty($_POST['gemeente'])) echo $_POST['gemeente']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['gemeente'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['gemeente']}</p>";?></span>
            </div>
			<div class="input-container text">
                <label class="form-label post" for="post">Postcode:</label>
                <input type="text" id="post"  name="post" class="form-input" maxlength="4" pattern="[0-9]{4}" placeholder="9041" value="<?php if(!empty($_POST['post'])) echo $_POST['post']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['post'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['post']}</p>";?></span>
            </div>

			<div class="input-container text tele">
                <label class="form-label" for="tel" >Telefoon of GSM:</label>
                <input type="text" id="tel"  name="tel" class="form-input" placeholder="0477 47 52 09" value="<?php if(!empty($_POST['tel'])) echo $_POST['tel']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['tel'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['tel']}</p>";?></span>
            </div>
			<div class="input-container text tele">
                <label class="form-label" for="tel2" >Nood nummer:</label>
                <input type="text" id="tel2" name="tel2" class="form-input" placeholder="0477 47 52 09" value="<?php if(!empty($_POST['tel2'])) echo $_POST['tel2']; ?>" />
                <span class="error" style="color: #BA383C;"><?php if(!empty($errors['tel2'])) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['tel2']}</p>";?></span>
            </div>

            <div class="submit">
                <input type="submit" name="action" value="doorgaan" class="form-submit" />
            </div>
        </article>
    </form>

</section>
