<div class="login">
	<div class="errors">
		<?php if(!empty($messages['errors'])) { ?>
			<?php foreach($messages['errors'] as $error) { 
				echo $error . "<br/>";
			} ?>
		<?php } ?>
	</div>
	<div class="success">
		<?php if(!empty($messages['success'])) echo $messages['success']; ?>
	</div>
	
	<?php if(isAuth()) { ?>
	<label>Hello logged user!<label>
	<a class="but" href="<?=$logout_action; ?>">Logout</a>
	<?php }else{ ?>
	<label>Login</label>
	<form action="<?=$action; ?>" method="POST">
		<input type="text" name="Login" value=""/>
		<input type="text" name="Password" value=""/>
		<input type="submit" value="Войти"/>
	</form>
	<?php } ?>
</div>