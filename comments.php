<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

	<h2 class="comments-title">
		<?php
			printf( '本文共 %1$s 个回复',
				number_format_i18n( get_comments_number() ));
		?>
	</h2>
	<div id="commentshow">
		<ul class="commentlist list-unstyled">
			<?php wp_list_comments( 'type=comment&callback=specs_comment&avatar_size=50&max_depth=10000' ); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<p class="commentnav text-center" data-post-id="<?php echo $post->ID?>">
				<?php paginate_comments_links('prev_text=«&next_text=»');?>
			</p>
		<?php endif; // Check for comment navigation. ?>
	</div>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php echo 'Comments are closed.'; ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>
	<?php include(TEMPLATEPATH . '/smiley.php');?>
	<?php
		$args = array(
			'title_reply'       => '发表评论',
			'title_reply_to'    => '回复 %s',
			'cancel_reply_link' => '取消',
			'label_submit'      => '发表评论',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' =>
					'<div class="comment-form-author form-group has-feedback">'.
					'<div class="input-group">'.
					'<div class="input-group-addon"><i class="fa fa-user"></i></div>'.
					'<input class="form-control" placeholder="昵称" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req .
					( $req ? ' required /><span class="form-control-feedback required">*</span>' : ' />' ) .
					'</span></div></div>',
				'email' =>
					'<div class="comment-form-email form-group has-feedback">'.
					'<div class="input-group">'.
					'<div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>'.
					'<input class="form-control" placeholder="邮箱" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req .
					( $req ? ' required /><span class="form-control-feedback required">*</span>' : ' />' ) .
					'</span></div></div>',

				'url' =>
					'<div class="comment-form-url form-group has-feedback">'.
					'<div class="input-group">'.
					'<div class="input-group-addon"><i class="fa fa-link"></i></div>'.
					'<input class="form-control" placeholder="网址" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" />' .
					'</div></div>'
				)
			  ),
			'comment_field' =>  '<div class="comment-form-comment">'.
				'<textarea class="form-control" id="comment" placeholder="评论写的diao一点，人生才会完美~" name="comment" rows="5" aria-required="true" required  onkeydown="if(event.ctrlKey){if(event.keyCode==13){document.getElementById(\'submit\').click();return false}};">' .
				'</textarea><p>'.$smilies.'</p></div>',
			'comment_notes_before' => '',
			'comment_notes_after' => ''
		  );
		comment_form($args);
	?>
	<?php if ( comments_open() ) : ?>
	<?php endif; ?>
</div><!-- #comments -->
