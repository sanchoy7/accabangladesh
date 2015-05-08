<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open_multipart(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>

<div class="box">
	<h3><?php echo __('Edit Account Information'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($stud_id->name, $stud_id->label); ?><span class="required">*</span>
			<?php echo empty($stud_id->error) ? form::dropdown($stud_id->name, $stud_id->values, $stud_id->value, "style='width:90%;'") : form::dropdown($stud_id->name, $stud_id->values, $stud_id->value, "style='width:90%;'"); ?>
			<?php if(!empty($stud_id->error)): ?><br /><span class="error"><?php echo $stud_id->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($father_name->name, $father_name->label); ?><span class="required">*</span>
			<?php echo empty($father_name->error) ? form::input($father_name->name, $father_name->value) : form::input($father_name->name, $father_name->value); ?>
			<?php if(!empty($father_name->error)): ?><br /><span class="error"><?php echo $father_name->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($mother_name->name, $mother_name->label); ?><span class="required">*</span>
			<?php echo empty($mother_name->error) ? form::input($mother_name->name, $mother_name->value) : form::input($mother_name->name, $mother_name->value); ?>
			<?php if(!empty($mother_name->error)): ?><br /><span class="error"><?php echo $mother_name->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($mailing_address->name, $mailing_address->label); ?><span class="required">*</span>
			<?php echo empty($mailing_address->error) ? form::input($mailing_address->name, $mailing_address->value) : form::input($mailing_address->name, $mailing_address->value); ?>
			<?php if(!empty($mailing_address->error)): ?><br /><span class="error"><?php echo $mailing_address->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($permanent_address->name, $permanent_address->label); ?><span class="required">*</span>
			<?php echo empty($permanent_address->error) ? form::input($permanent_address->name, $permanent_address->value) : form::input($permanent_address->name, $permanent_address->value); ?>
			<?php if(!empty($permanent_address->error)): ?><br /><span class="error"><?php echo $permanent_address->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($email->name, $email->label); ?><span class="required">*</span>
			<?php echo empty($email->error) ? form::input($email->name, $email->value) : form::input($email->name, $email->value); ?>
			<?php if(!empty($email->error)): ?><br /><span class="error"><?php echo $email->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($phone->name, $phone->label); ?><span class="required">*</span>
			<?php echo empty($phone->error) ? form::input($phone->name, $phone->value, "style='width:90%;'") : form::input($phone->name, $phone->value, "style='width:90%;'"); ?>
			<?php if(!empty($phone->error)): ?><br /><span class="error"><?php echo $phone->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($cell_no->name, $cell_no->label); ?><span class="required">*</span>
			<?php echo empty($cell_no->error) ? form::input($cell_no->name, $cell_no->value) : form::input($cell_no->name, $cell_no->value); ?>
			<?php if(!empty($cell_no->error)): ?><br /><span class="error"><?php echo $cell_no->error; ?></span><?php endif; ?>
		</p>
		<p style="width: 50%; float:left;">
			<?php echo form::label($picture->name, $picture->label); ?><span class="required">*</span><br /><br />
			<?php echo empty($picture->error) ? form::upload($picture->name, $picture->value) : form::upload($picture->name, $picture->value); ?>
			<?php if(!empty($picture->error)): ?><br /><span class="error"><?php echo $picture->error; ?></span><?php endif; ?>
		</p>
		<p style="width: 40%; float:left;"><img src="<?php echo url::base(TRUE).'public/photos/students/'.$picture->value; ?>" height="100" width="100" /></p>
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
	</div>
</div>


<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>