<aside class='col-md-4'>
	<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : // If the user hasn't defined any specific widgets in the admin yet, display a couple dummy widgets, as written below ?>
	<aside id="archives" class="widget panel panel-specs visible-lg visible-md">
		<div class="panel-heading">
			<h2>文章归档</h2>
		</div>
		<ul>
			<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
		</ul>
	</aside>

	<aside id="meta" class="widget panel panel-specs visible-lg visible-md">
		<div class="panel-heading">
			<h2>Meta</h2>
		</div>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</aside>

<?php endif; // end sidebar widget area ?>
</aside>