<form role="search" method="get" class="form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group mb-3">
		<input type="search" class="form-control" placeholder="<?php esc_attr_e( 'Search…', 'mrkapowski' ); ?>" aria-label="Search" aria-describedby="button-addon2" name="s">
		<div class="input-group-append">
			<button class="btn btn-outline-secondary" type="submit" id="button-addon2"><?php esc_html_e( 'Search', 'mrkapowski' ); ?></button>
		</div>
	</div>
</form>
