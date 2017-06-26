<section class="right_col" role="main">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2> Gebruiker vewijderen </h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />

          </ul> 
			<?php foreach ($users as $user): ?>
				<li style="list-style: none;"><h2><?php echo $user['username'] ?> - <a href="index.php?page=delete&id=<?php echo $user['registratiedatum'] ?>"> Delete user</a></h2></li>

			<?php endforeach; ?>
			<ul>

        </div>
      </div>
    </div>
  </div>	

</section>