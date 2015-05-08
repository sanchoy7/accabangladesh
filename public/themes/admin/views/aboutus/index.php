<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<script type="text/javascript">
$(function(){
	$('#dialog22').dialog({
		autoOpen: false,
		width: 400,
		modal: true,
		resizable: false,
		buttons: {
			"Yes, I do": function() {
				document.forms["confirmIt"].submit();
			},
			"No, I don't": function() {
				$(this).dialog("close");
				$('#'+$('.delete').attr('id')).dialog("close");
			}
		}
	});
	
	$('form#confirmIt22').submit(function(){
		$('#dialog-delete').html("Do you really want to delete the selected content?");
		$('#dialog').dialog('open');
		return false;
	});
	
	$('#'+$('.delete').attr('id')).click(function(){
		$('#dialog-delete').html("Do you really want to delete the content?");
		$('#dialog').dialog('open');
		return false;
	});
});
</script>

<?php
if($aboutus):
/// Returns local time
date_default_timezone_set("Asia/Dhaka");

echo form::open(url::current(), array('id' => 'confirmIt'));	
echo "<p style='margin:10px 0 0 2px;'>";
echo form::submit('active', 'Activate').str_repeat('&nbsp;', 4);
echo form::submit('inactive', 'Inactivate').str_repeat('&nbsp;', 4);
echo form::submit('delete', 'Delete Selected Contents');
echo "</p>";
echo "<hr />";
?>

<table cellspacing="0" cellpadding="0" class="table">
	<thead align="left" valign="middle">
		<tr>
			<td><input type="checkbox" name="select-all" onclick="toggleSelectAllCheckboxes(this)" /></td>
			<td><?php echo __('About Us Title'); ?></td>
			<td><?php echo __('About Us Type'); ?></td>
			<td><?php echo __('Status'); ?></td>
			<td><?php echo __('Created'); ?></td>
			<td><?php echo __('Modified'); ?></td>
			<td class="delete">&nbsp;</td>
		</tr>
	</thead>
	<tbody align="left" valign="middle">
	<?php 
		$i = 1;
		foreach($aboutus as $about):
		if($about->status==='active'){$color="style='color:#006633'";}else{$color="style='color:#CC0000'";}
	?>
		<tr>
			<td><?php echo form::checkbox('checkbox_'.$about->id, $about->id); ?></td>
			<td><?php echo html::anchor('admin/aboutus/edit/'.$about->id, text::limit_words($about->about_title, 6)); ?></td>
			<td><?php echo ucwords($about->about_type); ?></td>
			<td <?php echo $color; ?>><?php echo ucfirst($about->status); ?></td>
			<td><?php echo date('M d, Y', strtotime($about->created)); ?></td>
			<td><?php echo date('M d, Y', strtotime($about->modified)); ?></td>
			<td class="delete">
			<?php echo html::anchor('admin/aboutus/delete/'.$about->id, html::image(
				'public/themes/admin/images/delete.png',
				array(
					'alt' => __('Delete Content'),
					'title' => __('Delete Content')
				)), array('class' => 'confirm', 'id' => 'del'.$i));//, 'onclick' => 'return confirm("Are you sure to delete the content?")'));
			 	$i++;
			 ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<div id="dialog" title="Verify Form jQuery UI Style" style="display: none;">
	<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span>
	<span id="dialog-delete" style="float:left;"></span><br />
	<p>If you are sure to delete the content then click "Yes I do", it will be removed forever. Otherwise, click "No, I don't"</p>
</div>
			
<div class="paginat"><?php echo $pagination; ?></div>
<?php
echo form::open();
endif;
?>