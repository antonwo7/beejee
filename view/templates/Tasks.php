<?php
	
?>

<?php if(!empty($tasks)){ ?>
	<div id="filter">
		<form action="<?=$get_tasks_action; ?>" method="GET">
			<label>Filter</label>
			<select name="sort" class="sort-filter">
				<option value="Name" <?php echo ( ( $sort == 'Name') ? "selected" : "" ); ?> >Name</option>
				<option value="Email" <?php echo ( ( $sort == 'Email') ? "selected" : "" ); ?> >Email</option>
				<option value="Task" <?php echo ( ( $sort == 'Task') ? "selected" : "" ); ?> >Task</option>
			</select>
			<select name="how" class="how-filter">
				<option value="asc" <?php echo ( ( $how == 'asc') ? "selected" : "" ); ?> >Ascending</option>
				<option value="desc" <?php echo ( ( $how == 'desc') ? "selected" : "" ); ?> >Descending</option>
			</select>
			<input type="submit" value="Filter"/>
		</form>
	</div>
	<table id="tasks">
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Tasks</th>
			<th>Status</th>
			<th></th>
		</tr>
		<?php foreach($tasks['list'] as $task){ ?>
		<tr>
			<td><?=e($task['Name']); ?></td>
			<td><?=e($task['Email']); ?></td>
			<td>
				<div id="task_<?=$task['id']; ?>">
				<?=e($task['Task']); ?>
				</div>
				
				<?php if( isAuth() ) { ?>
					<button class="but" onclick="editTask('<?php echo $task['id']; ?>')">Edit</button>
				<?php } ?>
			</td>
			<?php if($task['Status'] != 0) { ?>
			<td>Done</td>
			<?php }elseif( isAuth() ){ ?>
			<td>Undone&nbsp;<a class="but" href="<?php echo $doit_link . $task['id']; ?>">Do it</a></td>
			<?php }else{ ?>
			<td>Undone</td>
			<?php }?>
			
			<td>
				<div id="edited_<?=$task['id']; ?>">
				<?php if($task['Edited'] != 0) {?>
					Edited by Admin
				<?php }?>
				</div>
			</td>
		</tr>
		<?php }?>
	</table>
	<div class="paging">
		<?php for($i = 1; $i <= $pages; $i++) { ?>
			<?php if($i != $current_page) { ?>
				<a href="<?php echo $page_link . $i; ?>"><?=$i; ?></a>
			<?php } else { ?>
				<span><?=$i; ?></span>
			<?php } ?>
		<?php } ?>
	</div>
<?php } ?>

<div id="edit">
	<div class="edit-wraper">
		<textarea name="Task"></textarea>
		<button id="but-close">Close</button>
		<button id="but-save" class="loading">Save</button>
	</div>
</div>

<script>
function editTask(id){
	var edit = jQuery('#edit');
	edit.find('textarea').val('');
	edit.find('#but-save').addClass('loading');
	edit.find('#but-save').attr('task', id);
	edit.fadeIn(300);
	
	jQuery.ajax({
		url: '<?=$edit_task_action; ?>' + '/' + id,
		type: 'POST',
		data: id,
		
		success: function(data) {
			if (data) {
				edit.find('textarea').val(data);
				edit.find('#but-save').removeClass('loading');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
			
			edit.find('#but-save').removeClass('loading');
		}
	});
}

function saveTask(id){
	var edit = jQuery('#edit');
	var task_text = edit.find('textarea').val();
	edit.find('#but-save').addClass('loading');
	
	jQuery.ajax({
		url: '<?=$save_task_action; ?>' + '/' + id,
		type: 'POST',
		data: {
			task: task_text
		},
		success: function(data) {
			if(data != ''){
				edit.find('textarea').val(data);
				edit.find('#but-save').removeClass('loading');
			}else{
				jQuery('#task_' + id).html(task_text);
				jQuery('#edited_' + id).html('Edited by Admin');
				edit.find('#but-save').removeClass('loading');
				edit.fadeOut(300);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
			edit.find('#but-save').removeClass('loading');
		}
	});
	
	
}


jQuery('#but-close').on('click', function(){
	 jQuery('#edit').fadeOut(300);
});

jQuery('#but-save').on('click', function(){
	var id = jQuery(this).attr('task');
	saveTask(id);
});
</script>

<?php include 'AddTask.php'; ?>
