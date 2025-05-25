<?php
function register_custom_menus()
{
    register_nav_menus([
        'primary_menu' => __('Primary Menu'),
        'secondary_menu' => __('Secondary Menu'),
        'footer_menu' => __('Footer Menu'),
    ]);
}
add_action('init', 'register_custom_menus');


add_action('admin_init', function () {
    if (!isset($_GET['post']) && !isset($_POST['post_ID'])) {
        return;
    }

    $post_id = $_GET['post'] ?? $_POST['post_ID'];
    $post = get_post($post_id);

    if (!$post || $post->post_type !== 'page') {
        return;
    }

    $template = get_page_template_slug(get_post($post_id));

    // List of templates where you want to remove the editor
    $templates_to_disable_editor = [
        'home.php',
    ];

    if (in_array($template, $templates_to_disable_editor)) {
        remove_post_type_support('page', 'editor');
    }
});
