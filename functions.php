<?php
function load_env($path)
{
    if (!file_exists($path))
        return;

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0)
            continue;

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
require_once get_template_directory() . "/app/options.php";


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
        'nonce' => wp_create_nonce('my_nonce')
    ]);
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'rikti_enqueue_assets');

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');
//include get_template_directory() . '/resources/views/layouts/main.php';





/* SEND MOVING QUOTE EMAIL : STEP 1 */
add_action('wp_ajax_send_moving_quote_step_one_action', 'send_moving_quote_step_one_callback');
add_action('wp_ajax_nopriv_send_moving_quote_step_one_action', 'send_moving_quote_step_one_callback');
function send_moving_quote_step_one_callback()
{
    $client_infos = $_POST['clientInfos'];
    // wp_send_json_success(['received' => $client_infos]);
    //$logo_url = 'https://images.pexels.com/photos/1337380/pexels-photo-1337380.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'; // Replace with your logo
    $body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="' . $logo_url . '" alt="Logo" style="max-height: 60px;">
        </div>

        <h2 style="margin-bottom: 10px;">Client contact infos</h2>
        <p><strong>Service:</strong> ' . ucfirst($client_infos['serviceType']) . '</p>
    ';
    if ($client_infos['serviceType'] == "moving") {
        $body .= '<p><strong>Property Type:</strong> ' . ucfirst($client_infos['propertyType']) . '</p>';
    }

    $body .= '<p><strong>Email:</strong> ' . htmlspecialchars($client_infos['contactInfos']['email']) . '</p>
        <p><strong>Name:</strong> ' . htmlspecialchars($client_infos['contactInfos']['name']) . '</p>
        <p><strong>Phone:</strong> ' . htmlspecialchars($client_infos['contactInfos']['phone']) . '</p>
    </div>
    ';
    add_filter('wp_mail_content_type', function () {
        return "text/html";
    });
    add_filter('wp_mail_from_name', function () {
        return get_bloginfo('name'); // or a custom name like 'My Moving Company'
    });
    add_filter('wp_mail_from', function () {
        return 'no-reply@yourdomain.com'; // Use a domain-matching email
    });

    $headers[] = 'From: Me Myself <me@example.net>';
    $sent = wp_mail('mouss@4444.lt', 'Price quote - step 1 from ' . $client_infos['contactInfos']['name'], $body);
    echo $sent;
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

/* SEND MOVING QUOTE EMAIL : STEP 2 */
add_action('wp_ajax_send_moving_quote_step_two_action', 'send_moving_quote_step_two_callback');
add_action('wp_ajax_nopriv_send_moving_quote_step_two_action', 'send_moving_quote_step_two_callback');
function send_moving_quote_step_two_callback()
{
    $client_infos = $_POST['clientInfos'];
    $items_data = $_POST['itemsData'];
    $body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="' . $logo_url . '" alt="Logo" style="max-height: 60px;">
        </div>

        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Things to move</h2>

        <table cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;max-width:600px;">
            <thead>
            <tr style="background-color: #f2f2f2;">
                <th align="left">Item</th>
                <th align="right">Qty</th>
                <th align="right">Vol (m³)</th>
                <th align="right">Total Vol</th>
            </tr>
            </thead>
            <tbody>';

    $totalVolume = 0;
    foreach ($items_data as $id => $item) {
        $qty = (int) $item['quantity'];
        $vol = (float) $item['volumePerItem'];
        $total = round($qty * $vol, 2);
        $totalVolume += $total;

        $body .= "<tr>
                <td>" . ucfirst($id) . "</td>
                <td align='right'>{$qty}</td>
                <td align='right'>{$vol}</td>
                <td align='right'>{$total}</td>
            </tr>";
    }

    $body .= "<tr style='font-weight: bold; background-color: #fafafa;'>
                <td colspan='3' align='right'>Total Volume:</td>
                <td align='right'>" . round($totalVolume, 2) . " m³</td>
            </tr>";

    $body .= '</tbody></table></div>';

    add_filter('wp_mail_content_type', function () {
        return "text/html";
    });
    add_filter('wp_mail_from_name', function () {
        return get_bloginfo('name'); // or a custom name like 'My Moving Company'
    });
    add_filter('wp_mail_from', function () {
        return 'no-reply@yourdomain.com'; // Use a domain-matching email
    });

    //$headers[] = 'From: Me Myself <me@example.net>';
    $sent = wp_mail('mouss@4444.lt', 'Price quote - step 2 from ' . $client_infos['contactInfos']['name'], $body);
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

/* SEND MOVING QUOTE EMAIL : STEP 3 */
add_action('wp_ajax_send_moving_quote_final_action', 'send_moving_quote_final_callback');
add_action('wp_ajax_nopriv_send_moving_quote_final_action', 'send_moving_quote_final_callback');
function send_moving_quote_final_callback()
{
    $client_infos = $_POST['finalFormObject']['clientInfos'];
    $property_type = $client_infos['propertyType'];
    $items_data = $_POST['finalFormObject']['itemsData'];
    $moving_from = $_POST['finalFormObject']['movingFrom'];
    $moving_to = $_POST['finalFormObject']['movingTo'];
    $moving_details = $_POST['finalFormObject']['movingDetails'];

    $body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Client contact infos</h2>
        <p><strong>Service:</strong> ' . ucfirst($client_infos['serviceType']) . '</p>
        <p><strong>Property Type:</strong> ' . ucfirst($client_infos['propertyType']) . '</p>
        <p><strong>Email:</strong> ' . htmlspecialchars($client_infos['contactInfos']['email']) . '</p>
        ';
    if ($property_type == "business") {
        $body .= ' 
        <p><strong>Comapny name:</strong> ' . htmlspecialchars($client_infos['contactInfos']['name']) . '</p>
        ';

    } elseif ($property_type == "individual-home") {
        $body .= ' 
        <p><strong>Name:</strong> ' . htmlspecialchars($client_infos['contactInfos']['name']) . '</p>
        ';
    }

    $body .= ' 
        <p><strong>Phone:</strong> ' . htmlspecialchars($client_infos['contactInfos']['phone']) . '</p>
    </div>
    ';
    $body .= '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Things to move</h2>

        <table cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;max-width:600px; margin-top: 10px;">
                <thead>
                <tr style="background-color: #f2f2f2;">
                    <th align="left">Item</th>
                    <th align="right">Qty</th>
                    <th align="right">Vol (m³)</th>
                    <th align="right">Total Vol</th>
                </tr>
                </thead>
                <tbody>';

    $totalVolume = 0;
    foreach ($items_data as $id => $item) {
        $qty = (int) $item['quantity'];
        $vol = (float) $item['volumePerItem'];
        $total = round($qty * $vol, 2);
        $totalVolume += $total;

        $body .= "<tr>
                <td>" . ucfirst($id) . "</td>
                <td align='right'>{$qty}</td>
                <td align='right'>{$vol}</td>
                <td align='right'>{$total}</td>
            </tr>";
    }

    $body .= "<tr style='font-weight: bold; background-color: #fafafa;'>
                <td colspan='3' align='right'>Total Volume:</td>
                <td align='right'>" . round($totalVolume, 2) . " m³</td>
            </tr>";

    $body .= '</tbody></table></div>';

    if ($property_type == "business") {
        $body .= '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;margin-top:28px;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Address</h2>
 
        <table style="width:100%;">
            <tr>
                <td align="left" style="width: 50%;padding-right: 8px;">
                    <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Moving from</h4>
                    <table cellspacing="0" cellpadding="10" border="1" style="border-collapse: collapse; width: 100%;margin-bottom:20px;">
                        <tr style="background-color: #f9f9f9;">
                            <th align="left">Address</th>
                            <th align="left">Area ( sq m )</th>
                            <th align="left">Floor</th>
                            <th align="left">Carrying distance</th>
                            <th align="left">Elevator</th>
                        </tr>
                        <tr>
                            <td style="text-wrap: nowrap;">' . htmlspecialchars($moving_from['address']) . '</td>
                            <td>' . htmlspecialchars($moving_from['area']) . '</td>
                            <td>' . htmlspecialchars($moving_from['floor']) . '</td>
                            <td>' . htmlspecialchars($moving_from['carrydistance']) . '</td>
                            <td>' . htmlspecialchars($moving_from['elevator']) . '</td>           
                        </tr>
                    </table>
                </td>
                <td align="right" style="width: 50%;padding-left: 8px;">
                    <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;text-align:left;">Moving to</h4>
                    <table cellspacing="0" cellpadding="10" border="1" style="border-collapse: collapse; width: 100%;margin-bottom:20px;">
                        <tr style="background-color: #f9f9f9;">
                        <th align="left">Address</th>
                            <th align="left">Area ( sq m )</th>
                            <th align="left">Floor</th>
                            <th align="left">Carrying distance</th>
                            <th align="left">Elevator</th>
                        </tr>
                        <tr>
                        <td style="text-wrap: nowrap;">' . htmlspecialchars($moving_to['address']) . '</td>
                            <td>' . htmlspecialchars($moving_to['area']) . '</td>
                            <td>' . htmlspecialchars($moving_to['floor']) . '</td>
                            <td>' . htmlspecialchars($moving_to['carrydistance']) . '</td>
                            <td>' . htmlspecialchars($moving_to['elevator']) . '</td>  
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Moving Details</h4>
        ';

        if (!empty($moving_details['date'])) {
            $body .= '<p><strong>Desired date:</strong> ' . $moving_details['date'] . '</p>';
        }
        if ($moving_details['flexibeldate'] == true) {
            $body .= '<p><strong>Flexible date:</strong> Yes</p>';
        }

        if ($moving_details['extraservices'] == true || $moving_details['packmaterials'] == true || $moving_details['assembling'] == true || $moving_details['recycle'] == true || $moving_details['laundry'] == true) {
            $body .= '<p><strong>Extra services:</strong></p>';
            if ($moving_details['packing'] == true) {
                $body .= '<p>Packing</p>';
            }
            if ($moving_details['packmaterials'] == true) {
                $body .= '<p>Packaging materials</p>';
            }
            if ($moving_details['assembling'] == true) {
                $body .= '<p>Assembeling</p>';
            }
            if ($moving_details['recycle'] == true) {
                $body .= '<p>Recycle station</p>';
            }
            if ($moving_details['laundry'] == true) {
                $body .= '<p>Renhold</p>';
            }
        }
        if (!empty($moving_details['notes'])) {
            $body .= '<p style="display:block;"><strong>Moving notes:</strong></p>';
            $body .= '<p>' . $moving_details['notes'] . '</p>';
        }
        $body .= '</div>';
    } elseif ($property_type == "individual-home") {
        $body .= '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;margin-top:28px;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Address</h2>
        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Moving from</h4>
        <table cellspacing="0" cellpadding="10" border="1" style="border-collapse: collapse; width: 100%;margin-bottom:20px;">
            <tr style="background-color: #f9f9f9;">
                <th align="left">Address</th>
                <th align="left">Postal code</th>
                <th align="left">Postal address</th>
                <th align="left">Building Type</th>
                <th align="left">Elevator</th>
                <th align="left">Floor</th>
                <th align="left">Area</th>
                <th align="left">Carrying distance</th>
            </tr>
            <tr>
                <td style="text-wrap: nowrap;">' . htmlspecialchars($moving_from['address']) . '</td>
                <td>' . htmlspecialchars($moving_from['postalcode']) . '</td>
                <td>' . htmlspecialchars($moving_from['postaladdress']) . '</td>
                <td>' . htmlspecialchars($moving_from['buildingtype']) . '</td>
                <td>' . htmlspecialchars($moving_from['elevator']) . '</td>
                <td>' . htmlspecialchars($moving_from['floor']) . '</td>
                <td>' . htmlspecialchars($moving_from['area']) . '</td>
                <td>' . htmlspecialchars($moving_from['carrydistance']) . '</td>
            </tr>
        </table>
        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Moving to</h4>
        <table cellspacing="0" cellpadding="10" border="1" style="border-collapse: collapse; width: 100%;margin-bottom:20px;">
            <tr style="background-color: #f9f9f9;">
                <th align="left">Address</th>
                <th align="left">Postal code</th>
                <th align="left">Postal address</th>
                <th align="left">Building Type</th>
                <th align="left">Elevator</th>
                <th align="left">Floor</th>
                <th align="left">Area</th>
                <th align="left">Carrying distance</th>
            </tr>
            <tr>
                <td style="text-wrap: nowrap;">' . htmlspecialchars($moving_to['address']) . '</td>
                <td>' . htmlspecialchars($moving_to['postalcode']) . '</td>
                <td>' . htmlspecialchars($moving_to['postaladdress']) . '</td>
                <td>' . htmlspecialchars($moving_to['buildingtype']) . '</td>
                <td>' . htmlspecialchars($moving_to['elevator']) . '</td>
                <td>' . htmlspecialchars($moving_to['floor']) . '</td>
                <td>' . htmlspecialchars($moving_to['area']) . '</td>
                <td>' . htmlspecialchars($moving_to['carrydistance']) . '</td>
            </tr>
        </table>
        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Moving Details</h4>
        ';

        if (!empty($moving_details['date'])) {
            $body .= '<p><strong>Desired date:</strong> ' . $moving_details['date'] . '</p>';
        }
        if ($moving_details['flexibeldate'] == true) {
            $body .= '<p><strong>Flexible date:</strong> Yes</p>';
        }

        if ($moving_details['extraservices'] == true || $moving_details['packmaterials'] == true || $moving_details['assembling'] == true || $moving_details['recycle'] == true || $moving_details['laundry'] == true) {
            $body .= '<p><strong>Extra services:</strong></p>';
            if ($moving_details['packing'] == true) {
                $body .= '<p>Packing</p>';
            }
            if ($moving_details['packmaterials'] == true) {
                $body .= '<p>Packaging materials</p>';
            }
            if ($moving_details['assembling'] == true) {
                $body .= '<p>Assembeling</p>';
            }
            if ($moving_details['recycle'] == true) {
                $body .= '<p>Recycle station</p>';
            }
            if ($moving_details['laundry'] == true) {
                $body .= '<p>Flyttevask</p>';
            }
        }
        if (!empty($moving_details['notes'])) {
            $body .= '<p style="display:block;"><strong>Moving notes:</strong></p>';
            $body .= '<p>' . $moving_details['notes'] . '</p>';
        }
        $body .= '</div>';
    }
    add_filter('wp_mail_content_type', function () {
        return "text/html";
    });
    add_filter('wp_mail_from_name', function () {
        return get_bloginfo('name'); // or a custom name like 'My Moving Company'
    });
    add_filter('wp_mail_from', function () {
        return 'no-reply@yourdomain.com'; // Use a domain-matching email
    });

    $headers[] = 'From: Me Myself <me@example.net>';
    $sent = wp_mail('mouss@4444.lt', 'Price quote - final form from ' . $client_infos['contactInfos']['name'], $body);
    if ($sent) {
        echo 'Email sent successfully!' . $moving_details['flexibeldate'];
    } else {
        echo 'Failed to send email.';
    }
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}


/* SEND CLEANING QUOTE EMAIL : STEP 1 */
add_action('wp_ajax_send_cleaning_quote_final_action', 'send_cleaning_quote_final_action_callback');
add_action('wp_ajax_nopriv_send_cleaning_quote_final_action', 'send_cleaning_quote_final_action_callback');
function send_cleaning_quote_final_action_callback()
{
    $client_infos = $_POST['finalFormObject']['clientInfos'];
    $cleaningFormData = $_POST['finalFormObject']['cleaningFormData'];

    //$body = '
    //<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
    //    <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Client contact infos</h2>
    //    <p><strong>Service:</strong> ' . ucfirst($client_infos['serviceType']) . '</p>
    //    <p><strong>Email:</strong> ' . htmlspecialchars($client_infos['contactInfos']['email']) . '</p>
    //    <p><strong>Name:</strong> ' . htmlspecialchars($client_infos['contactInfos']['name']) . '</p>
    //    <p><strong>Phone:</strong> ' . htmlspecialchars($client_infos['contactInfos']['phone']) . '</p>
    //    <p><strong>Address:</strong> ' . htmlspecialchars($cleaningFormData['address']) . '</p>
    //    <p><strong>Size of home in sq m:</strong> ' . htmlspecialchars($cleaningFormData['size']) . '</p>
    //    <p><strong>Number of bathrooms:</strong> ' . htmlspecialchars($cleaningFormData['bathroomsnumber']) . '</p>
    //    <p><strong>Desired date:</strong> ' . htmlspecialchars($cleaningFormData['date']) . '</p>
    //    <p><strong>Notes:</strong> ' . htmlspecialchars($cleaningFormData['notes']) . '</p>
    //</div>
    //';
    //$body .= '</div>';

    $body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Cleaning quote</h2>

        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Client contact infos</h4>
        <table cellspacing="0" cellpadding="10" border="1" style="border-collapse: collapse;margin-bottom:20px;">
            <tr style="background-color: #f9f9f9;">
                <th align="left">Email</th>
                <th align="left">Name</th>
                <th align="left">Phone</th>
            </tr>
            <tr>
                <td>' . htmlspecialchars($client_infos['contactInfos']['email']) . '</td>
                <td>' . htmlspecialchars($client_infos['contactInfos']['name']) . '</td>
                <td>' . htmlspecialchars($client_infos['contactInfos']['phone']) . '</td>
            </tr>
        </table>   
        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Details</h4>
        <table cellspacing="0" cellpadding="10" border="1" style="border-collapse: collapse; width: 100%;margin-bottom:20px;">
            <tr style="background-color: #f9f9f9;">
                <th align="left">Address</th>
                <th align="left">Size (sq m)</th>
                <th align="left">Number of bathrooms</th>
                <th align="left">Desired date</th>
                <th align="left">Notes</th>
            </tr>
            <tr>
                <td>' . htmlspecialchars($cleaningFormData['address']) . '</td>
                <td>' . htmlspecialchars($cleaningFormData['size']) . '</td>
                <td>' . htmlspecialchars($cleaningFormData['bathroomsnumber']) . '</td>
                <td>' . htmlspecialchars($cleaningFormData['date']) . '</td>
                <td>' . htmlspecialchars($cleaningFormData['notes']) . '</td>
            </tr>
        </table>         
    ';

    add_filter('wp_mail_content_type', function () {
        return "text/html";
    });
    add_filter('wp_mail_from_name', function () {
        return get_bloginfo('name'); // or a custom name like 'My Moving Company'
    });
    add_filter('wp_mail_from', function () {
        return 'no-reply@yourdomain.com'; // Use a domain-matching email
    });

    $headers[] = 'From: Me Myself <me@example.net>';
    $sent = wp_mail('mouss@4444.lt', 'Price quote - final form from ' . $client_infos['contactInfos']['name'], $body);
    if ($sent) {
        echo 'Email sent successfully!';
    } else {
        echo 'Failed to send email.';
    }
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}