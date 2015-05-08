<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>
<script type="text/javascript">
	$(function() {
		$("#payment_date").datepicker();
	});
</script>
<div class="box">
	<h3><?php echo __('EDIT Account Information'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($stud_id->name, $stud_id->label); ?><span class="required">*</span>
			<?php echo empty($stud_id->error) ? form::dropdown($stud_id->name, $stud_id->values, $stud_id->value, "style='width:90%;'") : form::dropdown($stud_id->name, $stud_id->values, $stud_id->value, "style='width:90%;'"); ?>
			<?php if(!empty($stud_id->error)): ?><br /><span class="error"><?php echo $stud_id->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($payment_date->name, $payment_date->label); ?><span class="required">*</span>
			<?php echo empty($payment_date->error) ? form::input($payment_date->name, $payment_date->value) : form::input($payment_date->name, $payment_date->value); ?>
			<?php if(!empty($about_title->error)): ?><br /><span class="error"><?php echo $about_title->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($money_receipt_no->name, $money_receipt_no->label); ?><span class="required">*</span>
			<?php echo empty($money_receipt_no->error) ? form::input($money_receipt_no->name, $money_receipt_no->value) : form::input($money_receipt_no->name, $money_receipt_no->value); ?>
			<?php if(!empty($money_receipt_no->error)): ?><br /><span class="error"><?php echo $money_receipt_no->error; ?></span><?php endif; ?>
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
			<?php echo form::label($payment_status->name, $payment_status->label); ?><span class="required">*</span>
			<?php echo empty($payment_status->error) ? form::dropdown($payment_status->name, $payment_status->values, $payment_status->value, "style='width:90%;'") : form::dropdown($payment_status->name, $payment_status->values, $payment_status->value, "style='width:90%;'"); ?>
			<?php if(!empty($payment_status->error)): ?><br /><span class="error"><?php echo $payment_status->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($received_by->name, $received_by->label); ?><span class="required">*</span>
			<?php echo empty($received_by->error) ? form::input($received_by->name, $received_by->value) : form::input($received_by->name, $received_by->value); ?>
			<?php if(!empty($received_by->error)): ?><br /><span class="error"><?php echo $received_by->error; ?></span><?php endif; ?>
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