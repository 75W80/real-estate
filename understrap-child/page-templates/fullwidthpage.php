<?php
/**
 * Template Name: Full Width Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}

$wrapper_id = 'full-width-page-wrapper';
if ( is_page_template( 'page-templates/no-title.php' ) ) {
	$wrapper_id = 'no-title-page-wrapper';
}
?>

<div class="wrapper" id="<?php echo $wrapper_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- ok. ?>">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					}

                    $real_estate_posts = real_estate_posts();
                    if ( $real_estate_posts->have_posts() ) {
                    ?>
                        <div class="entry-content">
                            <form id="filter-form" class="row g-3 mt-5 mb-5" action="real_estate_filter" method="post">
                                <div class="col-md-6">
                                    <label for="numberFloors" class="form-label">Кількість поверхів:</label>
                                    <select id="numberFloors" class="form-select" name="number-floors">
                                        <option value="">Виберіть...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="typeHouse" class="form-label">Тип будинку:</label>
                                    <select id="typeHouse" class="form-select" name="type-house">
                                        <option value="">Виберіть...</option>
                                        <option value="panel">Панель</option>
                                        <option value="brick">Цегла</option>
                                        <option value="foam_block">Піноблок</option>
                                    </select>
                                </div>
                            </form>

                            <div id="real_estate_post-list">
                                <?php
                                while ( $real_estate_posts->have_posts() ){
                                    $real_estate_posts->the_post();
                                    get_template_part( 'loop-templates/content', 'real-estate' );
                                }
                                ?>
                            </div>

                        </div><!-- .entry-content -->
                    <?php
                        wp_reset_postdata();
                    }
					?>

				</main>

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #<?php echo $wrapper_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- ok. ?> -->

<?php
get_footer();
