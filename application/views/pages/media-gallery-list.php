				<h2 class="title"><?php echo $head; ?></h2><br />
				<?php
				if($mediatype != 'Gallery'){
					if($medialists):
						echo "<table width='100%' border='1'>";
						echo "<tr style='font-weight: bold;'><td>Media Title</td><td>Media Type</td><td>Media Category</td><td align='center'>Download Media</td></tr>";
						foreach ($medialists as $medialist):
							echo "<tr><td>".$medialist->media_title."</td><td>".$medialist->media_type."</td><td>".$medialist->media_cat."</td><td align='center'><a href='".url::base(TRUE).'public/uploads/'.strtolower(str_replace(' Gallery', '', $medialist->media_type)).'/'.$medialist->media_file."'>Download</a></td></tr>";
						endforeach;
						echo "</table>";
					endif;
				}else{
				?>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#photos').galleryView({
							panel_width: 750,
							panel_height: 300,
							frame_width: 100,
							frame_height: 90
						});
					});
				</script>
				<div id="photos" class="galleryview">
				  <?php
				  if($medialists):
				  	$thumbnails = "";
					foreach($medialists as $medialist): ?>  
					  <div class="panel">
						<img src="<?php echo "public/uploads/picture/".$medialist->media_file; ?>" title="<?php echo $medialist->media_title; ?>" alt="<?php echo $medialist->media_title; ?>" /> 
						<div class="panel-overlay">
						  <?php $thumbnails .= "<li><img src='public/uploads/thumbnails/".$medialist->media_file."' alt='".$medialist->media_title."' title='".$medialist->media_title."' /></li>"; ?>
						  <h2><?php echo $medialist->media_title; ?></h2>
						  <p><?php echo $medialist->media_details; ?></p>
						</div>
					  </div>
				    <?php endforeach; ?>
				  <?php endif; ?>
				  
				  <ul class="filmstrip">
				  	 <?php echo $thumbnails; ?>
				  </ul>
				  
				  <div id="pointer">
					  <img src="public/images/pointer.png" />
				  </div>
				  <div>
				      <img src="public/images/next.png" class="nav-next" />
					  <img src="public/images/prev.png" class="nav-prev" />
				  </div>
				</div>
				<?php }	?>
