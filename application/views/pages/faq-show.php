			  <?php if(count($faqcourse) != ""): ?>
			  <div class="post">
				<h2 class="title">Course Related FAQ</h2>
				<?php foreach ($faqcourse as $faqcourses): ?>								 
				<h2 class="title"><a href="#"><?php echo $faqcourses->faq_title; ?></a></h2>
				<div class="entry"><p><?php echo $faqcourses->faq_details; ?></a></p></div>
				<?php endforeach; ?>
			  </div>
			  <?php endif; ?>

			  <?php if(count($faqexam) != ""): ?>
			  <div class="post">
				<h2 class="title">Exam Related FAQ</h2>
				<?php foreach ($faqexam as $faqexams): ?>								 
				<h2 class="title"><a href="#"><?php echo $faqexams->faq_title; ?></a></h2>
				<div class="entry"><p><?php echo $faqexams->faq_details; ?></a></p></div>
				<?php endforeach; ?>
			  </div>
			  <?php endif; ?>
			  
			  <?php if(count($faqcost) != ""): ?>
			  <div class="post">
				<h2 class="title">Cost Related FAQ</h2>
				<?php foreach ($faqcost as $faqcosts): ?>								 
				<h2 class="title"><a href="#"><?php echo $faqcosts->faq_title; ?></a></h2>
				<div class="entry"><p><?php echo $faqcosts->faq_details; ?></a></p></div>
				<?php endforeach; ?>
			  </div>
			  <?php endif; ?>
