<!-- Navigation Container -->
<div class="container">
			<nav id="mainnav" class="navbar navbar-light  align-items-baseline justify-content-start flex-nowrap flex-sm-row">
				<!-- Mobile Nav button -->
				<!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button> -->
				<!-- /End Mobile Nav button -->

				<!-- Site Branding -->
				<div class="d-flex flex-row align-items-baseline">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><svg id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="75" viewBox="0 0 300 300"><defs><linearGradient id="a"><stop offset="0" stop-color="#ff6438"/><stop offset="1" stop-color="#ff1538"/></linearGradient><linearGradient id="b" x1="10.8" x2="292.5" y1="293.9" y2="293.9" xlink:href="#a" gradientUnits="userSpaceOnUse"/></defs><path fill="url(#b)" d="M67 430c-19-33-37.8-66.3-56.2-99.8 26 3.3 52 8.2 78.3 11 12.7-62 23-124.2 35-186.2 22.5 55.6 42 112.2 64.6 168 27-16.3 53.4-33.7 80.5-49.8-7.7 25.3-16.7 50.2-24.5 75.5 16.2-4 32-9.4 48.3-13.4-18 32.8-36.8 65-55.2 97.5h-25.8c10.8-19 21.8-39.3 31.8-57.8-11.5 3-23.3 6.5-35 9.7 6.2-19 13-37.8 18.6-57-17 9.4-33 20.8-50 29.8-15.5-40-30.4-80.5-45.6-120.7-8 44-15.8 87.8-24.3 131.6-17.6-1.8-35-5-52.3-7 12.7 24 26.6 47.5 39.8 71.3-8.7.2-17.4 0-26 0L67 430z" transform="translate(0 -138.25)"/></svg></a>
					<h1 class="h6"><a id="site-name" class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name'); ?></a></h1>
				</div>
					<!-- /End Site Branding -->

                    <!-- Navigation links -->
                    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					<ul class="nav navbar-nav flex-sm-row">
						<li class="nav-item">
							<a class="nav-link pr-3 {% if page.url=="/" %}active{% endif %}" href="/">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link pr-3 {% unless page.url=="/" %}active{% endunless %}" href="/sitemap.html">Archive</a>
						</li>
					</ul>
					<!-- /End Navigation links -->
			</nav>
		</div>
