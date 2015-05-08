				<?php
				if($links):
					foreach ($links as $link): ?>
					   <ul>					   
						  <li>
						   <h2 class="title"><a href="<?php echo $link->link_url; ?>"><?php echo $link->link_title; ?></a></h2>
						  </li>
					    </ul>
					<?php
					endforeach;
				endif;
				?>
