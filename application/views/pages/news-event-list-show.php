				<?php
			  
			  if($nelists):
				    foreach ($nelists as $nelist):
				    echo "<ul><li>".html::anchor('home/news_event/'.$nelist->id, $nelist->ne_title).html::nbs(5).html::anchor('home/news_event/'.$nelist->id, 'Details').
					"</li></ul>";
				    endforeach;
			  endif;
				?>
