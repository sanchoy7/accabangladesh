<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open_multipart(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>

<div class="box">
	<h3><?php echo __('Edit Media Information'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($media_title->name, $media_title->label); ?><span class="required">*</span>
			<?php echo empty($media_title->error) ? form::input($media_title->name, $media_title->value) : form::input($media_title->name, $media_title->value); ?>
			<?php if(!empty($media_title->error)): ?><br /><span class="error"><?php echo $media_title->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($media_type->name, $media_type->label); ?><span class="required">*</span>
			<?php echo empty($media_type->error) ? form::dropdown($media_type->name, $media_type->values, $media_type->value, "style='width:90%;'") : form::dropdown($media_type->name, $media_type->values, $media_type->value, "style='width:90%;'"); ?>
			<?php if(!empty($media_type->error)): ?><br /><span class="error"><?php echo $media_type->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($media_cat->name, $media_cat->label); ?><span class="required">*</span>
			<?php echo empty($media_cat->error) ? form::dropdown($media_cat->name, $media_cat->values, $media_cat->value, "style='width:90%;'") : form::dropdown($media_cat->name, $media_cat->values, $media_cat->value, "style='width:90%;'"); ?>
			<?php if(!empty($media_cat->error)): ?><br /><span class="error"><?php echo $media_cat->error; ?></span><?php endif; ?>
		</p>
		<p style="width: 50%; float:left;">
			<?php echo form::label($media_file->name, $media_file->label); ?><span class="required">*</span><br /><br />
			<?php echo empty($media_file->error) ? form::upload($media_file->name, $media_file->value) : form::upload($media_file->name, $media_file->value); ?>
			<?php if(!empty($media_file->error)): ?><br /><span class="error"><?php echo $media_file->error; ?></span><?php endif; ?>
		</p>
		<p style="width: 40%; float:left; font-weight:bold;">
			<?php if($media_type->value === 'Picture Gallery'){ ?>
				<img src="<?php echo url::base(TRUE).'public/uploads/'.strtolower(str_replace(' Gallery', '', $media_type->value)).'/'.$media_file->value; ?>" height="100" width="100" />
			<?php }else{ ?>
				<a href="<?php echo url::base(TRUE).'public/uploads/'.strtolower(str_replace(' Gallery', '', $media_type->value)).'/'.$media_file->value; ?>">
					<ul>
						<li><?php echo 'File Title : '.$media_title->value; ?></li>
						<li><?php echo 'File Type : '.$media_type->value; ?></li>
						<li><?php echo 'File Category : '.$media_cat->value; ?></li>
					</ul>
				</a>
			<?php } ?>
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
			<?php echo form::label($media_details->name, $media_details->label); ?><span class="required">*</span><br /><br />
			<?php echo empty($media_details->error) ? form::textarea($media_details->name, $media_details->value, "style='width:109%;'") : form::textarea($media_details->name, $media_details->value, "style='width:109%;'"); ?>
			<?php if(!empty($media_details->error)): ?><br /><span class="error"><?php echo $media_details->error; ?></span><?php endif; ?>
		</p>
	</div>
</div>

<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>