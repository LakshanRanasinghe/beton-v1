<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Beton
 */

get_header();
?>

	<main id="primary" class="beton-page-content site-main container page404">

		<section class="error-404 not-found py-8">
			<header class="page-header">
				<h1 class="page-title oswald-500 display-3 text-40 m-0 text-black text-uppercase mb-1"><?php esc_html_e( 'Oeps! Die pagina kon niet worden gevonden.', 'beton' ); ?></h1>
				<div class="p-2" style="background: linear-gradient(90deg, #060C35 0%, rgba(253, 212, 1, 0) 100%);"></div>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'Het lijkt erop dat er op deze locatie niets is gevonden. Probeer misschien een van de onderstaande links of gebruik de zoekfunctie.', 'beton' ); ?></p>

					<?php
					// get_search_form();

					// the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<!-- <div class="widget widget_categories">
						<h2 class="widget-title"><?php //esc_html_e( 'Most Used Categories', 'beton' ); ?></h2>
						<ul>
							<?php
							// wp_list_categories(
							// 	array(
							// 		'orderby'    => 'count',
							// 		'order'      => 'DESC',
							// 		'show_count' => 1,
							// 		'title_li'   => '',
							// 		'number'     => 10,
							// 	)
							// );
							?>
						</ul>
					</div> -->

					<?php
					/* translators: %1$s: smiley */
					//$beton_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'beton' ), convert_smilies( ':)' ) ) . '</p>';
					//the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$beton_archive_content" );

					//the_widget( 'WP_Widget_Tag_Cloud' );
					?>

			</div>
		</section>

	</main>

<?php
get_footer();
