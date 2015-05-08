<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>
<div class="box">
	<h3><?php echo __('Page Information'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($type->name, __('Redirect page or load Module')); ?>
			<?php
				foreach ($type->elements as $key => $value)
				{
					switch ($value) {
						case 'module':
							echo form::radio($type->name, $value, ( ! empty($page->target) AND $page->type === 'module')).' '.$type->$key->label.': ';
							echo form::dropdown($module->name, $module->values, $module->value).'<br />';
							break;
						
						case 'redirect':
							echo form::radio($type->name, $value, ( ! empty($page->target) AND $page->type === 'redirect')).' '.$type->$key->label.': ';
							echo form::dropdown($redirect->name, $redirect->values, $redirect->value);
							break;
							
						default:
							echo form::radio($type->name, $value, empty($page->target)).' '.$type->$key->label;
							echo '<br />';
							break;
					}
				}
			?>
	</div>
</div>
<?php foreach (Kohana::config('locale.languages') as $key => $value): ?>
<div class="box">
	<h3><?php echo __('Content'); ?> <small>(<?php echo $value['name']; ?>)</small></h3>
	<div class="inside">
		<p>
			<?php echo form::label(${'title_'.$key}->name, ${'title_'.$key}->label); ?>
			<?php echo empty(${'title_'.$key}->error) ? form::input(${'title_'.$key}->name, ${'title_'.$key}->value) : form::input(${'title_'.$key}->name, ${'title_'.$key}->value, 'class="error"'); ?>
			<?php if ( ! empty(${'title_'.$key}->error)): ?><br /><span class="error"><?php echo ${'title_'.$key}->error; ?></span><?php endif; ?>
		</p>
		<p><?php echo form::label(${'content_'.$key}->name, ${'content_'.$key}->label).form::textarea(${'content_'.$key}->name, ${'content_'.$key}->value, 'style="width:108%;"'); ?></p>
	</div>
</div>
<?php endforeach; ?>

<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>