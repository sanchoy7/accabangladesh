				<?php
				if($courses):
					foreach ($courses as $course): ?>
						<h2 class="title"><a href="#"><?php echo $course->course_name; ?></a></h2>
						<div class="entry">
							<p><?php echo $course->details; ?></a> </p>
						</div>
					<?php
					endforeach;
				endif;
				?>
