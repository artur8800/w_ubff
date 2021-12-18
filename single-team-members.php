<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ubff
 */

get_header();
?>
<?php 


$instagram = carbon_get_the_post_meta( 'crb_team_instagram_link' );
$facebook = carbon_get_the_post_meta( 'crb_team_facebook_link' );
$youtube = carbon_get_the_post_meta( 'crb_team_youtube_link' );


?>

<main id="primary" class="site-main SINGLE TEAM">

    <?php
		while ( have_posts() ) :
			the_post();
			?>


    <!-- < ?php get_template_part( 'template-parts/content', get_post_type() ); ?> -->

    <section class="team__member__section section">

        <div class="container">
            <div class="page__navigation">
                <a href="" class="button__rounded page__navigation__link prev__link">
                    До команди
                </a>
            </div>

        </div>
        <div class="container">

            <div class="row">

                <div class="col s4 m8 l3 xl3">

                    <div class="membership__item">
                        <div class="membership__image__block">
                            <img src="../img/team.jpg" alt="" class="membership__image">
                        </div>
                        <div class="membership__social">
                            <ul class="social__list">
                                <?php  

								if(!empty($facebook)) {
								echo '<li class="social__item"><a href="'. $facebook .'" class="social__link social__button"><img src="'. get_template_directory_uri( ) .'/dist/img/social/coolicon.svg" alt="">'
								}
								
								?>
                                <li class="social__item">
                                    <a href="" class="social__link social__button">
                                        <img src="../img/social/coolicon.svg" alt="">
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="" class="social__link social__button">
                                        <img src="../img/social/coolicon-1.svg" alt="">
                                    </a>

                                </li>
                                <li class="social__item">
                                    <a href="" class="social__link social__button">
                                        <img src="../img/social/coolicon-2.svg" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col s4 m8 l9 xl9">
                    <div class="membership__main__info">
                        <h3 class="membership__title post-title">
                            Ім’я Прізвище
                        </h3>
                        <div class="membership__role">
                            <span class="membership__role__item">
                                Роль
                            </span>
                        </div>
                        <div class="membership__description">
                            <p class="post__text">
                                Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget tellus, quis
                                molestie congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui
                                tortor pulvinar libero.Eget tellus, quis molestie congue ut dui tortor pulvinar libero.
                                Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget tellus, quis
                                molestie congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui
                                tortor pulvinar libero.Eget tellus, quis molestie
                                congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui tortor
                                pulvinar libero.Eget tellus, quis molestie congue ut dui tortor pulvinar libero. Eget
                                tellus, quis molestie congue ut dui tortor
                                pulvinar libero.
                            </p>
                            <p class="post__text">Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget
                                tellus, quis molestie congue ut dui tortor pulvinar libero.
                            </p>
                            <p class="post__text">
                                Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget tellus, quis
                                molestie congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui
                                tortor pulvinar libero.Eget tellus, quis molestie congue ut dui tortor pulvinar libero.
                                Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget tellus, quis
                                molestie congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui
                                tortor pulvinar libero.Eget tellus, quis molestie
                                congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui tortor
                                pulvinar libero.Eget tellus, quis molestie congue ut dui tortor pulvinar libero. Eget
                                tellus, quis molestie congue ut dui tortor
                                pulvinar libero.
                            </p>
                            <p class="post__text">Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget
                                tellus, quis molestie congue ut dui tortor pulvinar libero.
                            </p>
                            <p class="post__text">
                                Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget tellus, quis
                                molestie congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui
                                tortor pulvinar libero.Eget tellus, quis molestie congue ut dui tortor pulvinar libero.
                                Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget tellus, quis
                                molestie congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui
                                tortor pulvinar libero.Eget tellus, quis molestie
                                congue ut dui tortor pulvinar libero. Eget tellus, quis molestie congue ut dui tortor
                                pulvinar libero.Eget tellus, quis molestie congue ut dui tortor pulvinar libero. Eget
                                tellus, quis molestie congue ut dui tortor
                                pulvinar libero.
                            </p>
                            <p class="post__text">Eget tellus, quis molestie congue ut dui tortor pulvinar libero.Eget
                                tellus, quis molestie congue ut dui tortor pulvinar libero.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <?php
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'ubff' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'ubff' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

	
			

		endwhile; // End of the loop.
		?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();