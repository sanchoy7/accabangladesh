<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
if($personals):
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
			<td><?php echo __('Stud ID'); ?></td>
			<td><?php echo __('Stud Name'); ?></td>
			<td><?php echo __('Email'); ?></td>
			<td><?php echo __('Cell No'); ?></td>
			<!--<td><?php //echo __('Phone'); ?></td>
			<td><?php //echo __('Payment Status'); ?></td>-->
			<td><?php echo __('Status'); ?></td>
			<td><?php echo __('Created'); ?></td>
			<td><?php echo __('Modified'); ?></td>
			<td class="delete">&nbsp;</td>
		</tr>
	</thead>
	<tbody align="left" valign="middle">
	<?php 
		foreach($personals as $personal):
		if($personal->status==='active'){$color="style='color:#006633'";}else{$color="style='color:#CC0000'";}
	?>
		<tr>
			<td><?php echo form::checkbox('checkbox_'.$personal->id, $personal->id); ?></td>
			<td><?php echo html::anchor('admin/personal_info/edit/'.$personal->id, $personal->stud_id); ?></td>
			<td><?php echo ORM::factory('admission_info')->where('stud_id', $personal->stud_id)->find()->stud_name; ?></td>
			<td><?php echo $personal->email; ?></td>
			<td><?php echo $personal->cell_no; ?></td>
			<!--<td><?php //echo $personal->phone; ?></td>
			<td><?php //echo $personal->payment_status; ?></td>-->
			<td <?php echo $color; ?>><?php echo ucfirst($personal->status); ?></td>
			<td><?php echo date('M d, Y', strtotime($personal->created)); ?></td>
			<td><?php echo date('M d, Y', strtotime($personal->modified)); ?></td>
			<td class="delete">
			<?php echo html::anchor('admin/personal_info/delete/'.$personal->id, html::image(
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