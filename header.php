<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beton
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- 	<meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
		rel="stylesheet">

	<meta name="google-site-verification" content="WYLMZJRSlm_3dAd0-ngtlSBjgkpEwLhTKZ2-WgFJyng" />
	<!-- Google Tag Manager -->
	<script>(function (w, d, s, l, i) {
			w[l] = w[l] || []; w[l].push({
				'gtm.start':
					new Date().getTime(), event: 'gtm.js'
			}); var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
					'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-MLVZ7T9');</script>
	<!-- End Google Tag Manager -->

	<meta property="og:image"
		content="https://www.betonstorten.nl/wp-content/uploads/2025/03/betonstorten-logo-optimized-new.png">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="200">
	<meta property="og:image:height" content="200">
	

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MLVZ7T9" height="0" width="0"
			style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'beton'); ?></a>

		<header id="masthead" class="site-header bg-white">
			<div class="top-header container-fluid px-sm-0 px-4" style="background-color: #060C35;">
				<div class="container py-2 px-0 d-none d-lg-flex justify-content-between align-items-center">
					<div class="d-flex align-items-center gap-2">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M9.99996 17.4502C9.8376 17.4502 9.67524 17.4222 9.51288 17.3663C9.35038 17.3101 9.20343 17.2233 9.07204 17.1058C8.32427 16.4167 7.62448 15.7069 6.97267 14.9767C6.321 14.2465 5.75454 13.5166 5.27329 12.7869C4.79191 12.0572 4.411 11.3339 4.13059 10.6171C3.85017 9.90014 3.70996 9.20778 3.70996 8.54C3.70996 6.61694 4.33197 5.06007 5.576 3.86937C6.82017 2.67868 8.29482 2.08333 9.99996 2.08333C11.7051 2.08333 13.1798 2.67868 14.4239 3.86937C15.6679 5.06007 16.29 6.61694 16.29 8.54C16.29 9.20778 16.1498 9.89875 15.8693 10.6129C15.5889 11.3272 15.2094 12.0506 14.7308 12.7829C14.252 13.5153 13.6868 14.2452 13.0352 14.9727C12.3835 15.7003 11.6837 16.4087 10.9358 17.0977C10.8063 17.2152 10.6592 17.3033 10.4943 17.3621C10.3296 17.4208 10.1648 17.4502 9.99996 17.4502ZM10.0014 9.88771C10.416 9.88771 10.7704 9.74007 11.0648 9.44479C11.3592 9.14951 11.5064 8.79458 11.5064 8.38C11.5064 7.96542 11.3588 7.6109 11.0635 7.31646C10.7682 7.02215 10.4132 6.875 9.9985 6.875C9.58392 6.875 9.22948 7.02264 8.93517 7.31792C8.64073 7.61319 8.4935 7.96819 8.4935 8.38292C8.4935 8.7975 8.64114 9.15195 8.93642 9.44625C9.2317 9.74056 9.5867 9.88771 10.0014 9.88771Z"
								fill="white" />
						</svg>
						<span class="text-white fw-medium" style="font-size: 14px; line-height: 21px;">BetonBestellen.nl Ondernemersweg 4, 4691 SL, THOLEN</span>
					</div>
					<div class="d-flex align-items-center gap-4">
						<a href="mailto:info@betonbestellen.nl"
							class="d-flex align-items-center gap-2 text-decoration-none">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M3.58983 16.25C3.16886 16.25 2.81254 16.1042 2.52087 15.8125C2.22921 15.5208 2.08337 15.1645 2.08337 14.7435V5.25646C2.08337 4.83549 2.22921 4.47917 2.52087 4.1875C2.81254 3.89583 3.16886 3.75 3.58983 3.75H16.4102C16.8312 3.75 17.1875 3.89583 17.4792 4.1875C17.7709 4.47917 17.9167 4.83549 17.9167 5.25646V14.7435C17.9167 15.1645 17.7709 15.5208 17.4792 15.8125C17.1875 16.1042 16.8312 16.25 16.4102 16.25H3.58983ZM10 10.3269C10.0695 10.3269 10.1384 10.3165 10.2067 10.2956C10.2752 10.2748 10.3414 10.2462 10.4055 10.21L16.3655 6.39417C16.4605 6.33542 16.5277 6.25931 16.5673 6.16583C16.6069 6.07236 16.6187 5.97382 16.6025 5.87021C16.5918 5.67785 16.4978 5.53493 16.3205 5.44146C16.1432 5.34799 15.9643 5.35625 15.7838 5.46625L10 9.16667L4.21629 5.46625C4.03574 5.35625 3.85817 5.34743 3.68358 5.43979C3.50886 5.53229 3.41351 5.67306 3.39754 5.86208C3.38143 5.97431 3.39317 6.07847 3.43275 6.17458C3.47233 6.27083 3.53962 6.34403 3.63462 6.39417L9.59462 10.21C9.65865 10.2462 9.7249 10.2748 9.79337 10.2956C9.86171 10.3165 9.9306 10.3269 10 10.3269Z"
									fill="white" />
							</svg>
							<span class="text-white fw-medium"
								style="font-size: 14px; line-height: 21px;">info@betonbestellen.nl</span>
						</a>
						<div style="width: 1px; height: 18px; background-color: rgba(255,255,255,0.2);"></div>
						<a href="tel:0854831710" class="d-flex align-items-center gap-2 text-decoration-none">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M16.2002 17.0833C14.6298 17.0833 13.052 16.7182 11.467 15.9879C9.88218 15.2576 8.42468 14.2275 7.09454 12.8975C5.76982 11.5674 4.74232 10.1111 4.01204 8.52875C3.28176 6.94653 2.91663 5.37021 2.91663 3.79979C2.91663 3.54979 2.99996 3.34007 3.16663 3.17062C3.33329 3.00132 3.54163 2.91667 3.79163 2.91667H6.50954C6.71996 2.91667 6.90558 2.98535 7.06642 3.12271C7.22725 3.25993 7.32954 3.42951 7.37329 3.63146L7.851 6.08333C7.88406 6.31083 7.87711 6.50632 7.83017 6.66979C7.78308 6.83326 7.69864 6.97055 7.57683 7.08167L5.65225 8.95521C5.96197 9.52243 6.31586 10.059 6.71392 10.565C7.11183 11.0708 7.54267 11.554 8.00642 12.0144C8.46364 12.4717 8.94975 12.8965 9.46475 13.2885C9.97975 13.6806 10.5359 14.0455 11.1331 14.3831L13.0031 12.4969C13.1335 12.3612 13.2914 12.266 13.4768 12.2115C13.6621 12.157 13.8547 12.1437 14.0545 12.1715L16.3685 12.6427C16.5789 12.6983 16.7507 12.8056 16.8837 12.9648C17.0168 13.124 17.0833 13.3045 17.0833 13.5065V16.2083C17.0833 16.4583 16.9986 16.6667 16.8293 16.8333C16.6599 17 16.4502 17.0833 16.2002 17.0833Z"
									fill="white" />
							</svg>
							<span class="text-white fw-medium"
								style="font-size: 14px; line-height: 21px;">085-4831710</span>
						</a>
					</div>
				</div>
				<div class="container py-2 px-0 d-md-none d-block">
					<div class="row align-items-center">
						<div class="col">
							<div class="row gx-4 row-cols-auto">
								<div class="col-5">
									<a href="tel:0854831710"
										class="d-flex align-items-center gap-2 text-decoration-none">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M16.2002 17.0833C14.6298 17.0833 13.052 16.7182 11.467 15.9879C9.88218 15.2576 8.42468 14.2275 7.09454 12.8975C5.76982 11.5674 4.74232 10.1111 4.01204 8.52875C3.28176 6.94653 2.91663 5.37021 2.91663 3.79979C2.91663 3.54979 2.99996 3.34007 3.16663 3.17062C3.33329 3.00132 3.54163 2.91667 3.79163 2.91667H6.50954C6.71996 2.91667 6.90558 2.98535 7.06642 3.12271C7.22725 3.25993 7.32954 3.42951 7.37329 3.63146L7.851 6.08333C7.88406 6.31083 7.87711 6.50632 7.83017 6.66979C7.78308 6.83326 7.69864 6.97055 7.57683 7.08167L5.65225 8.95521C5.96197 9.52243 6.31586 10.059 6.71392 10.565C7.11183 11.0708 7.54267 11.554 8.00642 12.0144C8.46364 12.4717 8.94975 12.8965 9.46475 13.2885C9.97975 13.6806 10.5359 14.0455 11.1331 14.3831L13.0031 12.4969C13.1335 12.3612 13.2914 12.266 13.4768 12.2115C13.6621 12.157 13.8547 12.1437 14.0545 12.1715L16.3685 12.6427C16.5789 12.6983 16.7507 12.8056 16.8837 12.9648C17.0168 13.124 17.0833 13.3045 17.0833 13.5065V16.2083C17.0833 16.4583 16.9986 16.6667 16.8293 16.8333C16.6599 17 16.4502 17.0833 16.2002 17.0833Z"
												fill="white" />
										</svg>
										<span class="text-white fw-medium"
											style="font-size: 14px; line-height: 21px;">085-4831710</span>
									</a>
								</div>
								<div class="col-7 d-flex justify-content-end">
									<a href="mailto:info@betonbestellen.nl"
										class="d-flex align-items-center gap-2 text-decoration-none">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M3.58983 16.25C3.16886 16.25 2.81254 16.1042 2.52087 15.8125C2.22921 15.5208 2.08337 15.1645 2.08337 14.7435V5.25646C2.08337 4.83549 2.22921 4.47917 2.52087 4.1875C2.81254 3.89583 3.16886 3.75 3.58983 3.75H16.4102C16.8312 3.75 17.1875 3.89583 17.4792 4.1875C17.7709 4.47917 17.9167 4.83549 17.9167 5.25646V14.7435C17.9167 15.1645 17.7709 15.5208 17.4792 15.8125C17.1875 16.1042 16.8312 16.25 16.4102 16.25H3.58983ZM10 10.3269C10.0695 10.3269 10.1384 10.3165 10.2067 10.2956C10.2752 10.2748 10.3414 10.2462 10.4055 10.21L16.3655 6.39417C16.4605 6.33542 16.5277 6.25931 16.5673 6.16583C16.6069 6.07236 16.6187 5.97382 16.6025 5.87021C16.5918 5.67785 16.4978 5.53493 16.3205 5.44146C16.1432 5.34799 15.9643 5.35625 15.7838 5.46625L10 9.16667L4.21629 5.46625C4.03574 5.35625 3.85817 5.34743 3.68358 5.43979C3.50886 5.53229 3.41351 5.67306 3.39754 5.86208C3.38143 5.97431 3.39317 6.07847 3.43275 6.17458C3.47233 6.27083 3.53962 6.34403 3.63462 6.39417L9.59462 10.21C9.65865 10.2462 9.7249 10.2748 9.79337 10.2956C9.86171 10.3165 9.9306 10.3269 10 10.3269Z"
												fill="white" />
										</svg>
										<span class="text-white fw-medium"
											style="font-size: 14px; line-height: 21px;">info@betonbestellen.nl</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container py-3 px-0">
				<div class="row align-items-center mx-sm-0 mx-4">
					<!-- Site Branding -->
					<div class="site-branding col-lg-4 col-8 px-0">
						<?php
						the_custom_logo();
						$beton_description = get_bloginfo('description', 'display');
						if ($beton_description || is_customize_preview()): ?>
							<p class="site-description"><?php echo esc_html($beton_description); ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<!-- Navigation -->
					<nav id="site-navigation"
						class="main-navigation navbar navbar-expand-lg col-lg-8 col-4 justify-content-end"
						style="padding-left: 10px;">
						<div class="d-lg-none">
							<!-- Offcanvas Toggle Button for Mobile/Tablet -->
							<button class="navbar-toggler bg-orange" type="button" data-bs-toggle="offcanvas"
								data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu"
								aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"
									style="filter: invert(1) sepia(1) saturate(5) hue-rotate(180deg);"></span>
							</button>
						</div>

						<!-- Inline Menu for Desktop -->
						<div class="beton-desktop-menu collapse navbar-collapse d-none d-lg-flex">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'menu-1',
								'menu_id' => 'primary-menu',
								'container' => false,
								'menu_class' => '',
								'fallback_cb' => '__return_false',
								'items_wrap' => '<ul id="%1$s" class="beton-navbar-desktop navbar-nav mb-2 mb-md-0 flex-wrap gap-4 align-items-center %2$s">%3$s</ul>',
								'depth' => 2,
								'walker' => new bootstrap_5_wp_nav_menu_walker()
							));
							?>
						</div>

						<div class="d-none d-lg-block ms-lg-4">
							<a href="<?php echo site_url(); ?>/contact" class="figma-contact-btn"
								style="width: 100%; height: 100%; padding-left: 20px; padding-right: 20px; padding-top: 9px; padding-bottom: 9px; border-radius: 10px; outline: 1px #1ACB23 solid; outline-offset: -0.50px; justify-content: center; align-items: center; gap: 6px; display: inline-flex; text-decoration: none; transition: background-color 0.3s;">
								<div class="figma-contact-text"
									style="text-align: center; justify-content: center; display: flex; flex-direction: column; color: #1ACB23; font-size: 16px; font-family: Manrope; font-weight: 700; line-height: 22.40px; word-wrap: break-word; transition: color 0.3s;">
									Contact</div>
							</a>
						</div>

						<!-- Offcanvas Menu for Mobile/Tablet -->
						<div class="beton-mobile-drawer offcanvas offcanvas-start d-lg-none" tabindex="-1"
							id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
							<div class="offcanvas-header px-4 border-b-custom-gray-5">

								<div id="offcanvasMenuLabel" class="offcanvas-title">
									<!-- Site Branding -->
									<div class="site-branding col-lg-4 col-8 px-0">
										<?php
										the_custom_logo();
										$beton_description = get_bloginfo('description', 'display');
										if ($beton_description || is_customize_preview()): ?>
											<p class="site-description"><?php echo esc_html($beton_description); ?></p>
										<?php endif; ?>
									</div><!-- .site-branding -->
								</div>
								<button type="button" class="btn-close" data-bs-dismiss="offcanvas"
									aria-label="Close"></button>
							</div>
							<div class="offcanvas-body px-4 d-flex flex-column">
								<?php
								wp_nav_menu(array(
									'theme_location' => 'menu-2',
									'menu_id' => 'Mobile',
									'container' => false,
									'menu_class' => '',
									'fallback_cb' => '__return_false',
									'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-4 mb-md-0 w-full %2$s">%3$s</ul>',
									'depth' => 2,
									'walker' => new bootstrap_5_wp_nav_menu_walker()
								));
								?>
								<div class="mt-auto pb-4">
									<a href="<?php echo site_url(); ?>/contact" class="figma-contact-btn"
										style="width: 100%; height: 100%; padding-left: 20px; padding-right: 20px; padding-top: 9px; padding-bottom: 9px; border-radius: 10px; outline: 1px #1ACB23 solid; outline-offset: -0.50px; justify-content: center; align-items: center; gap: 6px; display: inline-flex; text-decoration: none; transition: background-color 0.3s;">
										<div class="figma-contact-text"
											style="text-align: center; justify-content: center; display: flex; flex-direction: column; color: #1ACB23; font-size: 16px; font-family: Manrope; font-weight: 700; line-height: 22.40px; word-wrap: break-word; transition: color 0.3s;">
											Contact</div>
									</a>
								</div>
							</div>
						</div>
					</nav><!-- #site-navigation -->
				</div>
			</div>

		</header><!-- #masthead -->