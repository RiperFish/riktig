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
add_action('init', function () {
    if (!session_id()) {
        session_start();
    }
});

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
    $service_type = "";
    $property_type = "";
    if ($client_infos['serviceType'] == "moving") {
        $service_type = "Jeg trenger Flyttehjelp";
    } elseif ($client_infos['serviceType'] == "cleaning") {
        $service_type = "Jeg trenger Vaskehjelp";
    }
    if ($client_infos['propertyType'] == "individual-home") {
        $property_type = "Privat";
    } elseif ($client_infos['propertyType'] == "business") {
        $property_type = "Bedrift";
    }
    /* <div style="text-align: center; margin-bottom: 20px;">
        <img src="' . $logo_url . '" alt="Logo" style="max-height: 60px;">
    </div> */
    // wp_send_json_success(['received' => $client_infos]);
    //$logo_url = 'https://images.pexels.com/photos/1337380/pexels-photo-1337380.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'; // Replace with your logo
    $body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
       

        <h2 style="margin-bottom: 10px;">Kundehenvendelse</h2>
        <p><strong>Service:</strong> ' . ucfirst($service_type) . '</p>
    ';
    if ($client_infos['serviceType'] == "moving") {
        $body .= '<p><strong>Kundetype:</strong> ' . ucfirst($property_type) . '</p>';
    }

    $body .= '<p><strong>E-post adresse:</strong> ' . htmlspecialchars($client_infos['contactInfos']['email']) . '</p>
        <p><strong>Navn:</strong> ' . htmlspecialchars($client_infos['contactInfos']['name']) . '</p>
        <p><strong>Telefon:</strong> ' . htmlspecialchars($client_infos['contactInfos']['phone']) . '</p>
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
    $sent = wp_mail('eduardas@riktigflytting.no', 'Price quote - step 1 from ' . $client_infos['contactInfos']['name'], $body);
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

        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Flyttelista</h2>

        <table cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;max-width:600px;">
            <thead>
            <tr style="background-color: #f2f2f2;">
                <th align="left">Vare</th>
                <th align="right">Antall</th>
                <th align="right">Vol (m³)</th>
                <th align="right">Total Vol</th>
            </tr>
            </thead>
            <tbody>';

    $totalVolume = 0;
    foreach ($items_data as $label => $item) {
        $id = $item['id'];
        $qty = (int) $item['quantity'];
        $vol = (float) $item['volumePerItem'];
        $total = round($qty * $vol, 2);
        $totalVolume += $total;

        $body .= "<tr>
                <td>" . str_replace('-', ' ', ucfirst($label)) . "</td>
                <td align='right'>{$qty}</td>
                <td align='right'>{$vol}</td>
                <td align='right'>{$total}</td>
            </tr>";
    }

    $body .= "<tr style='font-weight: bold; background-color: #fafafa;'>
                <td colspan='3' align='right'>Total volum:</td>
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
    $sent = wp_mail('eduardas@riktigflytting.no', 'Price quote - step 2 from ' . $client_infos['contactInfos']['name'], $body);
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

