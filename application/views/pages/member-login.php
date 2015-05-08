        <div id="message">
		<p>&nbsp;</p>
        <?php if(!empty($error)): ?>
        	<?php echo $error; ?>
        <?php endif; ?>
        </div>
		
		<div id="form">
			<?php echo form::open(); ?>
				<?php //echo $__form_object; ?>
				<p class="email">
					<?php echo form::label($username->name, $username->label); ?>
					<?php echo empty($username->error) ? form::input($username->name, $username->value) : form::input($username->name, $username->value, 'class="error"'); ?>
					<?php if(!empty($username->error)): ?><br /><span class="error"><?php echo $username->error ?></span><?php endif; ?>
				</p>
				<p class="password">
					<?php echo form::label($password->name, $password->label); ?>
					<?php echo empty($password->error) ? form::password($password->name) : form::password($password->name, '', 'class="error"'); ?>
					<?php if(!empty($password->error)): ?><br /><span class="error"><?php echo $password->error; ?></span><?php endif; ?>
				</p>
				<p class="submit">
					<?php echo form::submit($submit->name, $submit->label); ?>
				</p>
			<?php echo form::close(); ?>
		</div>
