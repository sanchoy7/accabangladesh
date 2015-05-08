					<h2>News &amp; Events</h2>
					<?php 
						foreach ($nevents as $nevent): ?>
						<ul>
							<li>
							  <a href="<?php echo 'home/news_event/'.$nevent->id; ?>" title="<?php echo $nevent->ne_title; ?>"><?php echo text::limit_chars($nevent->ne_title, 18); ?></a>
							  <?php echo html::nbs(3).html::anchor("home/news_event/".$nevent->id, 'Read'); ?>
							</li>
						</ul>
						
						<?php endforeach; 
						echo "<p style='text-align:right'>".html::anchor('home/news_event_list/', 'Read More')."</p>";
					 ?>
