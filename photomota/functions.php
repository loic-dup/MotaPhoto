<?php
function photomota_register_my_menu()
{
    register_nav_menu('main-menu', __('Menu principal', 'text-domain'));
}
add_action('after_setup_theme', 'photomota_register_my_menu');
function photomota_inclure_script_personnalise()
{
    wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0', true);
    wp_enqueue_script('menus', get_template_directory_uri() . '/assets/js/menus.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'photomota_inclure_script_personnalise');

require_once get_template_directory() . '/assets/walker/menus.php';

function photomota_add_admin_page()
{
    add_menu_page(__('Paramètres du thème PhotoMota', 'PhotoMota'), __('PhotoMota', 'photomota'), 'manage_options', 'photomota-settings', 'photomota_theme_settings', 'dashicons-admin-settings', 60);
}

function photomota_theme_settings()
{

    echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';

    echo '<form action="options.php" method="post" name="photomota_settings">';

    echo '<div>';

    settings_fields('photomota_settings_fields');

    do_settings_sections('photomota_settings_section');

    submit_button();

    echo '</div>';

    echo '</form>';
}

add_action('admin_menu', 'photomota_add_admin_page');

function photomota_settings_register()
{
    register_setting('photomota_settings_fields', 'photomota_settings_fields', 'photomota_settings_fields_validate');
    add_settings_section('photomota_settings_section', __('Paramètres', 'photomota'), 'photomota_settings_section_introduction', 'photomota_settings_section');
    add_settings_field('photomota_settings_field_introduction', __('Introduction', 'photomota'), 'photomota_settings_field_introduction_output', 'photomota_settings_section', 'photomota_settings_section');
}

function photomota_settings_section_introduction()
{
    echo __('Paramètrez les différentes options de votre thème photomota.', 'photomota');
}

function photomota_settings_field_introduction_output()
{
    $value = get_option('photomota_settings_field_introduction');

    echo '<input name="photomota_settings_field_introduction" type="text" value="' . $value . '" />';
}

function photomota_settings_fields_validate($inputs)
{
    if (!empty($_POST)) {
        if (!empty($_POST['photomota_settings_field_introduction'])) {
            update_option('photomota_settings_field_introduction', $_POST['photomota_settings_field_introduction']);
        }
        if (!empty($_POST['photomota_settings_field_phone_number'])) {
            update_option('photomota_settings_field_phone_number', $_POST['photomota_settings_field_phone_number']);
        }
        if (!empty($_POST['photomota_settings_field_email'])) {
            update_option('photomota_settings_field_email', $_POST['photomota_settings_field_email']);
        }
    }
    return $inputs;
}

add_action('admin_init', 'photomota_settings_register');
