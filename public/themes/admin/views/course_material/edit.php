<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>
<script type="text/javascript">
	$(function() {
		$("#provide_date").datepicker();
	});
</script>
<div class="box">
	<h3><?php echo __('Edit New Content'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($stud_id->name, $stud_id->label); ?><span class="required">*</span>
			<?php echo empty($stud_id->error) ? form::dropdown($stud_id->name, $stud_id->values, $stud_id->value, "style='width:90%;'") : form::dropdown($stud_id->name, $stud_id->values, $stud_id->value, "style='width:90%;'"); ?>
			<?php if(!empty($stud_id->error)): ?><br /><span class="error"><?php echo $stud_id->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($semister_no->name, $semister_no->label); ?><span class="required">*</span>
			<?php echo empty($semister_no->error) ? form::dropdown($semister_no->name, $semister_no->values, $semister_no->value, "style='width:90%;'") : form::dropdown($semister_no->name, $semister_no->values, $semister_no->value, "style='width:90%;'"); ?>
			<?php if(!empty($semister_no->error)): ?><br /><span class="error"><?php echo $semister_no->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($provide_date->name, $provide_date->label); ?><span class="required">*</span>
			<?php echo empty($provide_date->error) ? form::input($provide_date->name, $provide_date->value) : form::input($provide_date->name, $provide_date->value); ?>
			<?php if(!empty($provide_date->error)): ?><br /><span class="error"><?php echo $provide_date->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($provide_by->name, $provide_by->label); ?><span class="required">*</span>
			<?php echo empty($provide_by->error) ? form::input($provide_by->name, $provide_by->value) : form::input($provide_by->name, $provide_by->value); ?>
			<?php if(!empty($provide_by->error)): ?><br /><span class="error"><?php echo $provide_by->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($remarks->name, $remarks->label); ?><span class="required">*</span>
			<?php echo empty($remarks->error) ? form::input($remarks->name, $remarks->value) : form::input($remarks->name, $remarks->value); ?>
			<?php if(!empty($remarks->error)): ?><br /><span class="error"><?php echo $remarks->error; ?></span><?php endif; ?>
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
			<?php echo form::label($particulars->name, $particulars->label); ?><span class="required">*</span><br /><br />
			<?php echo empty($particulars->error) ? form::textarea($particulars->name, $particulars->value, "style='width:109%;'") : form::textarea($particulars->name, $particulars->value, "style='width:109%;'"); ?>
			<?php if(!empty($particulars->error)): ?><span class="error"><?php echo $particulars->error; ?></span><?php endif; ?>
		</p>
	</div>
</div>


<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>