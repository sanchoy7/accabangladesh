<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
if($accounts):
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
			<td><?php echo __('Student ID'); ?></td>
			<td><?php echo __('Student Name'); ?></td>
			<td><?php echo __('A. Payable'); ?></td>
			<td><?php echo __('A. Paid'); ?></td>
			<td><?php echo __('A. Due'); ?></td>
			<!--<td><?php //echo __('Payment Status'); ?></td>-->
			<td><?php echo __('Status'); ?></td>
			<td><?php echo __('Created'); ?></td>
			<td><?php echo __('Modified'); ?></td>
			<td class="delete">&nbsp;</td>
		</tr>
	</thead>
	<tbody align="left" valign="middle">
	<?php 
		foreach($accounts as $account):
		if($account->status==='active'){$color="style='color:#006633'";}else{$color="style='color:#CC0000'";}
	?>
		<tr>
			<td><?php echo form::checkbox('checkbox_'.$account->id, $account->id); ?></td>
			<td><?php echo html::anchor('admin/account/edit/'.$account->id, $account->stud_id); ?></td>
			<td><?php echo ORM::factory('admission_info')->where('stud_id', $account->stud_id)->find()->stud_name; ?></td>
			<td><?php echo $account->amount_payable.'&nbsp;TK'; ?></td>
			<td><?php echo $account->amount_paid.'&nbsp;TK'; ?></td>
			<td><?php echo $account->amount_due.'&nbsp;TK'; ?></td>
			<!--<td><?php //echo $account->payment_status; ?></td>-->
			<td <?php echo $color; ?>><?php echo ucfirst($account->status); ?></td>
			<td><?php echo date('M d, Y', strtotime($account->created)); ?></td>
			<td><?php echo date('M d, Y', strtotime($account->modified)); ?></td>
			<td class="delete">
			<?php echo html::anchor('admin/account/delete/'.$account->id, html::image(
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