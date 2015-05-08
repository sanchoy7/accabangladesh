<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open_multipart(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>
<script type="text/javascript">
	$(function() {
		$("#payment_date").datepicker();
	});
</script>
<div class="box">
	<h3><?php echo __('Edit Semister Information'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($stud_id->name, $stud_id->label); ?><span class="required">*</span>
			<?php echo empty($stud_id->error) ? form::dropdown($stud_id->name, $stud_id->values, $stud_id->value, "style='width:90%;'") : form::dropdown($stud_id->name, $stud_id->values, $stud_id->value, "style='width:90%;'"); ?>
			<?php if(!empty($stud_id->error)): ?><br /><span class="error"><?php echo $stud_id->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($course_name->name, $course_name->label); ?><span class="required">*</span>
			<?php echo empty($course_name->error) ? form::dropdown($course_name->name, $course_name->values, $course_name->value, "style='width:90%;'") : form::dropdown($course_name->name, $course_name->values, $course_name->value, "style='width:90%;'"); ?>
			<?php if(!empty($course_name->error)): ?><br /><span class="error"><?php echo $course_name->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($semister_no->name, $semister_no->label); ?><span class="required">*</span>
			<?php echo empty($semister_no->error) ? form::dropdown($semister_no->name, $semister_no->values, $semister_no->value, "style='width:90%;'") : form::dropdown($semister_no->name, $semister_no->values, $semister_no->value, "style='width:90%;'"); ?>
			<?php if(!empty($semister_no->error)): ?><br /><span class="error"><?php echo $semister_no->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($semister_course_details->name, $semister_course_details->label); ?><span class="required">*</span>
			<?php echo empty($semister_course_details->error) ? form::input($semister_course_details->name, $semister_course_details->value) : form::input($semister_course_details->name, $semister_course_details->value); ?>
			<?php if(!empty($semister_course_details->error)): ?><br /><span class="error"><?php echo $semister_course_details->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($admission_fees->name, $admission_fees->label); ?><span class="required">*</span>
			<?php echo empty($admission_fees->error) ? form::input($admission_fees->name, $admission_fees->value) : form::input($admission_fees->name, $admission_fees->value); ?>
			<?php if(!empty($admission_fees->error)): ?><br /><span class="error"><?php echo $admission_fees->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($fees_per_module->name, $fees_per_module->label); ?><span class="required">*</span>
			<?php echo empty($fees_per_module->error) ? form::input($fees_per_module->name, $fees_per_module->value) : form::input($fees_per_module->name, $fees_per_module->value); ?>
			<?php if(!empty($fees_per_module->error)): ?><br /><span class="error"><?php echo $fees_per_module->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($modules_in_semister->name, $modules_in_semister->label); ?><span class="required">*</span>
			<?php echo empty($modules_in_semister->error) ? form::input($modules_in_semister->name, $modules_in_semister->value) : form::input($modules_in_semister->name, $modules_in_semister->value); ?>
			<?php if(!empty($modules_in_semister->error)): ?><br /><span class="error"><?php echo $modules_in_semister->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($vat->name, $vat->label); ?><span class="required">*</span>
			<?php echo empty($vat->error) ? form::input($vat->name, $vat->value) : form::input($vat->name, $vat->value); ?>
			<?php if(!empty($vat->error)): ?><br /><span class="error"><?php echo $vat->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($discount->name, $discount->label); ?><span class="required">*</span>
			<?php echo empty($discount->error) ? form::input($discount->name, $discount->value) : form::input($discount->name, $discount->value); ?>
			<?php if(!empty($discount->error)): ?><br /><span class="error"><?php echo $discount->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($semister_total_fees->name, $semister_total_fees->label); ?><span class="required">*</span>
			<?php echo empty($semister_total_fees->error) ? form::input($semister_total_fees->name, $semister_total_fees->value) : form::input($semister_total_fees->name, $semister_total_fees->value); ?>
			<?php if(!empty($semister_total_fees->error)): ?><br /><span class="error"><?php echo $semister_total_fees->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($amount_payable->name, $amount_payable->label); ?><span class="required">*</span>
			<?php echo empty($amount_payable->error) ? form::input($amount_payable->name, $amount_payable->value) : form::input($amount_payable->name, $amount_payable->value); ?>
			<?php if(!empty($amount_payable->error)): ?><br /><span class="error"><?php echo $amount_payable->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($amount_paid->name, $amount_paid->label); ?><span class="required">*</span>
			<?php echo empty($amount_paid->error) ? form::input($amount_paid->name, $amount_paid->value) : form::input($amount_paid->name, $amount_paid->value); ?>
			<?php if(!empty($amount_paid->error)): ?><br /><span class="error"><?php echo $amount_paid->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($amount_due->name, $amount_due->label); ?><span class="required">*</span>
			<?php echo empty($amount_due->error) ? form::input($amount_due->name, $amount_due->value) : form::input($amount_due->name, $amount_due->value); ?>
			<?php if(!empty($amount_due->error)): ?><br /><span class="error"><?php echo $amount_due->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($payment_date->name, $payment_date->label); ?><span class="required">*</span>
			<?php echo empty($payment_date->error) ? form::input($payment_date->name, $payment_date->value) : form::input($payment_date->name, $payment_date->value); ?>
			<?php if(!empty($payment_date->error)): ?><br /><span class="error"><?php echo $payment_date->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($money_receipt_no->name, $money_receipt_no->label); ?><span class="required">*</span>
			<?php echo empty($money_receipt_no->error) ? form::input($money_receipt_no->name, $money_receipt_no->value) : form::input($money_receipt_no->name, $money_receipt_no->value); ?>
			<?php if(!empty($money_receipt_no->error)): ?><br /><span class="error"><?php echo $money_receipt_no->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($amount_received_by->name, $amount_received_by->label); ?><span class="required">*</span>
			<?php echo empty($amount_received_by->error) ? form::input($amount_received_by->name, $amount_received_by->value) : form::input($amount_received_by->name, $amount_received_by->value); ?>
			<?php if(!empty($amount_received_by->error)): ?><br /><span class="error"><?php echo $amount_received_by->error; ?></span><?php endif; ?>
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