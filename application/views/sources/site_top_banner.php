		<h1><a href="<?php echo url::base(TRUE); ?>"><img src="<?php echo url::base(TRUE); ?>public/images/logo.gif" border="0" title="<?php echo Kohana::config('core.site_name'); ?>" alt="<?php echo Kohana::config('core.site_name'); ?>" /></a></h1>
		<!--<p><em><?php //echo Kohana::config('core.site_slogan'); ?></em></p>-->
		
		<div id="reg" style="width: 270px; height: 90px; float: right; margin: -118px 25px 0 0;">
			<h2>Member &amp; Visitors Zone</h2>
			<ul style="list-style: square;">
				<?php if(!Auth::instance()->logged_in('admin') AND !Auth::instance()->logged_in('login')){ ?>
					<li><a href="<?php echo url::base(TRUE); ?>auth/signup/">Register With ACCA Bangladesh</a></li>
					<li><a href="<?php echo url::base(TRUE); ?>auth/forgot_password/">Forgot Username Or Password?</a></li>
					<li><a href="<?php echo url::base(TRUE); ?>auth/login/">Member Signin Here</a></li>
				<?php }elseif(Auth::instance()->logged_in('admin') OR Auth::instance()->logged_in('login')){ ?>
					<li><a href="<?php echo url::base(TRUE); ?>admin/dashboard/">Manage Your Account</a></li>
					<li><a href="<?php echo url::base(TRUE); ?>admin/auth/logout/">Signout Your Account</a></li>
				<?php } ?>
			</ul>
		</div>