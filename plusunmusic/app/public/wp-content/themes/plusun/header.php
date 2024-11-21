<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PlusUn_Music
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Move to function -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

	<script src="https://cdn.tailwindcss.com"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site antialiased">

		<header id="masthead" class="site-header fixed top-0 h-[66px] w-full <?php if (get_field('header_type') == 'noir'): ?> site-header--dark <?php endif; ?>">
			<div class="max-w-[1600px] mx-auto grid grid-cols-3 items-center p-4">
				<!-- menu -->
				<div class="">
					<button class="menu-trigger">
						<svg width="35" height="24" viewBox="0 0 35 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M2 1.99976L33 1.99976" stroke="#fffbe5" stroke-width="3" stroke-linecap="round" />
							<path d="M2 11.9998L33 11.9998" stroke="#fffbe5" stroke-width="3" stroke-linecap="round" />
							<path d="M33 21.9998L2 22.0002" stroke="#fffbe5" stroke-width="3" stroke-linecap="round" />
						</svg>
					</button>
				</div>
				<!-- logo -->
				<div class="flex justify-center">
					<a href="/">
						<svg width="50" height="34" viewBox="0 0 50 34" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_1681_440)">
								<path d="M39.9478 0.735218V22.4933C39.9478 22.8993 39.6167 23.2285 39.2082 23.2285H32.0726C31.6642 23.2285 31.333 22.8993 31.333 22.4933V13.1944C31.333 12.7884 31.0018 12.4592 30.5934 12.4592H21.8902C21.4818 12.4592 21.1506 12.13 21.1506 11.724V4.76026C21.1506 4.35425 21.4818 4.02505 21.8902 4.02505H30.5934C31.0018 4.02505 31.333 3.69584 31.333 3.28983V0.735218C31.333 0.329202 31.6642 0 32.0726 0H39.2082C39.6167 0 39.9478 0.329202 39.9478 0.735218Z" />
								<path d="M29.112 15.4001V22.4933C29.112 22.8993 28.7809 23.2285 28.3724 23.2285H19.6693C19.2608 23.2285 18.9297 23.5577 18.9297 23.9637V33.2626C18.9297 33.6686 18.5985 33.9978 18.19 33.9978H11.0544C10.646 33.9978 10.3148 33.6686 10.3148 33.2626V23.9637C10.3148 23.5577 9.98366 23.2285 9.57522 23.2285H0.739612C0.33117 23.2285 0 22.8993 0 22.4933V15.4001C0 14.994 0.33117 14.6648 0.739612 14.6648H9.57301C9.98145 14.6648 10.3126 14.3356 10.3126 13.9296V4.75805C10.3126 4.35203 10.6438 4.02283 11.0522 4.02283H18.1878C18.5963 4.02283 18.9275 4.35203 18.9275 4.75805V13.9274C18.9275 14.3334 19.2586 14.6626 19.6671 14.6626H28.3702C28.7786 14.6626 29.1098 14.9918 29.1098 15.3979L29.112 15.4001Z" />
								<path d="M49.2603 25.4363H21.888C21.4796 25.4363 21.1484 25.7655 21.1484 26.1716V33.267C21.1484 33.673 21.4796 34.0022 21.888 34.0022H49.2603C49.6688 34.0022 49.9999 33.673 49.9999 33.267V26.1716C49.9999 25.7655 49.6688 25.4363 49.2603 25.4363Z" />
							</g>
							<defs>
								<clipPath id="clip0_1681_440">
									<rect width="50" height="34" fill="#fffbe5" />
								</clipPath>
							</defs>
						</svg>
					</a>
				</div>
				<div class="flex justify-end">
					<a href="/contact" class="font-title text-medium text-[20px] uppercase">Contact</a>
				</div>
			</div>
		</header><!-- #masthead -->

		<nav id="site-navigation" class="main-navigation hidden">
			<div class="">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</div>
		</nav><!-- #site-navigation -->

		<!-- Naviation script -->
		<script>
			document.querySelector('.menu-trigger').addEventListener('click', function() {
				document.querySelector('.main-navigation').classList.toggle('hidden');
				document.querySelector('.site-header').classList.toggle('site-header--open');
			});

			// Header background control
			document.addEventListener('DOMContentLoaded', function() {
				const header = document.querySelector('.site-header');
				const defaultIsDark = header.classList.contains('site-header--dark');

				const observer = new IntersectionObserver((entries) => {
					entries.forEach(entry => {
						if (entry.isIntersecting) {
							const section = entry.target;
							const viewportHeight = window.innerHeight;
							const sectionRect = section.getBoundingClientRect();
							const sectionCenter = sectionRect.top + (sectionRect.height / 2);
							const viewportCenter = viewportHeight / 2;

							// Si le centre de la section est proche du centre du viewport
							if (Math.abs(sectionCenter - viewportCenter) < 100) { // 100px de tolérance
								console.log('Section at center:', section.id); // Debug

								if (section.classList.contains('header-darked')) {
									header.classList.add('site-header--dark');
								} else if (section.classList.contains('header-lighted')) {
									header.classList.remove('site-header--dark');
								} else {
									// Retour à l'état par défaut
									if (defaultIsDark) {
										header.classList.add('site-header--dark');
									} else {
										header.classList.remove('site-header--dark');
									}
								}
							}
						}
					});
				}, {
					threshold: [0, 0.25, 0.5, 0.75, 1], // Points de détection multiples pour un suivi plus fluide
					rootMargin: '0px'
				});

				// Observer toutes les sections navigables
				document.querySelectorAll('section.navigable').forEach(section => {
					observer.observe(section);
					console.log('Observing section:', section.id); // Debug
				});
			});
		</script>