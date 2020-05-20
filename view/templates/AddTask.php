<div id="addtask">
	<div class="errors">
		<?php if(!empty($messages['errors'])) { ?>
			<b>Check these faults!</b><br/>
			<?php foreach($messages['errors'] as $error) { 
				echo $error . "<br/>";
			} ?>
		<?php } ?>
	</div>
	<div class="success">
	<?php if(!empty($messages['success'])) echo $messages['success']; ?>
	</div>
	<h3>You can note your tasks, friend</h3>
	<form action="<?=$add_task_action; ?>" method="POST">
		<input type="text" name="Name" placeholder="Your name..."/>
		<input type="text" name="Email" placeholder="Your email..."/>
		<textarea name="Task" placeholder="Your task..."></textarea>
		<input type="submit" value="Send"/>
	</form>
</div>