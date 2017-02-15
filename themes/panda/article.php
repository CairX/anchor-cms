<?php theme_include('header'); ?>
		<section class="article-content wrap" id="article-<?php echo article_id(); ?>">


			<h1><?php echo article_title(); ?></h1>
			<section>
				<p>
					<?php echo article_date() ?> //
					<a href="<?php echo article_category_url(); ?>"><?php echo article_category() ?></a>
				</p>
			</section>
			<article>
				<?php echo article_html(); ?>
			</article>
		</section>

		<?php if (comments_open()): ?>
		<section class="comments">
			<?php if (has_comments()): ?>
			<div class="wrap">
				<h2>Comments</h2>
			</div>
			<ul class="commentlist">
				<?php $i = 0; while (comments()): $i++; ?>
				<li class="comment" id="comment-<?php echo comment_id(); ?>">
					<div class="wrap">
						<h3><?php echo comment_name(); ?></h3>
						<time><?php echo relative_time(comment_time()); ?></time>

						<div class="content">
							<?php echo htmlspecialchars(comment_text()); ?>
						</div>
					</div>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>

			<div class="wrap">
				<h3>New Comment</h3>
			</div>
			<form id="comment" class="commentform wrap" method="post" action="<?php echo comment_form_url(); ?>#comment">
				<?php echo comment_form_notifications(); ?>
				<p class="name">
					<label for="name">Your name:</label>
					<?php echo comment_form_input_name('placeholder="Your name"'); ?>
				</p>

				<p class="email">
					<label for="email">Your email address:</label>
					<?php echo comment_form_input_email('placeholder="Your email (won’t be published)"'); ?>
				</p>

				<p class="textarea">
					<label for="text">Your comment:</label>
					<?php echo comment_form_input_text('placeholder="Your comment"'); ?>
				</p>

				<p class="submit">
					<?php echo comment_form_button(); ?>
				</p>
			</form>

		</section>
		<?php endif; ?>

<?php theme_include('footer'); ?>
