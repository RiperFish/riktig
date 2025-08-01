<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
    <?php wp_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Sen:wght@400..800&display=swap"
        rel="stylesheet">
    <!-- <link rel="icon" href="<?php echo RIKTIG_THEME_URI . '/assets/favicon.ico'; ?>" sizes="32x32">
    <link rel="apple-touch-icon" href="<?php echo RIKTIG_THEME_URI . '/assets/apple-touch-icon.png'; ?>">
    <link rel="manifest" href="<?php echo RIKTIG_THEME_URI . '/assets/riktig.webmanifest'; ?>"> -->

    <title>
        <?php
        //if (is_front_page()) {
        //    bloginfo('name') . "ézzz";
        //} elseif (is_tax('shop_category')) {
        //    echo bloginfo('name') . " - " . get_queried_object()->name;
        //} else {
        //    echo bloginfo('name') . " - " . (" " . get_the_title());
        //}
        ?>
    </title>
    <?php
    $dev_mode = getenv('DEV_MODE');
    if ($dev_mode == "staging") {
        echo '<script type="module" src="http://localhost:5173/@vite/client"></script>';
        echo '<script type="module" src="http://localhost:5173/resources/js/main.js"></script>';
    }
    ?>
    <?php
    $dev_mode = getenv('DEV_MODE');
    if ($dev_mode == "staging") { ?>

        <script type="text/javascript">
            var devMode = "staging"
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        </script>

    <?php } else {
        ; ?>
        <script type="text/javascript">
            var devMode = "production"
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        </script>
    <?php } ?>
</head>

<body <?php body_class(); ?>>
    <header class="sticky top-0 bg-white">
        <?php
        $get_quote_link = "";
        if (is_page_template('templates/about-us-template.php') || is_page_template('templates/contact-template.php')) {
            $get_quote_link = "#get-quote";
        } else {
            $get_quote_link = home_url() . "/#get-quote";
        }
        ?>
        <div class="header-content flex items-center px-9 py-7">
            <div class="logo mr-auto">
                <a href="<?php echo home_url(); ?>" aria-label="<?php bloginfo('name'); ?> Logo">
                    <img src="<?php echo URL_BASE; ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <a href="#" class="gap-1.5 items-center h-[45px] w-fit text-sm font-medium hidden"
                style="filter: brightness(0) invert(1);" id="phone-number">
                <img src="<?php echo URL_BASE; ?>/images/phone-blue.svg" alt="<?php bloginfo('name'); ?>">
                458-000-66
            </a>
            <nav id="menu" class=" mr-9">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary_menu',
                    'menu' => 'primary-nav',
                    'menu_class' => 'flex items-center gap-7'
                ]);
                ?>
                <li class="block md:hidden">
                    <a href="<?php echo $get_quote_link; ?>"
                        class="btn btn-primary items-center w-fit h-[45px] quote-btn hidden ">Get a
                        Quote
                    </a>
                </li>

            </nav>
            <div class="buttons flex items-center gap-4">
                <a href="#" class="btn btn-secondary flex gap-1.5 items-center h-[45px]" id="call-btn">
                    <img src="<?php echo URL_BASE; ?>/images/phone-blue.svg" alt="<?php bloginfo('name'); ?>">
                    458-000-66
                </a>

                <a href="<?php echo $get_quote_link; ?>"
                    class="btn btn-primary flex items-center w-fit h-[45px] quote-btn">
                    Get a Quote
                </a>
            </div>

        </div>
        <div class="icon mobile-menu-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div id="mobile-menu" style="display:none;">


            <nav id="" class=" mr-9">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary_menu',
                    'menu' => 'primary-nav',
                    'menu_class' => 'flex items-center gap-7'
                ]);
                ?>
            </nav>
        </div>
        <!--  -->
    </header>
    <main class=" flex-1">