<?php
include get_template_directory() . './template-parts/utils/utils.php';

use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'crb_team_member_info' );
function crb_team_member_info() {
   
    Block::make( __( 'Team members block' ) )
    
    ->add_tab( __('Leadership'), array(
        Field::make('text', 'crb_leadership_label', __('Leadership label text')),
        Field::make( 'association', 'crb_association_leadership', __( 'Leadership query' ) )
        ->set_duplicates_allowed( true )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'team-members',
            )
        ))
    ))
    ->add_tab( __('Trainers'), array(
        Field::make('text', 'crb_trainers_label', __('Trainers label text')),
        Field::make( 'association', 'crb_association_trainers', __( 'Trainers query' ) )
        ->set_duplicates_allowed( true )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'team-members',
            )
        ))
    ))
    ->add_tab( __('Athletes'), array(
        Field::make('text', 'crb_athletes_label', __('Athletes label text')),
        Field::make( 'association', 'crb_association_athletes', __( 'Athletes query' ) )
        ->set_duplicates_allowed( true )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'team-members',
            )
        ))
    ))
            
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		?>
<?php 

$leaderships = $fields['crb_association_leadership' ];
$trainers = $fields['crb_association_trainers' ];
$athletes = $fields['crb_association_athletes' ];





?>


<div class="heading__block clearfix">
    <h2 class="main-title"><?php echo get_the_title()  ?></h2>
</div>


<div class="section__directorship">
    <div class="container">
        <div class="label__wrapper align-center">
            <span class="page__label">
                <?php  if (!empty($fields['crb_leadership_label'])) {
                    echo esc_html($fields['crb_leadership_label']);
                }?>
            </span>
        </div>
        <div class="row">

            <?php 

                if ( $leaderships ) {

                    foreach ( $leaderships as $leadership ) {

                        $role = carbon_get_post_meta( $leadership['id'], 'crb_team_member_role' );
                        $leadership_image_id = get_post_thumbnail_id($leadership['id']);

                        echo '<div class="col s4 m4 l3 xl3"><div class="membership__item">';
                            echo '<a href="'. get_post_permalink($leadership['id']) .'" class="membership__link">';
                                echo '<div class="membership__image__block">';
                                echo wp_image_with_srcset_and_meta($leadership_image_id, 'gallery-vertical', 'membership__image');
                                echo '</div>';
                                echo '<h3 class="membership__title post-title">' . get_the_title($leadership['id']) . '</h3>';
                                echo '<div class="membership__role"><span class="membership__role__item">'. $role .'</span></div>';
                            echo '</a>';
                        echo '</div></div>';
                    }
                }

            ?>
        </div>
    </div>
    <div class="container">
        <div class="label__wrapper align-center">
            <span class="page__label">
                <?php  if (!empty($fields['crb_trainers_label'])) {
                    echo esc_html($fields['crb_trainers_label']);
                }?>
            </span>
        </div>
        <div class="row">

            <?php 

                if ( $trainers ) {

                    foreach ( $trainers as $trainer ) {

                        $role = carbon_get_post_meta( $trainer['id'], 'crb_team_member_role' );
                        $trainer_image_id = get_post_thumbnail_id($trainer['id']);

                        echo '<div class="col s4 m4 l3 xl3"><div class="membership__item">';
                            echo '<a href="'. get_post_permalink($trainer['id']) .'" class="membership__link">';
                                echo '<div class="membership__image__block">';
                                echo wp_image_with_srcset_and_meta($trainer_image_id, 'gallery-vertical', 'membership__image');
                                echo '</div>';
                                echo '<h3 class="membership__title post-title">' . get_the_title($trainer['id']) . '</h3>';
                                echo '<div class="membership__role"><span class="membership__role__item">'. $role .'</span></div>';
                            echo '</a>';
                        echo '</div></div>';
                    }
                }

            ?>
        </div>
    </div>
    <div class="container">
        <div class="label__wrapper align-center">
            <span class="page__label">
                <?php  if (!empty($fields['crb_athletes_label'])) {
                    echo esc_html($fields['crb_athletes_label']);
                }?>
            </span>
        </div>
        <div class="row">

            <?php 

                if ( $athletes ) {

                    foreach ( $athletes as $athlete ) {

                        $role = carbon_get_post_meta( $athlete['id'], 'crb_team_member_role' );
                        $athlete_image_id = get_post_thumbnail_id($athlete['id']);

                        echo '<div class="col s4 m4 l3 xl3"><div class="membership__item">';
                            echo '<a href="'. get_post_permalink($athlete['id']) .'" class="membership__link">';
                                echo '<div class="membership__image__block">';
                                echo wp_image_with_srcset_and_meta($athlete_image_id, 'gallery-vertical', 'membership__image');
                                echo '</div>';
                                echo '<h3 class="membership__title post-title">' . get_the_title($athlete['id']) . '</h3>';
                                echo '<div class="membership__role"><span class="membership__role__item">'. $role .'</span></div>';
                            echo '</a>';
                        echo '</div></div>';
                    }
                }

            ?>
        </div>
    </div>
</div>

<?php
	} );
}