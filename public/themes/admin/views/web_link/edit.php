<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php echo form::open_multipart(); ?>
<?php echo $__form_object; ?>
<?php echo $csrf; ?>
<script type="text/javascript">
$(function(){
	if($("#link_cat").val() == "Ads Related Web Link"){
		$("#picdiv").show("slow");
	}
	$("#link_cat").change(function(){
		if($("#link_cat").val() == "Ads Related Web Link"){
			$("#picdiv").show("slow");
		}else{
			$("#picdiv").hide("slow");
		}

	});
});
</script>
<div class="box">
	<h3><?php echo __('Edit Content'); ?></h3>
	<div class="inside">
		<p>
			<?php echo form::label($link_title->name, $link_title->label); ?><span class="required">*</span>
			<?php echo empty($link_title->error) ? form::input($link_title->name, $link_title->value) : form::input($link_title->name, $link_title->value); ?>
			<?php if(!empty($link_title->error)): ?><br /><span class="error"><?php echo $link_title->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($link_url->name, $link_url->label); ?><span class="required">*</span>
			<?php echo empty($link_url->error) ? form::input($link_url->name, $link_url->value) : form::input($link_url->name, $link_url->value); ?>
			<?php if(!empty($link_url->error)): ?><br /><span class="error"><?php echo $link_url->error; ?></span><?php endif; ?>
		</p>
		<p>
			<?php echo form::label($link_cat->name, $link_cat->label); ?><span class="required">*</span>
			<?php echo empty($link_cat->error) ? form::dropdown($link_cat->name, $link_cat->values, $link_cat->value, "style='width:90%;'") : form::dropdown($link_cat->name, $link_cat->values, $link_cat->value, "style='width:90%;'"); ?>
			<?php if(!empty($link_cat->error)): ?><br /><span class="error"><?php echo $link_cat->error; ?></span><?php endif; ?>
		</p>
		<div id="picdiv" style="display: none; width: 100%; height: 100px;">
			<p style="width: 50%; float:left;">
				<?php echo form::label($picture->name, $picture->label); ?><span class="required">*</span><br /><br />
				<?php echo empty($picture->error) ? form::upload($picture->name, $picture->value) : form::upload($picture->name, $picture->value); ?>
				<?php if(!empty($picture->error)): ?><br /><span class="error"><?php echo $picture->error; ?></span><?php endif; ?>
			</p>
			<p style="width: 40%; float:left;">
				<?php if($picture->value){ ?>
					<img src="<?php echo url::base(TRUE).'public/photos/web_ads/'.$picture->value; ?>" height="100" width="100" />
				<?php } ?>
			</p>
		</div>
		<p>
			<?php echo form::label($status->name, $status->label); ?><span class="required">*</span>
			<?php echo empty($status->error) ? form::dropdown($status->name, $status->values, $status->value, "style='width:90%;'") : form::dropdown($status->name, $status->values, $status->value, "style='width:90%;'"); ?>
			<?php if(!empty($status->error)): ?><br /><span class="error"><?php echo $status->error; ?></span><?php endif; ?>
		</p>
	</div>
</div>


<p><?php echo form::submit($submit->name, $submit->label); ?></p>

<?php echo form::close(); ?>