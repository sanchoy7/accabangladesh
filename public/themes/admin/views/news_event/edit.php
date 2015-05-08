<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open_multipart(); ?>
<?php echo $__form_object; ?>
<?php 
      echo $csrf;
      $attributes = array('name' => 'ne_photo', 'style' => 'width:640px;');	  
 ?>

<div class="box">
	<h3><?php echo __('Edit Content'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($ne_title->name, $ne_title->label); ?><span class="required">*</span>
			<?php echo empty($ne_title->error) ? form::input($ne_title->name, $ne_title->value) : form::input($ne_title->name, $ne_title->value); ?>
			<?php if(!empty($ne_title->error)): ?><br /><span class="error"><?php echo $ne_title->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($ne_type->name, $ne_type->label); ?><span class="required">*</span>
			<?php echo empty($ne_type->error) ? form::dropdown($ne_type->name, $ne_type->values, $ne_type->value, "style='width:90%;'") : form::dropdown($ne_type->name, $ne_type->values, $ne_type->value, "style='width:90%;'"); ?>
			<?php if(!empty($ne_type->error)): ?><br /><span class="error"><?php echo $ne_type->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($status->name, $status->label); ?><span class="required">*</span>
			<?php echo empty($status->error) ? form::dropdown($status->name, $status->values, $status->value, "style='width:90%;'") : form::dropdown($status->name, $status->values, $status->value, "style='width:90%;'"); ?>
			<?php if(!empty($status->error)): ?><br /><span class="error"><?php echo $status->error; ?></span><?php endif; ?>
		</p>
        <p style="width: 50%; float:left;">
			<?php echo form::label($ne_photo->name, $ne_photo->label); ?><span class="required">*</span><br /><br />
			<?php echo empty($ne_photo->error) ? form::upload($attributes, $ne_photo->value) : form::upload($attributes, $ne_photo->value); ?>
			<?php if(!empty($ne_photo->error)): ?><br /><span class="error"><?php echo $ne_photo->error; ?></span><?php endif; ?>
		</p>
		<p style="width: 40%; float:left;"><img src="<?php echo url::base(TRUE).'public/photos/news_event/'.$ne_photo->value; ?>" height="100" width="100" /></p>
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
			<?php echo form::label($ne_details->name, $ne_details->label); ?><span class="required">*</span><br /><br />
			<?php echo empty($ne_details->error) ? form::textarea($ne_details->name, $ne_details->value, "style='width:109%;'") : form::textarea($ne_details->name, $ne_details->value, "style='width:109%;'"); ?>
			<?php if(!empty($ne_details->error)): ?><span class="error"><?php echo $ne_details->error; ?></span><?php endif; ?>
		</p>
	</div>
</div>


<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>