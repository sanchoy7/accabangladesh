<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
if($course_materials):
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
			<td><?php echo __('Student Name'); ?></td>
			<td><?php echo __('Semister No'); ?></td>
			<!--<td><?php // echo __('Particulars'); ?></td> -->
			<td><?php echo __('Date'); ?></td>
			<td><?php echo __('Status'); ?></td>
			<td><?php echo __('Created'); ?></td>
			<td><?php echo __('Modified'); ?></td>
			<td class="delete">&nbsp;</td>
		</tr>
	</thead>
	<tbody align="left" valign="middle">
	<?php 
		foreach($course_materials as $course_material):
		if($course_material->status==='active'){$color="style='color:#006633'";}else{$color="style='color:#CC0000'";}
	?>
		<tr>
			<td><?php echo form::checkbox('checkbox_'.$course_material->id, $course_material->id); ?></td>
			<td><?php echo html::anchor('admin/course_material/edit/'.$course_material->id, (ORM::factory('admission_info')->where('stud_id', $course_material->stud_id)->find()->stud_name).' ('.$course_material->stud_id.')'); ?></td>
			<td><?php echo $course_material->semister_no; ?></td>
			<!--<td><?php //echo text::limit_words($course_material->particulars, 3); ?></td> -->
			<td><?php echo $course_material->provide_date; ?></td>
			<td <?php echo $color; ?>><?php echo ucfirst($course_material->status); ?></td>
			<td><?php echo date('M d, Y', strtotime($course_material->created)); ?></td>
			<td><?php echo date('M d, Y', strtotime($course_material->modified)); ?></td>
			<td class="delete">
			<?php echo html::anchor('admin/course_material/delete/'.$course_material->id, html::image(
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