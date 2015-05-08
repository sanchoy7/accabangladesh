				<h2 class="title">Media Gallery Type</h2>
				<p>&nbsp;</p>
				<div class="entry">
					<p style="width: 15%; font-weight:bold; float: left;">
						<img src="<?php echo url::base(TRUE); ?>public/images/picture.jpg" alt="Picture Gallery" title="Picture Gallery" />
					</p>
					<?php 
					if($pictures):
						echo "<ul>";
							foreach($pictures as $picture):
								?>
									<li><a href="<?php echo url::base(TRUE).'home/media_type/'.$picture->media_cat; ?>"><?php echo $picture->media_cat; ?></a></li>
								<?php
							endforeach;
						echo "</ul>";
					endif;
					?>
					
					<p style="width: 15%; font-weight:bold; float: left;">
						<img src="<?php echo url::base(TRUE); ?>public/images/audio.jpg" alt="Audio Gallery" title="Audio Gallery" />
					</p>
					<?php 
					if($audios):
						echo "<ul>";
							foreach($audios as $audio):
								?>
									<li><a href="<?php echo url::base(TRUE).'home/media_type/'.$audio->media_cat; ?>"><?php echo $audio->media_cat; ?></a></li>
								<?php
							endforeach;
						echo "</ul>";
					endif;
					?>
					
					<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
					
					<p style="width: 15%; font-weight:bold; float: left;">
						<img src="<?php echo url::base(TRUE); ?>public/images/video.jpg" alt="Video Gallery" title="Video Gallery" />
					</p>
					<?php 
					if($pictures):
						echo "<ul>";
							foreach($videos as $video):
								?>
									<li><a href="<?php echo url::base(TRUE).'home/media_type/'.$video->media_cat; ?>"><?php echo $video->media_cat; ?></a></li>
								<?php
							endforeach;
						echo "</ul>";
					endif;
					?>
					
					<p style="width: 15%; font-weight:bold; float: left;">
						<img src="<?php echo url::base(TRUE); ?>public/images/document.jpg" alt="Document Gallery" title="Document Gallery" />
					</p>
					<?php 
					if($audios):
						echo "<ul>";
							foreach($documents as $document):
								?>
									<li><a href="<?php echo url::base(TRUE).'home/media_type/'.$document->media_cat; ?>"><?php echo $document->media_cat; ?></a></li>
								<?php
							endforeach;
						echo "</ul>";
					endif;
					?>
				</div>