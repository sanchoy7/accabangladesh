<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<table cellspacing="0" cellpadding="0" class="table">
	<thead align="left" valign="middle">
		<tr>
			<td><?php echo __('Title'); ?></td>
			<td><?php echo __('Created on'); ?></td>
			<td><?php echo __('Author'); ?></td>
			<td><?php echo __('Comments'); ?></td>
			<td class="delete">&nbsp;</td>
		</tr>
	</thead>
	<tbody align="left" valign="middle">
	<?php if($posts) foreach($posts as $post): ?>
		<tr>
			<td>
				<?php echo html::anchor('admin/blog/edit/'.$post->id, $post->title); ?>
				&mdash;
				<?php echo html::anchor('admin/blog/comments/view/'.$post->id, __n('One comment', '%count comments', $post->comment_count)); ?>
			</td>
			<td><?php echo $post->date; ?></td>
			<td><?php echo $post->user->username; ?></td>
			<td>
				<?php if($post->comment_status === 'open'): ?>
					<?php echo html::anchor('admin/blog/comments/close/'.$post->id, __('open')); ?>
				<?php else: ?>
					<?php echo html::anchor('admin/blog/comments/open/'.$post->id, __('closed')); ?>
				<?php endif; ?>
			</td>
			<td class="delete">
			<?php echo html::anchor('admin/blog/delete/'.$post->id, html::image(
				'public/themes/admin/images/delete.png',
				array(
					'alt' => __('Delete Page'),
					'title' => __('Delete Page')
				)), array('class' => 'confirm'));
			?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>