/* SEND MOVING QUOTE EMAIL : STEP 3 */
// SET THE INCOMPLETE EMAIL AS SENT
add_action('wp_ajax_send_moving_quote_final_action', 'send_moving_quote_final_callback');
add_action('wp_ajax_nopriv_send_moving_quote_final_action', 'send_moving_quote_final_callback');
function send_moving_quote_final_callback()
{
    global $wpdb;
    $client_infos = $_POST['finalFormObject']['clientInfos'];
    $property_type = $client_infos['propertyType'];
    $items_data = $_POST['finalFormObject']['itemsData'];
    $moving_from = $_POST['finalFormObject']['movingFrom'];
    $moving_to = $_POST['finalFormObject']['movingTo'];
    $moving_details = $_POST['finalFormObject']['movingDetails'];
    $email_id = $_POST['sessionId'];

    $service_type_nor = "";
    $property_type_nor = "";
    if ($client_infos['serviceType'] == "moving") {
        $service_type_nor = "Jeg trenger Flyttehjelp";
    } elseif ($client_infos['serviceType'] == "cleaning") {
        $service_type_nor = "Jeg trenger Vaskehjelp";
    }
    if ($client_infos['propertyType'] == "individual-home") {
        $property_type_nor = "Privat";
    } elseif ($client_infos['propertyType'] == "business") {
        $property_type_nor = "Bedrift";
    }
    //<p><strong>Service:</strong> ' . ucfirst($service_type_nor) . '</p>
    $body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Kundehenvendelse</h2>
        <p><strong>Kundetype:</strong> ' . ucfirst($property_type_nor) . '</p>
        ';
    if ($property_type == "business") {
        $body .= ' 
        <p><strong>Firmanavn:</strong> ' . htmlspecialchars($client_infos['contactInfos']['name']) . '</p>
        ';

    } elseif ($property_type == "individual-home") {
        $body .= ' 
        <p><strong>Navn:</strong> ' . htmlspecialchars($client_infos['contactInfos']['name']) . '</p>
        ';
    }
    $body .= '<p><strong>E-post adresse:</strong> ' . htmlspecialchars($client_infos['contactInfos']['email']) . '</p>';
    $body .= ' 
        <p><strong>Telefon:</strong> ' . htmlspecialchars($client_infos['contactInfos']['phone']) . '</p>
    </div>
    ';
    $body .= '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Flyttelista</h2>

        <table cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;max-width:600px; margin-top: 10px;">
                <thead>
                <tr style="background-color: #f2f2f2;">
                    <th align="left">Vare</th>
                    <th align="right">Antall</th>
                    <th align="right">Vol (m³)</th>
                    <th align="right">Total Vol</th>
                </tr>
                </thead>
                <tbody>';

    $totalVolume = 0;
    foreach ($items_data as $label => $item) {
        $id = $item['id'];
        $qty = (int) $item['quantity'];
        $vol = (float) $item['volumePerItem'];
        $total = round($qty * $vol, 2);
        $totalVolume += $total;

        $body .= "<tr>
                <td>" . str_replace('-', ' ', ucfirst($label)) . "</td>
                <td align='right'>{$qty}</td>
                <td align='right'>{$vol}</td>
                <td align='right'>{$total}</td>
            </tr>";
    }

    $body .= "<tr style='font-weight: bold; background-color: #fafafa;'>
                <td colspan='3' align='right'>Total volum:</td>
                <td align='right'>" . round($totalVolume, 2) . " m³</td>
            </tr>";

    $body .= '</tbody></table></div>';

    if ($property_type == "business") {
        $body .= '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;margin-top:28px;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Adresse</h2>
 
        <table style="width:95%;">
            <tr>
                <td align="left" style="width: 50%;padding-right: 30px;">
                    <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Flytter fra</h4>
                    <div style="margin-bottom:20px;">
                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;display:block;text-align:left;">Adresse</label>
                        <input type="text" disabled
                            style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                            value="' . htmlspecialchars($moving_from['address']) . '">
                    </div>
                    <div style="margin-bottom:20px;">
                        <table style="width:100%;">
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Areal I kvm</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_from['area']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>
                                    <div>
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Etasje</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_from['floor']) . '">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div style="margin-bottom:20px;">
                        <table>
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Bæreavstand</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;"
                                            value="' . htmlspecialchars($moving_from['carrydistance']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>
                                    <div>
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Heis</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;"
                                            value="' . ($moving_from['elevator'] == true ? "Ja" : "Nei") . '">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>

                <td align="right" style="width: 50%;padding-left: 30px;">
                    <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;text-align:left;">Flytter til</h4>
                    <div style="margin-bottom:20px;">
                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;display:block;text-align:left;">Adresse</label>
                        <input type="text" disabled
                            style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                            value="' . htmlspecialchars($moving_to['address']) . '">
                    </div>
                    <div style="margin-bottom:20px;">
                        <table>
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Areal I kvm</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_to['area']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>
                                    <div>
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Etasje</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_to['floor']) . '">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div style="margin-bottom:20px;">
                        <table>
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Bæreavstand</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;"
                                            value="' . htmlspecialchars($moving_to['carrydistance']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>
                                    <div>
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Heis</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;"
                                            value="' . ($moving_to['elevator'] == true ? "Ja" : "Nei") . '">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Flyttedetaljer</h4>
        ';
        if (!empty($moving_details['employees'])) {
            $body .= '<p><strong>Antall ansatte som skal flyttes:</strong> ' . $moving_details['employees'] . '</p>';
        }
        if (!empty($moving_details['date'])) {
            $body .= '<p><strong>Ønsket dato:</strong> ' . $moving_details['date'] . '</p>';
        }
        if ($moving_details['flexibeldate'] == true) {
            $body .= '<p><strong>Fleksibel dato:</strong> Ja</p>';
        }

        if ($moving_details['extraservices'] == true || $moving_details['assembling'] == true || $moving_details['recycle'] == true || $moving_details['laundry'] == true) {
            $body .= '<p><strong>Tilleggstjenester:</strong></p>';
            if ($moving_details['packing'] == true) {
                $body .= '<p>Pakking</p>';
            }
            /*             if ($moving_details['packmaterials'] == true) {
                            $body .= '<p>Packaging materials</p>';
                        } */
            if ($moving_details['assembling'] == true) {
                $body .= '<p>Montering</p>';
            }
            if ($moving_details['recycle'] == true) {
                $body .= '<p>Gjenvinningsstasjon</p>';
            }
            if ($moving_details['laundry'] == true) {
                $body .= '<p>Renhold</p>';
            }
        }
        if (!empty($moving_details['notes'])) {
            $body .= '<p style="display:block;"><strong>Merknader:</strong></p>';
            $body .= '<p>' . $moving_details['notes'] . '</p>';
        }
        $body .= '</div>';
    } elseif ($property_type == "individual-home") {
        $body .= '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;margin-top:28px;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Adresse</h2>

        <table style="width:95%;">
            <tr> 
                <td align="left" style="width: 50%;padding-right: 30px;">
                    <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Flytter fra</h4>
                    <div style="margin-bottom:20px;">
                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;display:block;text-align:left;">Adresse</label>
                        <input type="text" disabled
                            style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                            value="' . htmlspecialchars($moving_from['address']) . '">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;display:block;text-align:left;">Postnummer</label>
                        <input type="text" disabled
                            style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                            value="' . htmlspecialchars($moving_from['postalcode']) . '">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;display:block;text-align:left;">Postadresse</label>
                        <input type="text" disabled
                            style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                            value="' . htmlspecialchars($moving_from['postaladdress']) . '">
                    </div>
                    <div style="margin-bottom:20px;">
                        <table>
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Bygningstype</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;"
                                            value="' . htmlspecialchars($moving_from['buildingtype']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>
                                    <div>
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Heis</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;"
                                            value="' . htmlspecialchars($moving_from['elevator'] || $moving_from['elevator'] != '' ? "Ja" : "Nei") . '">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-bottom:20px;">
                        <table style="width:100%;">
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Etasje</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_from['floor']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>
                                    <div>
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Areal</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_from['area']) . '">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-bottom:20px;">
                        <table style="width:100%;">
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Bæreavstand (fra dør til flyttebil)</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_from['carrydistance']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>

                                </td>
                            </tr>
                        </table>
                    </div>
                </td>

                <td align="right" style="width: 50%;padding-left: 30px;">
                    <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;text-align:left;">Flytter til</h4>
                    <div style="margin-bottom:20px;">
                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;display:block;text-align:left;">Adresse</label>
                        <input type="text" disabled
                            style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                            value="' . htmlspecialchars($moving_to['address']) . '">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;display:block;text-align:left;">Postnummer</label>
                        <input type="text" disabled
                            style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                            value="' . htmlspecialchars($moving_to['postalcode']) . '">
                    </div>
                    <div style="margin-bottom:20px;">
                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;display:block;text-align:left;">Postadresse</label>
                        <input type="text" disabled
                            style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                            value="' . htmlspecialchars($moving_to['postaladdress']) . '">
                    </div>
                    <div style="margin-bottom:20px;">
                        <table>
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Bygningstype</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;"
                                            value="' . htmlspecialchars($moving_to['buildingtype']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>
                                    <div>
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Heis</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;"
                                            value="' . htmlspecialchars($moving_to['elevator'] || $moving_to['elevator'] != '' ? "Ja" : "Nei") . '">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-bottom:20px;">
                        <table style="width:100%;">
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Etasje</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_to['floor']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>
                                    <div>
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Areal</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_to['area']) . '">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="margin-bottom:20px;">
                        <table style="width:100%;">
                            <tr>
                                <td style="width: 60%;">
                                    <div style="padding-right: 32px;">
                                        <label for="" style="font-size:16px;color:#474747;margin-bottom:4px;">Bæreavstand (fra dør til flyttebil)</label>
                                        <input type="text" disabled style="width:100%;border:1px solid #CDCDCD;border-radius:3px;height: 45px;color: black;font-size: 17px;padding-left: 16px;padding-right: 16px;" 
                                            value="' . htmlspecialchars($moving_to['carrydistance']) . '">
                                    </div>
                                </td>
                                <td style="width: 20px; font-size: 0; line-height: 0;">
                                    &nbsp;
                                </td>
                                <td>

                                </td>
                            </tr>
                        </table>
                    </div>

                </td>
            </tr>
        </table>

        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Flyttedetaljer</h4>
        ';

        if (!empty($moving_details['date'])) {
            $body .= '<p><strong>Ønsket dato:</strong> ' . $moving_details['date'] . '</p>';
        }
        if ($moving_details['flexibeldate'] == true) {
            $body .= '<p><strong>Fleksibel dato:</strong> Ja</p>';
        }

        if ($moving_details['extraservices'] == true || $moving_details['assembling'] == true || $moving_details['recycle'] == true || $moving_details['laundry'] == true) {
            $body .= '<p><strong>Tilleggstjenester:</strong></p>';
            if ($moving_details['packing'] == true) {
                $body .= '<p>Pakking</p>';
            }
            /*             if ($moving_details['packmaterials'] == true) {
                            $body .= '<p>Packaging materials</p>';
                        } */
            if ($moving_details['assembling'] == true) {
                $body .= '<p>Montering</p>';
            }
            if ($moving_details['recycle'] == true) {
                $body .= '<p>Gjenvinningsstasjon</p>';
            }
            if ($moving_details['laundry'] == true) {
                $body .= '<p>Renhold</p>';
            }
        }
        if (!empty($moving_details['notes'])) {
            $body .= '<p style="display:block;"><strong>Merknader:</strong></p>';
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
    $sent = wp_mail('eduardas@riktigflytting.no', 'Price quote - final form from ' . $client_infos['contactInfos']['name'], $body);
    if ($sent) {
        echo 'Email sent successfully!';
        $wpdb->delete(
            "{$wpdb->prefix}quote_emails",     // table name
            ['email_id' => $email_id],        // WHERE condition
            ['%s']                            // format for the condition
        );
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
    //    <p><strong>Navn:</strong> ' . htmlspecialchars($client_infos['contactInfos']['name']) . '</p>
    //    <p><strong>Phone:</strong> ' . htmlspecialchars($client_infos['contactInfos']['phone']) . '</p>
    //    <p><strong>Address:</strong> ' . htmlspecialchars($cleaningFormData['address']) . '</p>
    //    <p><strong>Size of home in sq m:</strong> ' . htmlspecialchars($cleaningFormData['size']) . '</p>
    //    <p><strong>Number of bathrooms:</strong> ' . htmlspecialchars($cleaningFormData['bathroomsnumber']) . '</p>
    //    <p><strong>Ønsket dato:</strong> ' . htmlspecialchars($cleaningFormData['date']) . '</p>
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
                <th align="left">E-post adresse</th>
                <th align="left">Navn</th>
                <th align="left">Telefon</th>
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
                <th align="left">Adresse</th>
                <th align="left">Størrelse I kvm</th>
                <th align="left">Antall bad</th>
                <th align="left">Ønsket dato</th>
                <th align="left">Beskrivelse</th>
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
    $sent = wp_mail('eduardas@riktigflytting.no', 'Price quote - final form from ' . $client_infos['contactInfos']['name'], $body);
    if ($sent) {
        echo 'Email sent successfully!';
    } else {
        echo 'Failed to send email.';
    }
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

/* TESTS USING DB */
add_action('wp_ajax_send_moving_quote_step_one_action_db', 'send_moving_quote_step_one_action_db');
add_action('wp_ajax_nopriv_send_moving_quote_step_one_action_db', 'send_moving_quote_step_one_action_db');

function send_moving_quote_step_one_action_db()
{
    global $wpdb;
    $client_infos = $_POST['clientInfos'];

    $email_id = $client_infos["contactInfos"]["emailId"];
    $email_row = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}quote_emails 
            WHERE email_id = %s AND service_type = %s AND property_type = %s AND email_status = %s",
            $email_id,
            'incomplete',
            $client_infos["serviceType"],
            $client_infos["propertyType"]
        )
    );
    if ($email_row == 0) {
        $wpdb->insert(
            "{$wpdb->prefix}quote_emails",
            [
                'email_id' => $client_infos["contactInfos"]["emailId"],
                'service_type' => $client_infos["serviceType"],
                'property_type' => $client_infos["propertyType"],
                'data_step_1' => json_encode($client_infos["contactInfos"], JSON_UNESCAPED_UNICODE),
                'data_step_2' => "",
                'data_step_3' => "",
                'email_status' => "incomplete",
                'created_at' => time()
            ],
            [
                '%s', // string
                '%s',  // string
                '%s',  // string
                '%s',  // string
                '%s',  // string
                '%s',  // string
                '%s',  // string
                '%s'  // string
            ]
        );
    } else {
        $wpdb->update(
            "{$wpdb->prefix}quote_emails",
            [
                'service_type' => $client_infos["serviceType"],
                'property_type' => $client_infos["propertyType"],
                'data_step_1' => json_encode($client_infos["contactInfos"], JSON_UNESCAPED_UNICODE),
                'data_step_2' => "",
                'data_step_3' => "",
                'email_status' => "incomplete"

            ],
            ['email_id' => $client_infos["contactInfos"]["emailId"]],    // where clause
            [
                '%s', // string
                '%s',  // string
                '%s',  // string
                '%s',  // string
                '%s',  // string
                '%s',  // string
                '%s'  // string
            ],
            ['%s']  // format for where
        );
    }

}

