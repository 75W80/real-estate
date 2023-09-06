<?php
/**
 * Partial template for content in page.php
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$real_estate_parameters = get_field('real_estate_parameters');
?>
<div <?php post_class('real-estate'); ?> id="post-<?php the_ID(); ?>">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="<?php echo $real_estate_parameters['image']['url'] ?: '' ?>"
                     class="img-fluid rounded-start"
                     alt="<?php echo $real_estate_parameters['image']['alt'] ?: '' ?>"
                >
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <a href="<?php the_permalink() ?>">
                        <h5 class="card-title">Назва будинку: <?php echo $real_estate_parameters['name_of_the_house'] ?: 'Назва будинку' ?></h5>
                    </a>
                    <p class="card-text"><small class="text-muted">Координати місцезнаходження: <?php echo $real_estate_parameters['location_coordinates'] ?: 'Координати місцезнаходження' ?></small></p>
                    <p class="card-text"><small class="text-muted">Кількість поверхів: <?php echo $real_estate_parameters['number_of_floors'] ?: 'Кількість поверхів' ?></small></p>
                    <p class="card-text"><small class="text-muted">Тип будівлі: <?php echo $real_estate_parameters['building_type'] ?: 'Тип будівлі' ?></small></p>
                    <p class="card-text"><?php the_content(); ?></p>
                </div>
            </div>
        </div>
    </div>
</div><!-- #post-<?php the_ID(); ?> -->
