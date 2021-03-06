<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>

<div class="box">
	<h3><?php echo __('Add New Content'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($course_name->name, $course_name->label); ?><span class="required">*</span>
			<?php echo empty($course_name->error) ? form::dropdown($course_name->name, $course_name->values, $course_name->value, "style='width:90%;'") : form::dropdown($course_name->name, $course_name->values, $course_name->value, "style='width:90%;'"); ?>
			<?php if(!empty($course_name->error)): ?><br /><span class="error"><?php echo $course_name->error; ?></span><?php endif; ?>
		</p>

		<p>
			<?php echo form::label($course_type->name, $course_type->label); ?><span class="required">*</span>
			<?php echo empty($course_type->error) ? form::dropdown($course_type->name, $course_type->values, $course_type->value, "style='width:90%;'") : form::dropdown($course_type->name, $course_type->values, $course_type->value, "style='width:90%;'"); ?>
			<?php if(!empty($course_type->error)): ?><br /><span class="error"><?php echo $course_type->error; ?></span><?php endif; ?>
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
			<?php echo form::label($meta_description->name, $meta_description->label); ?>
			<?php echo empty($meta_description->error) ? form::input($meta_description->name, $meta_description->value) : form::input($meta_description->name, $meta_description->value); ?>
			<?php if(!empty($meta_description->error)): ?><br /><span class="error"><?php echo $meta_description->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($details->name, $details->label); ?><span class="required">*</span><br /><br />
			<?php echo empty($details->error) ? form::textarea($details->name, $details->value, "style='width:109%;'") : form::textarea($details->name, $details->value, "style='width:109%;'"); ?>
			<?php if(!empty($details->error)): ?><span class="error"><?php echo $details->error; ?></span><?php endif; ?>
		</p>
	</div>
</div>

<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>