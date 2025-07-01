<?php

/* SETTINGS PAGE */
function riktig_register_custom_settings_page()
{
    //add_options_page('Theme options', 'Theme options', 'manage_options', 'riktig-custom-settings-page', 'riktig_render_custom_settings_page', 0);
    add_menu_page(
        'Company Info',                  // Page title
        'Company Info',                  // Menu title
        'manage_options',                 // Capability
        'contacts_settings',    // Menu slug
        'contacts_settings_page_callback', // Function to display the page content
        'dashicons-admin-generic',        // Icon URL (can use a Dashicon)
        2                                // Position in the menu order
    );
}
add_action('admin_menu', 'riktig_register_custom_settings_page');

/*--------------------------*/
/*--------- HOME SLIDER ---------*/
/*--------------------------*/
function contacts_settings_page_callback()
{ ?>
    <style>
        .theme-options-wrapper {
            background-color: white;
            padding: 24px;
            margin: 24px;
            margin-left: 0;
            border-radius: 10px;
        }
    </style>
    <div class="theme-options-wrapper">
        <h1 style="margin-bottom: 32px;"><?php echo get_admin_page_title() ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('contacts_options'); // settings group name
            do_settings_sections('contacts_settings'); // just a page slug
            submit_button(); // "Save Changes" button
            ?>
        </form>
    </div>
<?php }

add_action('admin_init', 'riktig_theme_contact_options_fields');
function riktig_theme_contact_options_fields()
{
    // I created variables to make the things clearer
    $page_slug = 'contacts_settings';
    $option_group = 'contacts_options';

    // Section 1 : Categories colors
    add_settings_section(
        'contacts-options', // section ID
        '', // title (optional)
        'contacts_options_section', // callback function to display the section (optional)
        $page_slug
    );
    register_setting($option_group, 'company_name');
    register_setting($option_group, 'org_number');
    register_setting($option_group, 'address');
    register_setting($option_group, 'company_phone');
    register_setting($option_group, 'email_input');
}

function contacts_options_section()
{
?>
    <style>
        label {
            display: inline-block;
            width: 120px;
        }

        fieldset {
            margin-top: 40px;
            padding: 24px;
            border: 1px solid #d3d3d3;
            border-radius: 10px;
            margin-bottom: 20px;
            align-items: start;
        }
    </style>
    <div style="display: flex;flex-direction: column;gap: 20px;margin-bottom:40px;">
        <?php
        company_name();
        org_number();
        address();
        phone_input();
        email_input();
        ?>
    </div>
    <div>
        <?php

        ?>
    </div>
<?php }
function company_name()
{
    $company_name = get_option('company_name');
    echo "<div>";
    echo '<label>Company Name</label>';
    echo "<input id='company_name_input' name='company_name' type='text' value='" . esc_attr($company_name) . "' style='max-width: 500px;width: 100%;'/>";
    echo "</div>";
}
function org_number()
{
    $org_number = get_option('org_number');
    echo "<div>";
    echo '<label>Org Number</label>';
    echo "<input id='org_number_input' name='org_number' type='text' value='" . esc_attr($org_number) . "' style='max-width: 500px;width: 100%;'/>";
    echo "</div>";
}
function address()
{
    $address = get_option('address');
    echo "<div>";
    echo '<label>Address</label>';
    echo "<input id='address_input' name='address' type='text' value='" . esc_attr($address) . "' style='max-width: 500px;width: 100%;'/>";
    echo "</div>";
}

function phone_input()
{
    $company_phone = get_option('company_phone');
    echo "<div>";
    echo '<label>Phone</label>';
    echo "<input id='company_phone_input' name='company_phone' type='text' value='" . esc_attr($company_phone) . "' style='max-width: 500px;width: 100%;' />";
    echo "</div>";
}
function email_input()
{
    $email_input = get_option('email_input');
    echo "<div>";
    echo '<label>Email</label>';
    echo "<input id='email_input' name='email_input' type='email' value='" . esc_attr($email_input) . "' style='max-width: 200px;width: 100%;' />";
    echo "</div>";
}
