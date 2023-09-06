<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$real_estate_parameters = get_field('real_estate_parameters'); // name_of_the_house,location_coordinates, number_of_floors, building_type, image[url,alt]

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->
    <img width="640" height="373" src="<?php echo $real_estate_parameters['image']['url'] ?>" class="attachment-large size-large wp-post-image mt-4" alt="<?php echo $real_estate_parameters['image']['alt'] ?>" decoding="async" sizes="(max-width: 640px) 100vw, 640px">

	<div class="entry-content mt-4 mb-5">

		<?php the_content(); ?>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Назва будинку: <?php echo $real_estate_parameters['name_of_the_house'] ?></li>
            <li class="list-group-item">Координати місцезнаходження: <?php echo $real_estate_parameters['location_coordinates'] ?></li>
            <li class="list-group-item">Кількість поверхів: <?php echo $real_estate_parameters['number_of_floors'] ?></li>
            <li class="list-group-item">Тип будівлі: <?php echo $real_estate_parameters['building_type'] ?></li>
        </ul>
        <?php understrap_link_pages(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
