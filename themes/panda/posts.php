<?php theme_include('header'); ?>

<section class="content">

	<?php if (has_posts()): ?>
		<ul class="items">
			<?php $i = 0; while (posts()): ?>
			<li class="items-item">
				<article class="wrap">

					<div><img src="<?php echo article_custom_field("postpreviewimage", "/anchor/content/post_preview_image.jpg"); ?>" /></div>

					<h2>
						<a href="<?php echo article_url(); ?>" title="<?php echo article_title(); ?>"><?php echo article_title(); ?></a>
					</h2>
					<p>
					<?php echo article_date() ?> //
					<a href="<?php echo article_category_url(); ?>"><?php echo article_category() ?></a>
				</p>
					<p><?php echo article_description(); ?></p>
				</article>
			</li>
			<?php endwhile; ?>
		</ul>

		<?php if (has_pagination()): ?>
		<nav class="pagination">
			<div class="wrap">
				<div class="previous">
					<?php echo posts_prev(); ?>
				</div>
				<div class="next">
					<?php echo posts_next(); ?>
				</div>
			</div>
		</nav>
		<?php endif; ?>

	<?php else: ?>
		<div class="wrap">
			<h1>No posts yet!</h1>
			<p>Looks like you have some writing to do!</p>
		</div>
	<?php endif; ?>

</section>

<?php theme_include('footer'); ?>
