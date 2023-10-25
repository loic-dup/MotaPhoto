<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoMota</title>
</head>

<body>
  <nav role="navigation" aria-label="<?php _e('Menu principal', 'text-domain'); ?>">
    <button type="button" aria-expanded="false" aria-controls="primary-menu" class="menu-toggle">
      <?php esc_html_e('Menu', 'text-domain'); ?>
    </button>
    <?php
    wp_nav_menu([
      'theme_location' => 'main-menu',
      'container'      => false, // On retire le conteneur généré par WP
      'walker'         => new A11y_Walker_Nav_Menu(),
      'menu_id'        => 'primary-menu',
    ]);
    ?>
  </nav>