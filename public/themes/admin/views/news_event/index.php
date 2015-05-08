<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
if($news_events):
/// Returns local time
date_default_timezone_set("Asia/Dhaka");

echo form::open();	
echo "<p style='margin:10px 0 0 2px;'>";
echo form::submit('active', 'Activate').str_repeat('&nbsp;', 4);
echo form::submit('inactive', 'Inactivate');
echo "</p>";
echo "<hr/>";
?>

<table cellspacing="0" cellpadding="0" class="table">
	<thead align="left" valign="middle">
		<tr>
			<td><input type="checkbox" name="select-all" onclick="toggleSelectAllCheckboxes(this)" /></td>
			<td><?php echo __('News/Event Title'); ?></td>
			<td><?php echo __('Type'); ?></td>
			<td><?php echo __('Status'); ?></td>
			<td><?php echo __('Created'); ?></td>
			<td><?php echo __('Modified'); ?></td>
			<td class="delete">&nbsp;</td>
		</tr>
	</thead>
	<tbody align="left" valign="middle">
	<?php 
		foreach($news_events as $news_event):
		if($news_event->status==='active'){$color="style='color:#006633'";}else{$color="style='color:#CC0000'";}
	?>
		<tr>
			<td><?php echo form::checkbox('checkbox_'.$news_event->id, $news_event->id); ?></td>
			<td><?php echo html::anchor('admin/news_event/edit/'.$news_event->id, text::limit_words($news_event->ne_title, 6)); ?></td>
			<td><?php echo ucwords($news_event->ne_type); ?></td>
			<td <?php echo $color; ?>><?php echo ucfirst($news_event->status); ?></td>
			<td><?php echo date('M d, Y', strtotime($news_event->created)); ?></td>
			<td><?php echo date('M d, Y', strtotime($news_event->modified)); ?></td>
			<td class="delete">
			<?php echo html::anchor('admin/news_event/delete/'.$news_event->id, html::image(
				'public/themes/admin/images/delete.png',
				array(
					'alt' => __('Delete Content'),
					'title' => __('Delete Content')
				)), array('class' => 'confirm'));
			 ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<div class="paginat"><?php //echo $pagination; ?></div>
<?php
//echo form::open();
endif;
?>