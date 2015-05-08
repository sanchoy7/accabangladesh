<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>

<div class="box">
	<h3><?php echo __('Edit Content'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($about_title->name, $about_title->label); ?><span class="required">*</span>
			<?php echo empty($about_title->error) ? form::input($about_title->name, $about_title->value) : form::input($about_title->name, $about_title->value); ?>
			<?php if(!empty($about_title->error)): ?><br /><span class="error"><?php echo $about_title->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($about_type->name, $about_type->label); ?><span class="required">*</span>
			<?php echo empty($about_type->error) ? form::dropdown($about_type->name, $about_type->values, $about_type->value, "style='width:90%;'") : form::dropdown($about_type->name, $about_type->values, $about_type->value, "style='width:90%;'"); ?>
			<?php if(!empty($about_type->error)): ?><br /><span class="error"><?php echo $about_type->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($status->name, $status->label); ?><span class="required">*</span>
			<?php echo empty($status->error) ? form::dropdown($status->name, $status->values, $status->value, "style='width:90%;'") : form::dropdown($status->name, $status->values, $status->value, "style='width:90%;'"); ?>
			<?php if(!empty($status->error)): ?><br /><span class="error"><?php echo $status->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($meta_keywords->name, $meta_keywords->label); ?><span class="required">*</span>
			<?php echo empty($meta_keywords->error) ? form::input($meta_keywords->name, $meta_keywords->value) : form::input($meta_keywords->name, $meta_keywords->value); ?>
			<?php if(!empty($meta_keywords->error)): ?><br /><span class="error"><?php echo $meta_keywords->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($meta_description->name, $meta_description->label); ?><span class="required">*</span>
			<?php echo empty($meta_description->error) ? form::input($meta_description->name, $meta_description->value) : form::input($meta_description->name, $meta_description->value); ?>
			<?php if(!empty($meta_description->error)): ?><br /><span class="error"><?php echo $meta_description->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($about_details->name, $about_details->label); ?><span class="required">*</span><br /><br />
			<?php echo empty($about_details->error) ? form::textarea($about_details->name, $about_details->value, "style='width:109%;'") : form::textarea($about_details->name, $about_details->value, "style='width:109%;'"); ?>
			<?php if(!empty($about_details->error)): ?><span class="error"><?php echo $about_details->error; ?></span><?php endif; ?>
		</p>
	</div>
</div>


<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>