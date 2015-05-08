			<ul>
				<li <?php if($active_tab == 'home'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'home/index'; ?>" class="first">Home</a></li>
				<li <?php if($active_tab == 'about'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base(TRUE).'accabangladesh/home/about_us'; ?>">About Us</a></li>
				<li <?php if($active_tab == 'media'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'home/media_type'; ?>">Media Gallery</a></li>
				<li <?php if($active_tab == 'eligibility'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'home/eligibility'; ?>">Eligibility Check</a></li>
				<li <?php if($active_tab == 'package'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'home/course_package'; ?>">Course Package</a></li>
				<li <?php if($active_tab == 'syllabus'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'home/course_syllabus'; ?>">Syllabus</a></li>
				<li <?php if($active_tab == 'contact'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'home/contact_us'; ?>">Contact Us</a></li>
				<li <?php if($active_tab == 'location'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'our_location'; ?>">Our Location</a></li>
				<li <?php if($active_tab == 'faq'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'home/faq'; ?>">FAQs</a></li>
				<li <?php if($active_tab == 'blog'){echo "class='current_page_item'";} ?>><a href="<?php echo url::base().'home/blog'; ?>">Blog</a></li>
			</ul>