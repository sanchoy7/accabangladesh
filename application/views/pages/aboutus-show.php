				<?php
				if($aboutuses):
					foreach ($aboutuses as $aboutus):
					?>
						<h2 class="title"><a href="#"><?php echo $aboutus->about_title; ?></a></h2>
						<p class="meta">Post Date: <?php echo date('M d, Y', strtotime($aboutus->modified));?></p>
						<div class="entry">
							<p><?php echo $aboutus->about_details; ?></a> </p>
						</div>
					<?php
					endforeach;
				endif;
				?>
