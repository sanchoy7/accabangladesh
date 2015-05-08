<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
if($faqs):
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
			<td><?php echo __('FAQ Title'); ?></td>
			<td><?php echo __('Course Name'); ?></td>
			<td><?php echo __('FAQ Category'); ?></td>
			<td><?php echo __('Status'); ?></td>
			<td><?php echo __('Created'); ?></td>
			<td><?php echo __('Modified'); ?></td>
			<td class="delete">&nbsp;</td>
		</tr>
	</thead>
	<tbody align="left" valign="middle">
	<?php 
		foreach($faqs as $faq):
		if($faq->status==='active'){$color="style='color:#006633'";}else{$color="style='color:#CC0000'";}
	?>
		<tr>
			<td><?php echo form::checkbox('checkbox_'.$faq->id, $faq->id); ?></td>
			<td><?php echo html::anchor('admin/faq/edit/'.$faq->id, text::limit_words($faq->faq_title, 6)); ?></td>
			<td><?php echo ucwords($faq->course_name); ?></td>
			<td><?php echo ucwords($faq->faq_category); ?></td>
			<td <?php echo $color; ?>><?php echo ucfirst($faq->status); ?></td>
			<td><?php echo date('M d, Y', strtotime($faq->created)); ?></td>
			<td><?php echo date('M d, Y', strtotime($faq->modified)); ?></td>
			<td class="delete">
			<?php echo html::anchor('admin/faq/delete/'.$faq->id, html::image(
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