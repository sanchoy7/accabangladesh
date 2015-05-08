				<?php foreach ($course as $courses): ?>
				<h2 class="title"><a href="#"><?php echo $courses->course_name; ?></a></h2>
				<div class="entry">
					<p><?php echo $courses->details; ?></a> </p>
				</div>
				<?php endforeach; ?>