add_action('wp_ajax_send_moving_quote_step_two_action_db', 'send_moving_quote_step_two_action_db');
add_action('wp_ajax_nopriv_send_moving_quote_step_two_action_db', 'send_moving_quote_step_two_action_db');
function send_moving_quote_step_two_action_db()
{
    global $wpdb;
    $items_data = $_POST['itemsData'];
    $wpdb->update(
        "{$wpdb->prefix}quote_emails",
        [
            'data_step_2' => json_encode($items_data, JSON_UNESCAPED_UNICODE),
        ],
        [
            'email_id' => $_POST['sessionId'],
            'email_status' => 'incomplete'
        ],    // where clause
        [
            '%s', // string
        ],
        ['%s']  // format for where
    );
    echo $_POST['sessionId'];

}

// wget -q -O /dev/null "https://riktig.landingpage.lt/?do_cron=1&key=my_secret_123"
add_action('init', function () {
    if (isset($_GET['do_cron']) && $_GET['do_cron'] === '1' && $_GET['key'] === 'my_secret_123') {
        // Run your custom function
        my_custom_cron_function();

        // Optional response (helps for debugging)
        wp_die('Custom cron ran successfully');
    }
});

// Define the custom function
function my_custom_cron_function()
{
    // Your logic here (example: write to error log)
    //error_log('My Hostinger cron job zzz ran at ' . current_time('mysql'));
    global $wpdb;
    $cron_check_table = $wpdb->prefix . "cron_time_track";
    $emails_table = $wpdb->prefix . "quote_emails";
    //$row_count = $wpdb->get_var("SELECT * FROM $cron_check_table");
    $minutes = 5; // Replace from there options



    // check and get emails that are incomplete
    $incomplete_emails = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $emails_table WHERE email_status = %s", "incomplete")
    );
    if (count($incomplete_emails) > 0) {
        foreach ($incomplete_emails as $incomplete_email) {
            // check if diffence between now and created_at is equal or greater than 30mn
            if ((time() - $incomplete_email->created_at) >= ($minutes * 60)) {

                // Destroy session
                //$_SESSION = [];
                //session_unset();
                //session_destroy();
                //if (ini_get("session.use_cookies")) {
                //    $params = session_get_cookie_params();
                //    setcookie(
                //        session_name(),
                //        '',
                //        time() - 42000, // set cookie in the past
                //        $params["path"],
                //        $params["domain"],
                //        $params["secure"],
                //        $params["httponly"]
                //    );
                //}
                if ($incomplete_email->service_type == "moving") {
                    $data_step_1 = json_decode($incomplete_email->data_step_1);
                    $data_step_2 = json_decode($incomplete_email->data_step_2);
                    $property_type = $incomplete_email->property_type;
                    $service_type = $incomplete_email->service_type;

                    // Send email
                    send_moving_quote_email($data_step_1, $data_step_2, $property_type, $service_type);
                } elseif ($incomplete_email->service_type == "cleaning") {
                    $data_step_1 = json_decode($incomplete_email->data_step_1);
                    send_cleaning_quote_email($data_step_1);
                }

                // Update email status
                $wpdb->update(
                    $emails_table,
                    ['email_status' => "email_sent"],         // values to update
                    [
                        'email_id' => $incomplete_email->email_id,
                        'service_type' => $incomplete_email->service_type
                    ],                                // where clause
                    ['%s'],                           // format for values
                    ['%s']                            // format for where
                );
                exit;
            }

        }
    } else {
        echo "no email";
    }
    // remove the email ?

    // update the last_check column to now
    //$wpdb->update(
    //    $cron_check_table,
    //    ['last_check' => time()],         // values to update
    //    ['type' => "check_last_cron"],    // where clause
    //    ['%d'],                           // format for values
    //    ['%s']                            // format for where
    //);
    //} else {
    //    echo "Less than 5 minutes have passed.";
    //}


    // check the last time the cron was executed
    // if the difference between now and the last time is greater or equal than whatever the user has set in dashboard 
    // execute the function and update the last_check value
    // You can do more: send email, update DB, etc.
}
function send_moving_quote_email($data_step_1, $data_step_2, $property_type, $service_type)
{
    $client_infos = (array) $data_step_1;
    $items_data = $data_step_2;


    $service_type_nor = "";
    $property_type_nor = "";
    if ($service_type == "moving") {
        $service_type_nor = "Jeg trenger Flyttehjelp";
    } elseif ($service_type == "cleaning") {
        $service_type_nor = "Jeg trenger Vaskehjelp";
    }
    if ($property_type == "individual-home") {
        $property_type_nor = "Privat";
    } elseif ($property_type == "business") {
        $property_type_nor = "Bedrift";
    }

    $body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Kundehenvendelse</h2>
        <p><strong>Service:</strong> ' . ucfirst($service_type_nor) . '</p>
        <p><strong>Kundetype:</strong> ' . ucfirst($property_type_nor) . '</p>
        <p><strong>E-post adresse:</strong> ' . htmlspecialchars($client_infos['email']) . '</p>
        ';
    if ($property_type == "business") {
        $body .= ' 
        <p><strong>Firmanavn:</strong> ' . htmlspecialchars($client_infos['name']) . '</p>
        ';

    } elseif ($property_type == "individual-home") {
        $body .= ' 
        <p><strong>Navn:</strong> ' . htmlspecialchars($client_infos['name']) . '</p>
        ';
    }

    $body .= ' 
        <p><strong>Telefon:</strong> ' . htmlspecialchars($client_infos['phone']) . '</p>
    </div>
    ';

    if (!empty((array) $data_step_2)) {
        $body .= '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Flyttelista</h2>

        <table cellspacing="0" cellpadding="8" border="1" style="border-collapse: collapse; width: 100%;max-width:600px; margin-top: 10px;">
                <thead>
                <tr style="background-color: #f2f2f2;">
                    <th align="left">Vare</th>
                    <th align="right">Antall</th>
                    <th align="right">Vol (m³)</th>
                    <th align="right">Total Vol</th>
                </tr>
                </thead>
                <tbody>';

        $totalVolume = 0;
        foreach ($items_data as $label => $item) {
            $id = $item->id;
            $qty = (int) $item->quantity;
            $vol = (float) $item->volumePerItem;
            $total = round($qty * $vol, 2);
            $totalVolume += $total;

            $body .= "<tr>
                <td>" . str_replace('-', ' ', ucfirst($label)) . "</td>
                <td align='right'>{$qty}</td>
                <td align='right'>{$vol}</td>
                <td align='right'>{$total}</td>
            </tr>";
        }

        $body .= "<tr style='font-weight: bold; background-color: #fafafa;'>
                <td colspan='3' align='right'>Total volum:</td>
                <td align='right'>" . round($totalVolume, 2) . " m³</td>
            </tr>";

        $body .= '</tbody></table></div>';
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
    $sent = wp_mail('eduardas@riktigflytting.no', 'Moving quote - incomplete form - ' . $client_infos['name'], $body);
    if ($sent) {
        echo 'Email sent successfully!';
    } else {
        echo 'Failed to send email.';
    }
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

function send_cleaning_quote_email($data_step_1)
{
    $client_infos = (array) $data_step_1;

    $body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <h2 style="margin-bottom: 16px;color:#2f4c94;font-size:46px;">Cleaning quote</h2>

        <h4 style="font-size:32px;font-weight:400;color:#2f4c94;margin-bottom: 4px;margin-top: 0;">Client contact infos</h4>
        <table cellspacing="0" cellpadding="10" border="1" style="border-collapse: collapse;margin-bottom:20px;">
            <tr style="background-color: #f9f9f9;">
                <th align="left">E-post adresse</th>
                <th align="left">Navn</th>
                <th align="left">Telefon</th>
            </tr>
            <tr>
                <td>' . htmlspecialchars($client_infos['email']) . '</td>
                <td>' . htmlspecialchars($client_infos['name']) . '</td>
                <td>' . htmlspecialchars($client_infos['phone']) . '</td>
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
    $sent = wp_mail('eduardas@riktigflytting.no', 'Cleaning quote - incomplete form - ' . $client_infos['name'], $body);
    if ($sent) {
        echo 'Email sent successfully!';
    } else {
        echo 'Failed to send email.';
    }
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}
