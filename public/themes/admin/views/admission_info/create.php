<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open_multipart(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>
<script type="text/javascript">
	$(function() {
		$("#admission_date").datepicker();
	});
</script>
<div class="box">
	<h3><?php echo __('Add Admission Information'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($stud_id->name, $stud_id->label); ?><span class="required">*</span>
			<?php echo empty($stud_id->error) ? form::input($stud_id->name, $stud_id->value) : form::input($stud_id->name, $stud_id->values, $stud_id->value); ?>
			<?php if(!empty($stud_id->error)): ?><br /><span class="error"><?php echo $stud_id->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($stud_name->name, $stud_name->label); ?><span class="required">*</span>
			<?php echo empty($stud_name->error) ? form::input($stud_name->name, $stud_name->value) : form::input($stud_name->name, $stud_name->value); ?>
			<?php if(!empty($stud_name->error)): ?><br /><span class="error"><?php echo $stud_name->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($course_name->name, $course_name->label); ?><span class="required">*</span>
			<?php echo empty($course_name->error) ? form::dropdown($course_name->name, $course_name->values, $course_name->value, "style='width:90%;'") : form::dropdown($course_name->name, $course_name->values, $course_name->value, "style='width:90%;'"); ?>
			<?php if(!empty($course_name->error)): ?><br /><span class="error"><?php echo $course_name->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($money_receipt_no->name, $money_receipt_no->label); ?><span class="required">*</span>
			<?php echo empty($money_receipt_no->error) ? form::input($money_receipt_no->name, $money_receipt_no->value) : form::input($money_receipt_no->name, $money_receipt_no->value); ?>
			<?php if(!empty($money_receipt_no->error)): ?><br /><span class="error"><?php echo $money_receipt_no->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($admission_date->name, $admission_date->label); ?><span class="required">*</span>
			<?php echo empty($admission_date->error) ? form::input($admission_date->name, $admission_date->value) : form::input($admission_date->name, $admission_date->value); ?>
			<?php if(!empty($admission_date->error)): ?><br /><span class="error"><?php echo $admission_date->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($batch_no->name, $batch_no->label); ?><span class="required">*</span>
			<?php echo empty($batch_no->error) ? form::dropdown($batch_no->name, $batch_no->values, $batch_no->value, "style='width:90%;'") : form::dropdown($batch_no->name, $batch_no->values, $batch_no->value, "style='width:90%;'"); ?>
			<?php if(!empty($batch_no->error)): ?><br /><span class="error"><?php echo $batch_no->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($batch_day->name, $batch_day->label); ?><span class="required">*</span>
			<?php echo empty($batch_day->error) ? form::dropdown($batch_day->name, $batch_day->values, $batch_day->value, "style='width:90%;'") : form::dropdown($batch_day->name, $batch_day->values, $batch_day->value, "style='width:90%;'"); ?>
			<?php if(!empty($batch_day->error)): ?><br /><span class="error"><?php echo $batch_day->error; ?></span><?php endif; ?>
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
	</div>
</div>

<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>