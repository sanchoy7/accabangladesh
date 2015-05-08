				<?php
				if($newsevents):
					foreach ($newsevents as $newsevent): ?>
						
						<div class="entry">
							<br />
						   	<?php if(!empty($newsevent->ne_photo)){ ?>
							<img src="<?php echo url::base(TRUE).'public/photos/news_event/'.$newsevent->ne_photo; ?>" style="float: left; margin: 0 10px 0 0;" width="350" height="280" />
                            <?php } ?>
							<h2 class="title"><?php echo $newsevent->ne_title; ?></h2>
							<p style="float: left;"><?php echo $newsevent->ne_details; ?></p>
						</div>
					<?php
					endforeach;
				endif;
				?>
