<?php $facepiles = get_option( 'semantic_linkbacks_facepiles' );
if ( ! is_array( $facepiles ) ) {
	$facepiles = array_keys( Linkbacks_Handler::get_comment_type_strings() );
}

?>
<?php if ( in_array( 'reacji', $facepiles, true ) && Semantic_Linkbacks_Walker_Comment::$reactions ) : ?>
<section class="reactions">
	<h5><?php echo esc_html_e( 'Reacjis', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type' => 'reacji',
			),
			Semantic_Linkbacks_Walker_Comment::$reactions
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'like', $facepiles, true ) && has_linkbacks( 'like' ) ) : ?>
<section class="likes">
	<h5><?php echo esc_html_e( 'Likes', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'like',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'like' )
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'favorite', $facepiles, true ) && has_linkbacks( 'favorite' ) ) : ?>
<section class="favorites">
	<h5><?php echo esc_html_e( 'Favourites', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'favorite',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'favorite' )
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'bookmark', $facepiles, true ) && has_linkbacks( 'bookmark' ) ) : ?>
<section class="bookmarks">
	<h5><?php echo esc_html_e( 'Bookmarks', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'bookmark',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'bookmark' )
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'repost', $facepiles, true ) && has_linkbacks( 'repost' ) ) : ?>
<section class="reposts">
	<h5><?php echo esc_html_e( 'Reposts', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'repost',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'repost' )
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'tag', $facepiles, true ) && has_linkbacks( 'tag' ) ) : ?>
<section class="tags">
	<h5><?php echo esc_html_e( 'Tags', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'tag',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'tag' )
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'listen', $facepiles, true ) && has_linkbacks( 'listen' ) ) : ?>
<section class="listens">
	<h5><?php echo esc_html_e( 'Listening', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'listen',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'listen' )
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'read', $facepiles, true ) && has_linkbacks( 'read' ) ) : ?>
<section class="reads">
	<h5><?php echo esc_html_e( 'Reading', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'read',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'read' )
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'fullow', $facepiles, true ) && has_linkbacks( 'fullow' ) ) : ?>
<section class="fullows">
	<h5><?php echo esc_html_e( 'Fullowing', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'fullow',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'fullow' )
		);
	?>
</section>
<?php endif; ?>

<?php if ( in_array( 'watch', $facepiles, true ) && has_linkbacks( 'watch' ) ) : ?>
<section class="watches">
	<h5><?php echo esc_html_e( 'Watching', 'semantic-linkbacks' ); ?></h5>
	<?php
		list_linkbacks(
			array(
				'type'        => 'watch',
				'style'       => 'ul',
				'avatar_size' => 48,
			),
			get_linkbacks( 'watch' )
		);
	?>
</section>
<?php endif; ?>



<?php if ( in_array( 'rsvp', $facepiles, true ) && has_linkbacks( 'rsvp' ) ) : ?>
<section class="rsvps">
	<h5><?php esc_html_e( 'RSVPs', 'semantic-linkbacks' ); ?></h5>

	<?php if ( in_array( 'rsvp:yes', $facepiles, true ) && has_linkbacks( 'rsvp:yes' ) ) : ?>
	<h6><?php esc_html_e( 'Yes', 'semantic-linkbacks' ); ?></h6>
		<?php
			list_linkbacks(
				array(
					'type'        => 'rsvp-yes',
					'style'       => 'ul',
					'avatar_size' => 48,
				),
				get_linkbacks( 'rsvp:yes' )
			);
		?>
	<?php endif; ?>

	<?php if ( in_array( 'invited', $facepiles, true ) && has_linkbacks( 'invited' ) ) : ?>
	<h6><?php esc_html_e( 'Invited', 'semantic-linkbacks' ); ?></h6>
		<?php
			list_linkbacks(
				array(
					'type'        => 'invited',
					'style'       => 'ul',
					'avatar_size' => 48,
				),
				get_linkbacks( 'invited' )
			);
		?>
	<?php endif; ?>

	<?php if ( in_array( 'rsvp:maybe', $facepiles, true ) && has_linkbacks( 'rsvp:maybe' ) ) : ?>
	<h6><?php esc_html_e( 'Maybe', 'semantic-linkbacks' ); ?></h6>
		<?php
			list_linkbacks(
				array(
					'type'        => 'rsvp-maybe',
					'style'       => 'ul',
					'avatar_size' => 48,
				),
				get_linkbacks( 'rsvp:maybe' )
			);
		?>
	<?php endif; ?>

	<?php if ( in_array( 'rsvp:no', $facepiles, true ) && has_linkbacks( 'rsvp:no' ) ) : ?>
	<h6><?php esc_html_e( 'No', 'semantic-linkbacks' ); ?></h6>
		<?php
			list_linkbacks(
				array(
					'type'        => 'rsvp-no',
					'style'       => 'ul',
					'avatar_size' => 48,
				),
				get_linkbacks( 'rsvp:no' )
			);
		?>
	<?php endif; ?>

	<?php if ( in_array( 'rsvp:interested', $facepiles, true ) && has_linkbacks( 'rsvp:interested' ) ) : ?>
	<h4><?php esc_html_e( 'Interested', 'semantic-linkbacks' ); ?></h4>
		<?php
			list_linkbacks(
				array(
					'type'        => 'rsvp-interested',
					'style'       => 'ul',
					'avatar_size' => 48,
				),
				get_linkbacks( 'rsvp:interested' )
			);
		?>
	<?php endif; ?>
</section>
<?php endif; ?>

<?php if ( in_array( 'mention', $facepiles, true ) && has_linkbacks( 'mention' ) ) : ?>
<section class="mentions">
	<h5><?php echo esc_html_e( 'Mentions', 'semantic-linkbacks' ); ?></h5>
	<?php
	list_linkbacks(
		array(
			'type'        => 'mention',
			'style'       => 'ul',
			'avatar_size' => 48,
		),
		get_linkbacks( 'mention' )
	);
	?>
</section>
<?php endif; ?>
