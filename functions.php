<?php
function load_env($path)
{
    if (!file_exists($path)) return;

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Strip surrounding quotes
        $value = trim($value, '"\'');

        putenv("$key=$value");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}
load_env(__DIR__ . '/.env');

require_once get_template_directory() . '/app/setup.php';
require_once get_template_directory() . "/app/utilities.php";


define('RIKTIG_THEME_DIR', trailingslashit(get_template_directory()));
define('RIKTIG_THEME_URI', trailingslashit(esc_url(get_template_directory_uri())));

if (getenv('DEV_MODE') == "staging") {
    define('URL_BASE', 'http://localhost:5173'); // DEV OR PRODUCTION URL
} elseif (getenv('DEV_MODE') == "production") {
    define('URL_BASE', get_template_directory_uri() . '/public'); // DEV OR PRODUCTION URL
}



function rikti_enqueue_assets()
{
    $dev_mode = getenv('DEV_MODE');
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();
    $dev_server = 'http://localhost:5173';
    if ($dev_mode == "production") {
        if (file_exists($theme_dir . '/public/.vite/manifest.json')) {
            $manifest = json_decode(file_get_contents($theme_dir . '/public/.vite/manifest.json'), true);
            $js = $manifest['resources/js/main.js']['file'];
            $css = $manifest['resources/js/main.js']['css'][0] ?? null;
            if ($css) {
                wp_enqueue_style('rikti-style', "$theme_uri/public/$css", [], null);
            }

            wp_enqueue_script('rikti-js', "$theme_uri/public/$js", [], null, true);
        }
    } else {
        //wp_enqueue_script('vite-client', "$dev_server/@vite/client", [], null, true);
        //wp_enqueue_script('rikti-js', "$dev_server/js/main.js", [], null, true);
    }
    wp_localize_script('rikti-js', 'my_ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('my_nonce')
    ]);
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'rikti_enqueue_assets');

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');
//include get_template_directory() . '/resources/views/layouts/main.php';

add_action('wp_ajax_my_ajax_action', 'my_ajax_callback');
add_action('wp_ajax_nopriv_my_ajax_action', 'my_ajax_callback'); // for non-logged-in users

function my_ajax_callback()
{
    //check_ajax_referer('my_nonce', 'nonce');

    // Example response
    wp_send_json_success(['received' => $_POST['message']]);
}


function render_item_block($id, $volume, $image_url, $label)
{
    echo '
    <div class="flex gap-4 item w-fit" data-id="' . htmlspecialchars($id) . '" data-volume="' . htmlspecialchars($volume) . '">
        <div class="flex items-center gap-2.5">
            <button class="bg-[#F8F8F8] w-[25px] h-[25px] rounded-2xl text-lg text-[#474747] font-bold flex items-center justify-center border border-[#CDD5EA] cursor-pointer" onclick="changeQty(this, -1)">-</button>
            <span class="qty text-lg text-[#474747] mt-[1px] w-[23px] text-center">0</span>
            <button class="bg-[#34A853] w-[25px] h-[25px] rounded-2xl text-lg text-white font-bold flex items-center justify-center cursor-pointer" onclick="changeQty(this, 1)">+</button>
        </div>
        <div class="flex items-center gap-3">
            <div style="width:40px;display: flex;justify-content: center;align-items: center;"><img src="' . htmlspecialchars($image_url) . '"></div>
            <span class="text-[#474747] text-lg">' . htmlspecialchars($label) . '</span>
        </div>
    </div>';
}

function get_page_by_template($template)
{
    $args = array(
        'meta_key' => '_wp_page_template',
        'meta_value' => "templates/{$template}",
    );
    return get_pages($args);
}
