<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
if($expense_syllabuses):
/// Returns local time
date_default_timezone_set("Asia/Dhaka");

echo form::open(url::current(), array('id' => 'confirmIt'));	
echo "<p style='margin:10px 0 0 2px;'>";
echo form::submit('active', 'Activate').str_repeat('&nbsp;', 4);
echo form::submit('inactive', 'Inactivate').str_repeat('&nbsp;', 4);
echo form::submit('delete', 'Delete Selected Contents');
echo "</p>";
echo "<hr/>";
?>

<table cellspacing="0" cellpadding="0" class="table">
	<thead align="left" valign="middle">
		<tr>
			<td><input type="checkbox" name="select-all" onclick="toggleSelectAllCheckboxes(this)" /></td>
			<td><?php echo __('Course Name'); ?></td>
			<td><?php echo __('Course Type'); ?></td>
			<td><?php echo __('Status'); ?></td>
			<td><?php echo __('Created'); ?></td>
			<td><?php echo __('Modified'); ?></td>
			<td class="delete">&nbsp;</td>
		</tr>
	</thead>
	<tbody align="left" valign="middle">
	<?php 
		foreach($expense_syllabuses as $expense_syllabus):
		if($expense_syllabus->status==='active'){$color="style='color:#006633'";}else{$color="style='color:#CC0000'";}
	?>
		<tr>
			<td><?php echo form::checkbox('checkbox_'.$expense_syllabus->id, $expense_syllabus->id); ?></td>
			<td><?php echo html::anchor('admin/expense_syllabus/edit/'.$expense_syllabus->id,  text::limit_words($expense_syllabus->course_name, 6)); ?></td>
			<td><?php echo ucwords($expense_syllabus->course_type); ?></td>
			<td <?php echo $color; ?>><?php echo ucfirst($expense_syllabus->status); ?></td>
			<td><?php echo date('M d, Y', strtotime($expense_syllabus->created)); ?></td>
			<td><?php echo date('M d, Y', strtotime($expense_syllabus->modified)); ?></td>
			<td class="delete">
			<?php echo html::anchor('admin/expense_syllabus/delete/'.$expense_syllabus->id, html::image(
				'public/themes/admin/images/delete.png',
				array(
					'alt' => __('Delete Content'),
					'title' => __('Delete Content')
				)), array('class' => 'confirm', 'onclick' => 'return confirm("Are you sure to delete the content?")'));
			 ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<div class="paginat"><?php echo $pagination; ?></div>
<?php
echo form::open();
endif;
?>