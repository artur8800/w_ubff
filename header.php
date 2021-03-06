<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp-ubff
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class('page__body'); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">

        <header class="header">
            <div class="main__header">
                <div class="header__logo left-block">
                    <?php the_custom_logo(); ?>
                </div>

                <nav id="main__navigation" class="header__navigation  right-block">

                    <?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu',
                                        'container' => false,
                                        'menu_class' => 'header__navigation__list' //header__navigation__list
									)
								);
						?>

                    </ul>
                </nav>
            </div>

            <div class="burger__menu">
                <div class="burger"></div>
            </div>

        </header>