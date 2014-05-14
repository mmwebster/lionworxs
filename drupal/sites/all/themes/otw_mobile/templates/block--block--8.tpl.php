<div id='settings_block'>
	<?php
		$uid = $user->uid;
	?>
	<ul>
		<li>
			<?php 
			echo "<a href='../user/" . $uid . "/edit'>";
			print $block->subject;
			echo "</a>"; 
			?>
		</li>
	</ul>

</div>