<?php /* Template Name: Form template  */ ?>
<!DOCTYPE html>
<html class=" scroll-smooth" <?php language_attributes(); ?>>

<head>
    <?php wp_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
        echo '<script type="module" src="http://localhost:5173/@vite/client"></script>';
        echo '<script id="rikti-js-js" type="module" src="http://localhost:5173/resources/js/main.js"></script>';
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

<body <?php body_class(); ?> style="height: 100dvh;">
    <script>


    </script>
    <header class="relative mb-8 lg:mb-0">
        <div class="header-content flex items-center justify-between px-4 lg:px-9 !pr-4 lg:!pr-9 py-7 bg-[#2F4C94]">
            <div class="mr-auto flex items-center gap-[115px]">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>" aria-label="<?php bloginfo('name'); ?> Logo">
                        <img src="<?php echo URL_BASE; ?>/images/logo-white.svg" alt="<?php bloginfo('name'); ?>">
                    </a>
                </div>
                <div
                    class="form-stepper flex justify-between md:justify-center lg:justify-normal absolute -bottom-12 left-4 right-4 lg:relative lg:bottom-0 lg:right-0 lg:left-0  items-center md:gap-11">
                    <div class="flex gap-[15px] items-center stepper finished">
                        <svg class="stepper-contacts " width="27" height="27" viewBox="0 0 27 27" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.5 27C15.2728 27 17.0283 26.6508 18.6662 25.9724C20.3041 25.2939 21.7923 24.2995 23.0459 23.0459C24.2995 21.7923 25.2939 20.3041 25.9724 18.6662C26.6508 17.0283 27 15.2728 27 13.5C27 11.7272 26.6508 9.97167 25.9724 8.33377C25.2939 6.69588 24.2995 5.20765 23.0459 3.95406C21.7923 2.70047 20.3041 1.70606 18.6662 1.02763C17.0283 0.349188 15.2728 -2.64175e-08 13.5 0C9.91958 5.33525e-08 6.4858 1.42232 3.95406 3.95406C1.42232 6.4858 0 9.91958 0 13.5C0 17.0804 1.42232 20.5142 3.95406 23.0459C6.4858 25.5777 9.91958 27 13.5 27ZM13.152 18.96L20.652 9.96L18.348 8.04L11.898 15.7785L8.5605 12.4395L6.4395 14.5605L10.9395 19.0605L12.1005 20.2215L13.152 18.96Z"
                                fill="" />
                        </svg>
                        <span class="text-sm md:text-lg font-medium text-[#474747] lg:text-white ">
                            Contacts
                        </span>
                    </div>
                    <div class="flex gap-[15px] items-center stepper active" id="stepper-step2">
                        <svg class="stepper-contacts" width="27" height="27" viewBox="0 0 27 27" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.5 27C15.2728 27 17.0283 26.6508 18.6662 25.9724C20.3041 25.2939 21.7923 24.2995 23.0459 23.0459C24.2995 21.7923 25.2939 20.3041 25.9724 18.6662C26.6508 17.0283 27 15.2728 27 13.5C27 11.7272 26.6508 9.97167 25.9724 8.33377C25.2939 6.69588 24.2995 5.20765 23.0459 3.95406C21.7923 2.70047 20.3041 1.70606 18.6662 1.02763C17.0283 0.349188 15.2728 -2.64175e-08 13.5 0C9.91958 5.33525e-08 6.4858 1.42232 3.95406 3.95406C1.42232 6.4858 0 9.91958 0 13.5C0 17.0804 1.42232 20.5142 3.95406 23.0459C6.4858 25.5777 9.91958 27 13.5 27ZM13.152 18.96L20.652 9.96L18.348 8.04L11.898 15.7785L8.5605 12.4395L6.4395 14.5605L10.9395 19.0605L12.1005 20.2215L13.152 18.96Z"
                                fill="" />
                        </svg>
                        <span class="text-sm md:text-lg font-medium text-[#474747] lg:text-white ">
                            Details
                        </span>
                    </div>
                    <div class="flex gap-[15px] items-center stepper next" id="stepper-step3">
                        <svg class="stepper-contacts " width="27" height="27" viewBox="0 0 27 27" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.5 27C15.2728 27 17.0283 26.6508 18.6662 25.9724C20.3041 25.2939 21.7923 24.2995 23.0459 23.0459C24.2995 21.7923 25.2939 20.3041 25.9724 18.6662C26.6508 17.0283 27 15.2728 27 13.5C27 11.7272 26.6508 9.97167 25.9724 8.33377C25.2939 6.69588 24.2995 5.20765 23.0459 3.95406C21.7923 2.70047 20.3041 1.70606 18.6662 1.02763C17.0283 0.349188 15.2728 -2.64175e-08 13.5 0C9.91958 5.33525e-08 6.4858 1.42232 3.95406 3.95406C1.42232 6.4858 0 9.91958 0 13.5C0 17.0804 1.42232 20.5142 3.95406 23.0459C6.4858 25.5777 9.91958 27 13.5 27ZM13.152 18.96L20.652 9.96L18.348 8.04L11.898 15.7785L8.5605 12.4395L6.4395 14.5605L10.9395 19.0605L12.1005 20.2215L13.152 18.96Z"
                                fill="" />
                        </svg>
                        <span class="text-sm md:text-lg font-medium text-[#474747] lg:text-white ">
                            Address
                        </span>
                    </div>
                </div>
            </div>

            <div class="buttons flex items-center gap-4">
                <a href="#" class="btn btn-secondary text-white flex gap-1.5 items-center h-[45px]">
                    <img class=" brightness-0 invert-[1]" src="<?php echo URL_BASE; ?>/images/phone-blue.svg"
                        alt="<?php bloginfo('name'); ?>">
                    458-000-66
                </a>
            </div>
        </div>
    </header>
    <style>
        .step {
            transition: transform 0.5s ease, opacity 0.5s ease;
            position: absolute;
            width: 100%;
            opacity: 0;
            transform: translateX(100%);
            top: 0;
            left: 0;
        }

        .step.active {
            opacity: 1;
            transform: translateX(0);
            z-index: 1;
            position: relative;
        }
    </style>
    <main class=" flex-1">
        <section class=" py-12 h-full">
            <!-- Moving Container -->
            <div class="container h-full relative overflow-hidden" id="moving-container">
                <div class=" flex flex-col h-full step active" id="step1">
                    <h2 class=" mb-8">Things to move</h2>
                    <!-- Individual home items -->
                    <div class="mb-auto hidden md:grid-cols-2 lg:grid-cols-3 gap-y-[18px] w-full "
                        id="individualHomeItems">
                        <?php
                        echo "<div class='grid gap-y-[18px]'>";
                        render_item_block('sofa', 3, URL_BASE . '/images/form-icons/sofa.svg', 'Sofa');
                        render_item_block('coffee-table', 0.3, URL_BASE . '/images/form-icons/coffee-table.svg', 'Coffee table ');
                        render_item_block('tv-bench', 0.6, URL_BASE . '/images/form-icons/tv-bench.svg', 'TV bench');
                        render_item_block('tv', 0.5, URL_BASE . '/images/form-icons/tv.svg', 'TV');
                        render_item_block('display-cabinet', 1.5, URL_BASE . '/images/form-icons/display-cabinet.svg', 'Display cabinet');
                        render_item_block('sideboard', 0.6, URL_BASE . '/images/form-icons/sideboard.svg', 'Sideboard');
                        render_item_block('armchair', 0.6, URL_BASE . '/images/form-icons/arm-chair.svg', 'Armchair');
                        render_item_block('dining-table', 0.7, URL_BASE . '/images/form-icons/dining-table.svg', 'Dining table');
                        render_item_block('chair', 0.3, URL_BASE . '/images/form-icons/chair.svg', 'Chair');
                        render_item_block('bookshelf', 0.9, URL_BASE . '/images/form-icons/bookshelf.svg', 'Bookshelf');
                        echo "</div>";
                        echo "<div class='grid gap-y-[18px]'>";
                        render_item_block('desk', 0.8, URL_BASE . '/images/form-icons/desk.svg', 'Desk');
                        render_item_block('drawer-unit', 0.2, URL_BASE . '/images/form-icons/drawer-unit.svg', 'Drawer unit');
                        render_item_block('double-bed', 1.2, URL_BASE . '/images/form-icons/double-bed.svg', 'Double bed');
                        render_item_block('bed', 0.7, URL_BASE . '/images/form-icons/bed.svg', 'Bed');
                        render_item_block('nightstand', 0.2, URL_BASE . '/images/form-icons/nightstand.svg', 'Nightstand');
                        render_item_block('dresser', 2, URL_BASE . '/images/form-icons/dresser.svg', 'Dresser');
                        render_item_block('garderobeskap', 0.8, URL_BASE . '/images/form-icons/garderobeskap.svg', 'Garderobeskap'); // need volume
                        render_item_block('garden-furniture', 2.5, URL_BASE . '/images/form-icons/garden-furniture.svg', 'Garden furniture');
                        render_item_block('grill', 1, URL_BASE . '/images/form-icons/grill.svg', 'Grill');
                        render_item_block('washing-machine', 1, URL_BASE . '/images/form-icons/washing-machine.svg', 'Washing machine');

                        echo "</div>";
                        echo "<div class='grid gap-y-[18px]'>";
                        render_item_block('dryer', 1, URL_BASE . '/images/form-icons/dryer.svg', 'Dryer'); // need volume
                        render_item_block('refrigerator', 1.2, URL_BASE . '/images/form-icons/refrigerator.svg', 'Refrigerator');
                        render_item_block('stove', 1, URL_BASE . '/images/form-icons/stove.svg', 'Stove');
                        render_item_block('freezer', 2.2, URL_BASE . '/images/form-icons/freezer.svg', 'Freezer');
                        render_item_block('crib', 0.6, URL_BASE . '/images/form-icons/crib.svg', 'Crib');
                        render_item_block('piano', 100, URL_BASE . '/images/form-icons/piano.svg', 'Piano');
                        render_item_block('bicycle', 0.6, URL_BASE . '/images/form-icons/bicycle.svg', 'Bicycle');
                        render_item_block('moving-boxes', 0.1, URL_BASE . '/images/form-icons/moving-boxes.svg', 'Moving boxes');
                        render_item_block('bags-of-clothes', 0.2, URL_BASE . '/images/form-icons/bags-of-clothes.svg', 'Bags of clothes');
                        render_item_block('extra-cubic-meters', 1, URL_BASE . '/images/form-icons/extra-cubic-meters.svg', 'Extra cubic meters');
                        echo "</div>";
                        ?>
                    </div>
                    <!-- Business items -->
                    <div class="mb-auto hidden md:grid-cols-2 lg:grid-cols-3 gap-y-[18px] w-full " id="businessItems">
                        <?php
                        echo "<div class='grid gap-y-[18px]'>";
                        render_item_block('desk', 0.8, URL_BASE . '/images/form-icons/desk.svg', 'Desk');
                        render_item_block('office-chair', 0.8, URL_BASE . '/images/form-icons/office-chair.svg', 'Office chair');
                        render_item_block('drawer-unit', 0.2, URL_BASE . '/images/form-icons/drawer-unit.svg', 'Drawer unit');
                        render_item_block('it', 0.2, URL_BASE . '/images/form-icons/it.svg', 'IT utstyr');
                        render_item_block('pc-screen', 0.2, URL_BASE . '/images/form-icons/pc-screen.svg', 'Pc skjermer');
                        render_item_block('dining-table', 0.7, URL_BASE . '/images/form-icons/dining-table.svg', 'Dining table');
                        render_item_block('chair', 0.3, URL_BASE . '/images/form-icons/chair.svg', 'Chair');
                        render_item_block('display-cabinet', 1.5, URL_BASE . '/images/form-icons/display-cabinet.svg', 'Display cabinet');
                        render_item_block('sideboard', 0.6, URL_BASE . '/images/form-icons/sideboard.svg', 'Sideboard');
                        echo "</div>";
                        echo "<div class='grid gap-y-[18px]'>";
                        render_item_block('dresser', 2, URL_BASE . '/images/form-icons/dresser.svg', 'Dresser');
                        render_item_block('bookshelf', 0.9, URL_BASE . '/images/form-icons/bookshelf.svg', 'Bookshelf');
                        render_item_block('tall-desk', 0.9, URL_BASE . '/images/form-icons/tall-desk.svg', 'Høyt bord');
                        render_item_block('sofa', 3, URL_BASE . '/images/form-icons/sofa.svg', 'Sofa');
                        render_item_block('armchair', 0.6, URL_BASE . '/images/form-icons/arm-chair.svg', 'Armchair');
                        render_item_block('coffee-table', 0.3, URL_BASE . '/images/form-icons/coffee-table.svg', 'Coffee table ');
                        render_item_block('tv', 0.5, URL_BASE . '/images/form-icons/tv.svg', 'TV');
                        render_item_block('bilder', 0.5, URL_BASE . '/images/form-icons/bilder.svg', 'Bilder');
                        render_item_block('tavle', 0.5, URL_BASE . '/images/form-icons/tavle.svg', 'Tavle');
                        echo "</div>";
                        echo "<div class='grid gap-y-[18px]'>";
                        render_item_block('refrigerator', 1.2, URL_BASE . '/images/form-icons/refrigerator.svg', 'Refrigerator');
                        render_item_block('plantepott', 1.2, URL_BASE . '/images/form-icons/plant.svg', 'Plantepott');
                        render_item_block('printer', 1.2, URL_BASE . '/images/form-icons/printer.svg', 'Printer');
                        render_item_block('archive', 1.2, URL_BASE . '/images/form-icons/archive.svg', 'Arkivskap');
                        render_item_block('safe', 1.2, URL_BASE . '/images/form-icons/safe.svg', 'Safe');
                        render_item_block('garden-furniture', 2.5, URL_BASE . '/images/form-icons/garden-furniture.svg', 'Garden furniture');
                        render_item_block('stillepod', 2.5, URL_BASE . '/images/form-icons/stillepod.svg', 'Stillepod');
                        render_item_block('moving-boxes', 0.1, URL_BASE . '/images/form-icons/moving-boxes.svg', 'Moving boxes');
                        render_item_block('extra-cubic-meters', 1, URL_BASE . '/images/form-icons/extra-cubic-meters.svg', 'Extra cubic meters');
                        echo "</div>";
                        ?>
                    </div>
                    <div
                        class="bg-[#F7F7E0] px-10 py-8 md:py-5 rounded-[5px] flex flex-col gap-6 md:flex-row justify-between items-center w-full mt-24">
                        <div class="hidden lg:block"></div>
                        <div class=" text-2xl text-[#3D3D3D] font-bold">Volume: <span id="totalVolume">0</span> m³</div>
                        <style>
                            .next-btn {
                                color: white;
                                background-color: #2F4C94;
                                border-radius: 50px;
                                display: flex;
                                align-items: center;
                                gap: 22px;
                                /* padding-block: 12px 11px;*/
                                padding-inline: 66px 34px;
                                height: 59px;
                            }
                        </style>
                        <button onclick="goToBlock2()" class="cursor-pointer next-btn !text-2xl font-bold"
                            data-step="2">
                            <span>Next</span>
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.7159 3.51593C13.0034 3.22847 13.3933 3.06699 13.7999 3.06699C14.2065 3.06699 14.5965 3.22847 14.884 3.51593L21.784 10.4159C22.0715 10.7035 22.2329 11.0934 22.2329 11.5C22.2329 11.9066 22.0715 12.2965 21.784 12.5841L14.884 19.4841C14.5948 19.7634 14.2075 19.9179 13.8055 19.9144C13.4034 19.9109 13.0188 19.7497 12.7345 19.4654C12.4503 19.1811 12.289 18.7965 12.2855 18.3945C12.282 17.9924 12.4366 17.6051 12.7159 17.3159L16.8666 13.0333H2.29993C1.89327 13.0333 1.50326 12.8718 1.2157 12.5842C0.928149 12.2967 0.766602 11.9067 0.766602 11.5C0.766602 11.0933 0.928149 10.7033 1.2157 10.4158C1.50326 10.1282 1.89327 9.96666 2.29993 9.96666H16.8666L12.7159 5.68406C12.4284 5.39652 12.2669 5.00658 12.2669 4.59999C12.2669 4.19341 12.4284 3.80347 12.7159 3.51593Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="relative flex flex-col h-full step" id="step2">
                    <h2 class="mb-4">Address</h2>
                    <!-- Moving Home Address Container -->
                    <div id="movingHomeAddress">
                        <div class="flex flex-col gap:8 md:gap-10 lg:gap-[124px] md:flex-row  justify-between w-full">
                            <!-- Moving from -->
                            <div class=" max-w-[512px] w-full" id="movingFrom">
                                <h4 class="mb-5">Moving from</h4>
                                <div class="mb-5">
                                    <label for="" class="text-base lg:text-lg text-[#474747] mb-1 ">Address</label>
                                    <input type="text"
                                        class="w-full border border-[#CDCDCD] rounded-[3px] moving-field-required"
                                        id="moving-from-address">
                                </div>
                                <div class="flex flex-col gap-5 md:gap-[30px] mb-5">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Postal
                                            code</label>
                                        <input type="text"
                                            class="w-full border border-[#CDCDCD] rounded-[3px] moving-field-required"
                                            id="moving-from-postal-code">
                                    </div>
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Postal
                                            address</label>
                                        <input type="text"
                                            class="w-full border border-[#CDCDCD] rounded-[3px] moving-field-required"
                                            id="moving-from-postal-address">
                                    </div>
                                </div>
                                <div class="flex gap-[30px] mb-5 items-center ">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Building
                                            type</label>
                                        <select id="moving-from-building-type"
                                            class="w-full border border-[#CDCDCD] rounded-[3px]">
                                            <option value="home1">Home 1</option>
                                            <option value="home2">Home 2</option>
                                            <option value="home3">Home 3</option>
                                        </select>
                                    </div>
                                    <div class="flex flex-1 items-center gap-[14px] h-full mt-6">
                                        <input type="checkbox" id="moving-from-elevator">
                                        <label for="" class="text-base lg:text-lg text-[#474747]">Elevator</label>
                                    </div>
                                </div>
                                <div class="flex gap-[30px] mb-5">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Floor</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-from-floor">
                                    </div>
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Area</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-from-area">
                                    </div>
                                </div>
                                <div class="flex gap-[30px] mb-5">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Carrying
                                            distance</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-from-carry-distance">
                                    </div>
                                    <div class="flex-1">
                                    </div>
                                </div>
                            </div>
                            <!-- Moving to -->
                            <div class=" max-w-[512px] w-full" id="movingTo">
                                <h4 class="mb-5">Moving to</h4>
                                <div class="mb-5">
                                    <label for="" class="text-base lg:text-lg text-[#474747] mb-1 ">Address</label>
                                    <input type="text"
                                        class="w-full border border-[#CDCDCD] rounded-[3px] moving-field-required"
                                        id="moving-to-address">
                                </div>
                                <div class="flex flex-col gap-5 md:gap-[30px] mb-5">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1 ">Postal
                                            code</label>
                                        <input type="text"
                                            class="w-full border border-[#CDCDCD] rounded-[3px] moving-field-required"
                                            id="moving-to-postal-code">
                                    </div>
                                    <div class="flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1 ">Postal
                                            adress</label>
                                        <input type="text"
                                            class="w-full border border-[#CDCDCD] rounded-[3px] moving-field-required"
                                            id="moving-to-postal-address">
                                    </div>
                                </div>
                                <div class="flex gap-[30px] mb-5 items-center ">
                                    <div class="flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Building
                                            type</label>
                                        <select id="moving-to-building-type"
                                            class="w-full border border-[#CDCDCD] rounded-[3px]">
                                            <option value="home1">Home 1</option>
                                            <option value="home2">Home 2</option>
                                            <option value="home3">Home 3</option>
                                        </select>
                                    </div>
                                    <div class="flex flex-1 items-center gap-[14px] h-full mt-6">
                                        <input type="checkbox" id="moving-to-elevator">
                                        <label for="" class="text-base lg:text-lg text-[#474747]">Elevator</label>
                                    </div>
                                </div>
                                <div class="flex gap-[30px] mb-5">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Floor</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-to-floor">
                                    </div>
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Area</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-to-area">
                                    </div>
                                </div>
                                <div class="flex gap-[30px] mb-5">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Carrying
                                            distance</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-to-carry-distance">
                                    </div>
                                    <div class="flex-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Moving details -->
                        <div class=" w-full">
                            <h4 class="mb-4">Moving details</h4>
                            <div class="max-w-[512px] w-full mb-5" id="movingDetails">
                                <div class="flex gap-[30px] items-center ">
                                    <div class="flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Desired
                                            date</label>
                                        <input type="date" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-date">
                                    </div>
                                    <div class="flex flex-1 items-center gap-[14px] h-full mt-6">
                                        <input type="checkbox" id="moving-flexible-date">
                                        <label for="" class="text-base lg:text-lg text-[#474747]">Flexible date</label>
                                    </div>
                                </div>
                            </div>
                            <label for="" class="text-base lg:text-lg text-[#474747] mb-5 block">Extra services:</label>
                            <div class="grid md:grid-cols-2 gap-2 lg:flex lg:gap-[34px] items-center mb-5">
                                <div class="flex items-center gap-[14px]">
                                    <input type="checkbox" id="moving-service-packing" class="extra-service">
                                    <label for="" class="text-base lg:text-lg text-[#474747]">Packing</label>
                                </div>
                                <div class="flex items-center gap-[14px]">
                                    <input type="checkbox" id="moving-service-pack-materials" class="extra-service">
                                    <label for="" class="text-base lg:text-lg text-[#474747]">Packaging
                                        materials</label>
                                </div>
                                <div class="flex items-center gap-[14px]">
                                    <input type="checkbox" id="moving-service-assembling" class="extra-service">
                                    <label for="" class="text-base lg:text-lg text-[#474747]">Assembeling</label>
                                </div>
                                <div class="flex items-center gap-[14px]">
                                    <input type="checkbox" id="moving-service-recycle" class="extra-service">
                                    <label for="" class="text-base lg:text-lg text-[#474747]">Recycle station</label>
                                </div>
                                <div class="flex items-center gap-[14px]">
                                    <input type="checkbox" id="moving-service-laundry" class="extra-service">
                                    <label for="" class="text-base lg:text-lg text-[#474747]">Flyttevask</label>
                                </div>
                            </div>
                            <div class="max-w-[512px]">
                                <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Moving notes (eg. heavy
                                    things)</label>
                                <textarea name="" id="moving-notes"
                                    class="w-full border border-[#CDCDCD] rounded-[3px] px-3 py-2" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Moving Business Address Container -->
                    <div id="movingBusinessAddress">
                        <div class="flex flex-col gap:8 md:gap-10 lg:gap-[124px] md:flex-row  justify-between w-full">
                            <!-- Moving from -->
                            <div class=" max-w-[512px] w-full" id="movingFrom">
                                <h4 class="mb-5">Moving from</h4>
                                <div class="mb-5">
                                    <label for="" class="text-base lg:text-lg text-[#474747] mb-1 ">Address</label>
                                    <input type="text"
                                        class="w-full border border-[#CDCDCD] rounded-[3px] moving-field-required"
                                        id="moving-from-address">
                                </div>
                                <div class="flex flex-col gap-5 md:gap-[30px] mb-5">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Area in square
                                            meters</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-business-from-area">
                                    </div>
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Floor</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-business-from-floor">
                                    </div>
                                </div>
                                <div class="flex gap-[30px] mb-5 items-center ">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Carrying
                                            distance</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px] "
                                            id="moving-business-from-carry-distance">
                                    </div>
                                    <div class="flex flex-1 items-center gap-[14px] h-full mt-6">
                                        <input type="checkbox" id="moving-from-elevator">
                                        <label for="" class="text-base lg:text-lg text-[#474747]">Elevator</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Moving to -->
                            <div class=" max-w-[512px] w-full" id="movingFrom">
                                <h4 class="mb-5">Moving to</h4>
                                <div class="mb-5">
                                    <label for="" class="text-base lg:text-lg text-[#474747] mb-1 ">Address</label>
                                    <input type="text"
                                        class="w-full border border-[#CDCDCD] rounded-[3px] moving-field-required"
                                        id="moving-to-address">
                                </div>
                                <div class="flex flex-col lg:flex-row gap-5 md:gap-[30px] mb-5">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Area in square
                                            meters</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-business-to-area">
                                    </div>
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Floor</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-business-to-floor">
                                    </div>
                                </div>
                                <div class="flex gap-[30px] mb-5 items-center ">
                                    <div class=" flex-1">
                                        <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Carrying
                                            distance</label>
                                        <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                            id="moving-business-to-carry-distance">
                                    </div>
                                    <div class="flex flex-1 items-center gap-[14px] h-full mt-6">
                                        <input type="checkbox" id="moving-to-elevator">
                                        <label for="" class="text-base lg:text-lg text-[#474747]">Elevator</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-[30px] md:items-center mb-5">
                            <div class="max-w-[512px] flex flex-col md:flex-row gap-[30px]">
                                <div class=" flex-1">
                                    <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Employees to
                                        relocate</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                        id="moving-business-employees">
                                </div>
                                <div class="flex-1">
                                    <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Desired date</label>
                                    <input type="date" class="w-full border border-[#CDCDCD] rounded-[3px]"
                                        id="moving-date">
                                </div>
                            </div>
                            <div class="flex flex-1 items-center gap-[14px] h-full md:mt-6">
                                <input type="checkbox" id="moving-business-flexibale-date">
                                <label for="" class="text-lg text-[#474747]">Flexible date</label>
                            </div>
                        </div>
                        <label for="" class="text-base lg:text-lg text-[#474747] mb-5 block">Extra services:</label>
                        <div class="grid md:grid-cols-2 gap-2 lg:flex lg:gap-[34px] items-center mb-5">
                            <div class="flex items-center gap-[14px] w-fit">
                                <input type="checkbox" id="moving-service-packing" class="extra-service">
                                <label for="" class="text-base lg:text-lg text-[#474747]">Packing</label>
                            </div>
                            <div class="flex items-center gap-[14px] w-fit">
                                <input type="checkbox" id="moving-service-pack-materials" class="extra-service">
                                <label for="" class="text-base lg:text-lg text-[#474747]">Packaging materials</label>
                            </div>
                            <div class="flex items-center gap-[14px] w-fit">
                                <input type="checkbox" id="moving-service-assembling" class="extra-service">
                                <label for="" class="text-base lg:text-lg text-[#474747]">Assembeling</label>
                            </div>
                            <div class="flex items-center gap-[14px] w-fit">
                                <input type="checkbox" id="moving-service-recycle" class="extra-service">
                                <label for="" class="text-base lg:text-lg text-[#474747]">Recycle station</label>
                            </div>
                            <div class="flex items-center gap-[14px] w-fit">
                                <input type="checkbox" id="moving-service-laundry" class="extra-service">
                                <label for="" class="text-base lg:text-lg text-[#474747]">Flyttevask</label>
                            </div>
                        </div>
                        <div>
                            <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Moving notes (eg. heavy
                                things)</label>
                            <textarea name="" id="moving-notes"
                                class="w-full border border-[#CDCDCD] rounded-[3px] px-3 py-2" rows="3"></textarea>
                        </div>
                    </div>
                    <!-- FOMR FOOTER -->
                    <div id="moving-form-footer"
                        class="bg-[#F7F7E0] px-10 py-5 md:py-5 rounded-[5px] flex flex-col gap-6 lg:flex-row justify-between items-center mt-[30px] relative w-full">
                        <div class="hidden lg:block"></div>
                        <div
                            class="text-2xl text-[#3D3D3D] font-bold relative text-center lg:absolute lg:text-left w-full lg:w-auto left-1/2 -translate-x-1/2">
                            You are only
                            one click away!</div>
                        <button onclick="submitMovingForm()" id="send-moving-quote"
                            class="cursor-pointer next-btn !text-2xl font-bold">
                            <span>Submit</span> <!-- -->
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.7159 3.51593C13.0034 3.22847 13.3933 3.06699 13.7999 3.06699C14.2065 3.06699 14.5965 3.22847 14.884 3.51593L21.784 10.4159C22.0715 10.7035 22.2329 11.0934 22.2329 11.5C22.2329 11.9066 22.0715 12.2965 21.784 12.5841L14.884 19.4841C14.5948 19.7634 14.2075 19.9179 13.8055 19.9144C13.4034 19.9109 13.0188 19.7497 12.7345 19.4654C12.4503 19.1811 12.289 18.7965 12.2855 18.3945C12.282 17.9924 12.4366 17.6051 12.7159 17.3159L16.8666 13.0333H2.29993C1.89327 13.0333 1.50326 12.8718 1.2157 12.5842C0.928149 12.2967 0.766602 11.9067 0.766602 11.5C0.766602 11.0933 0.928149 10.7033 1.2157 10.4158C1.50326 10.1282 1.89327 9.96666 2.29993 9.96666H16.8666L12.7159 5.68406C12.4284 5.39652 12.2669 5.00658 12.2669 4.59999C12.2669 4.19341 12.4284 3.80347 12.7159 3.51593Z"
                                    fill="white" />
                            </svg>
                        </button>

                    </div>
                </div>
                <!-- Thank you screen -->
                <div class="relative flex flex-col h-full step" id="step3">
                    <h2 class=" mb-8">Thank you</h2>
                    <div
                        class="thank-you-container bg-[#EFFFF3] w-full pt-[58px] pb-[46px] flex flex-col items-center justify-center rounded-[5px]">
                        <svg class="mb-[30px]" width="83" height="83" viewBox="0 0 83 83" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M41.5 83C46.9499 83 52.3464 81.9266 57.3814 79.841C62.4164 77.7554 66.9913 74.6986 70.8449 70.8449C74.6986 66.9913 77.7554 62.4164 79.841 57.3814C81.9266 52.3464 83 46.9499 83 41.5C83 36.0501 81.9266 30.6537 79.841 25.6186C77.7554 20.5836 74.6986 16.0087 70.8449 12.1551C66.9913 8.30144 62.4164 5.24457 57.3814 3.159C52.3464 1.07343 46.9499 -8.12092e-08 41.5 0C30.4935 1.64009e-07 19.9378 4.37231 12.1551 12.1551C4.37231 19.9378 0 30.4935 0 41.5C0 52.5065 4.37231 63.0622 12.1551 70.8449C19.9378 78.6277 30.4935 83 41.5 83ZM40.4302 58.2844L63.4858 30.6178L56.4031 24.7156L36.5753 48.5043L26.3156 38.2399L19.7955 44.7601L33.6288 58.5934L37.1978 62.1624L40.4302 58.2844Z"
                                fill="#34A853" />
                        </svg>
                        <span class=" text-2xl text-[#3D3D3D] font-bold">We will get back to you soon!</span>
                    </div>
                </div>
            </div>
            <!-- Cleaning Container -->
            <div class="container h-full relative overflow-hidden flex-col hidden" id="cleaning-container">
                <div class="flex flex-col-reverse gap-10 md:flex-row-reverse justify-between step active mb-auto"
                    id="cleaning-step2">
                    <div class="max-w-[590px]">
                        <h4 class="max-w-[420px] mb-[26px]">Standard moving cleaning includes:</h4>
                        <div class="template-more-content list-check">
                            <?php
                            $args = [
                                'post_type' => 'page',
                                'meta_key' => '_wp_page_template',
                                'meta_value' => 'templates/cleaning-service-template.php',
                                'posts_per_page' => 1,          // only need one
                            ];
                            $pages = get_posts($args);

                            $cleaning_moving_includes = get_field('hero_section', $pages[0]->ID)['editor'];
                            echo $cleaning_moving_includes;
                            ?>
                        </div>
                    </div>
                    <div class="max-w-[512px] w-full">
                        <h2 class="mb-4">Details</h2>
                        <div class="mb-5 w-full">
                            <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Address</label>
                            <input type="text" id="cleaning-address"
                                class="w-full border border-[#CDCDCD] rounded-[3px] cleaning-field-required">
                        </div>
                        <div class="flex gap-[30px] mb-5">
                            <div class=" flex-1">
                                <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Size of home in sq
                                    m</label>
                                <input type="text" id="cleaning-size"
                                    class="w-full border border-[#CDCDCD] rounded-[3px]">
                            </div>
                            <div class=" flex-1">
                                <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Number of
                                    bathrooms</label>
                                <input type="text" id="cleaning-bathrooms-num"
                                    class="w-full border border-[#CDCDCD] rounded-[3px]">
                            </div>
                        </div>
                        <div class="flex gap-[30px] mb-5">
                            <div class="flex-1">
                                <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Desired date</label>
                                <input type="date" id="cleaning-date"
                                    class="w-full border border-[#CDCDCD] rounded-[3px]">
                            </div>
                            <div class=" flex-1"></div>
                        </div>
                        <div class="max-w-[512px]">
                            <label for="" class="text-base lg:text-lg text-[#474747] mb-1">Notes</label>
                            <textarea name="" id="cleaning-notes"
                                class="w-full border border-[#CDCDCD] rounded-[3px] px-3 py-2" rows="3"></textarea>
                        </div>
                    </div>

                </div>
                <div class="relative flex flex-col h-full step" id="cleaning-step3">
                    <h2 class=" mb-8">Thank you</h2>
                    <div
                        class="thank-you-container bg-[#EFFFF3] w-full pt-[58px] pb-[46px] flex flex-col items-center justify-center rounded-[5px]">
                        <svg class="mb-[30px]" width="83" height="83" viewBox="0 0 83 83" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M41.5 83C46.9499 83 52.3464 81.9266 57.3814 79.841C62.4164 77.7554 66.9913 74.6986 70.8449 70.8449C74.6986 66.9913 77.7554 62.4164 79.841 57.3814C81.9266 52.3464 83 46.9499 83 41.5C83 36.0501 81.9266 30.6537 79.841 25.6186C77.7554 20.5836 74.6986 16.0087 70.8449 12.1551C66.9913 8.30144 62.4164 5.24457 57.3814 3.159C52.3464 1.07343 46.9499 -8.12092e-08 41.5 0C30.4935 1.64009e-07 19.9378 4.37231 12.1551 12.1551C4.37231 19.9378 0 30.4935 0 41.5C0 52.5065 4.37231 63.0622 12.1551 70.8449C19.9378 78.6277 30.4935 83 41.5 83ZM40.4302 58.2844L63.4858 30.6178L56.4031 24.7156L36.5753 48.5043L26.3156 38.2399L19.7955 44.7601L33.6288 58.5934L37.1978 62.1624L40.4302 58.2844Z"
                                fill="#34A853" />
                        </svg>
                        <span class=" text-2xl text-[#3D3D3D] font-bold">We will get back to you soon!</span>
                    </div>
                </div>
                <div id="cleaning-form-footer"
                    class="bg-[#F7F7E0] px-10 py-5 md:py-5 rounded-[5px] flex flex-col gap-6 lg:flex-row justify-between items-center mt-[30px] relative w-full">
                    <div class="hidden lg:block"></div>
                    <div
                        class="text-2xl text-[#3D3D3D] font-bold relative text-center lg:absolute lg:text-left w-full lg:w-auto left-1/2 -translate-x-1/2">
                        You are only one
                        click away!</div>
                    <button onclick="submitCleaningForm()" id="send-cleaning-quote"
                        class="cursor-pointer next-btn !text-2xl font-bold">
                        <span>Submit</span>
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.7159 3.51593C13.0034 3.22847 13.3933 3.06699 13.7999 3.06699C14.2065 3.06699 14.5965 3.22847 14.884 3.51593L21.784 10.4159C22.0715 10.7035 22.2329 11.0934 22.2329 11.5C22.2329 11.9066 22.0715 12.2965 21.784 12.5841L14.884 19.4841C14.5948 19.7634 14.2075 19.9179 13.8055 19.9144C13.4034 19.9109 13.0188 19.7497 12.7345 19.4654C12.4503 19.1811 12.289 18.7965 12.2855 18.3945C12.282 17.9924 12.4366 17.6051 12.7159 17.3159L16.8666 13.0333H2.29993C1.89327 13.0333 1.50326 12.8718 1.2157 12.5842C0.928149 12.2967 0.766602 11.9067 0.766602 11.5C0.766602 11.0933 0.928149 10.7033 1.2157 10.4158C1.50326 10.1282 1.89327 9.96666 2.29993 9.96666H16.8666L12.7159 5.68406C12.4284 5.39652 12.2669 5.00658 12.2669 4.59999C12.2669 4.19341 12.4284 3.80347 12.7159 3.51593Z"
                                fill="white" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>
        <script>
            //window.addEventListener('DOMContentLoaded', () => {
            const clientInfos = sessionStorage.getItem('clientInfos');
            const propertyType = JSON.parse(clientInfos).propertyType;
            const serviceType = JSON.parse(clientInfos).serviceType;
            if (clientInfos) {
                //const propertyType = 

                if (serviceType === "moving") {
                    if (propertyType === 'business') {
                        //document.getElementById('individualHomeItems').style.display = 'none';
                        //document.getElementById('movingHomeAddress').style.display = 'none';
                        document.getElementById('individualHomeItems').remove()
                        document.getElementById('movingHomeAddress').remove()


                        document.getElementById('businessItems').style.display = 'grid';
                        document.getElementById('movingBusinessAddress').style.display = 'grid';

                    } else if (propertyType === 'individual-home') {
                        //document.getElementById('businessItems').style.display = 'none';
                        //document.getElementById('movingBusinessAddress').style.display = 'none';
                        document.getElementById('businessItems').remove()
                        document.getElementById('movingBusinessAddress').remove()


                        document.getElementById('individualHomeItems').style.display = 'grid';
                        document.getElementById('movingHomeAddress').style.display = 'grid';
                    }
                } else {
                    document.getElementById('moving-container').style.display = 'none';
                    document.getElementById('cleaning-container').style.display = 'flex';
                    document.getElementById('stepper-step3').style.display = 'none';
                }

            }
            //});
            function changeQty(button, delta) {
                const item = button.closest('.item');
                const qtySpan = item.querySelector('.qty');
                let qty = parseInt(qtySpan.textContent);
                qty = Math.max(0, qty + delta);
                qtySpan.textContent = qty;
                updateTotalVolume();
            }

            function updateTotalVolume() {
                let total = 0;
                document.querySelectorAll('.item').forEach(item => {
                    const qty = parseInt(item.querySelector('.qty').textContent);
                    const vol = parseFloat(item.dataset.volume);
                    total += qty * vol;
                });
                total = Math.round(total * 100) / 100;
                document.getElementById('totalVolume').textContent = total;
            }

            let finalVolume = 0
            const stepperStep2 = document.querySelector('#stepper-step2')
            const stepperStep3 = document.querySelector('#stepper-step3')

            function goToBlock2() {
                document.getElementById('step1').classList.remove('active');
                document.getElementById('step2').classList.add('active');

                setTimeout(() => {
                    jQuery("html").scrollTop(150);
                }, 400);
                const items = document.querySelectorAll(".item");
                let itemsData = {};

                items.forEach((item) => {
                    const id = item.dataset.id;
                    const volume = parseFloat(item.dataset.volume);
                    const qty = parseInt(item.querySelector(".qty").textContent);
                    if (qty > 0) {
                        itemsData[id] = {
                            quantity: qty,
                            volumePerItem: volume,
                            totalVolume: Math.round(qty * volume * 100) / 100,
                        };
                    }
                });
                // Store in sessionStorage (client-side)
                sessionStorage.setItem("itemsData", JSON.stringify(itemsData));


                finalVolume = document.querySelector('#totalVolume').textContent
                console.log(finalVolume);

                if (finalVolume > 0) {
                    const clientInfos = JSON.parse(sessionStorage.getItem('clientInfos'))

                    jQuery.ajax({
                        url: ajaxurl,
                        type: "POST",
                        data: {
                            action: "send_moving_quote_step_two_action",
                            //nonce: my_ajax_object.nonce,
                            clientInfos: clientInfos,
                            itemsData: itemsData,
                        },
                        success: function (response) {
                            console.log("Server response:", response);
                        },
                    });
                }
                stepperStep2.classList.remove('active')
                stepperStep2.classList.add('finished')
                stepperStep3.classList.add('active')
                stepperStep3.classList.remove('next')
            }

            function cleanObject(obj) {
                const result = {};
                for (const key in obj) {
                    const val = obj[key];
                    if (val !== '' && val !== false) {
                        result[key] = val;
                    }
                }
                return result;
            }

            function isValidAddress(addr) {
                const trimmed = addr.trim();
                const re = /^[A-Za-z0-9\s\.,\-#]{3,}$/;
                return re.test(trimmed);
            }

            const allCleaningRequiredFields = document.querySelectorAll('.cleaning-field-required');
            const requiredCleaningFields = Array.from(allCleaningRequiredFields)
                .filter(el => el.offsetParent !== null);
            requiredCleaningFields.forEach(requiredField => {
                requiredField.addEventListener('keyup', () => {
                    if (requiredField.value.trim() != '' && isValidAddress(requiredField.value)) {
                        requiredField.style.borderColor = "#CDCDCD"
                        requiredField.previousElementSibling.style.color = '#474747';
                    } else {
                        stepOneReady = false
                        requiredField.style.borderColor = "#FF0000"
                        requiredField.previousElementSibling.style.color = '#FF0000';
                    }
                })
            });

            function submitCleaningForm() {
                const clientInfos = JSON.parse(sessionStorage.getItem('clientInfos'))

                requiredCleaningFields.forEach(requiredField => {
                    if (requiredField.value.trim() != '' && isValidAddress(requiredField.value)) {
                        requiredField.style.borderColor = "#CDCDCD"
                        requiredField.previousElementSibling.style.color = '#474747';
                    } else {
                        stepOneReady = false
                        jQuery("html").scrollTop(150);
                        requiredField.style.borderColor = "#FF0000"
                        requiredField.previousElementSibling.style.color = '#FF0000';
                    }
                });

                const allFilled = [...requiredCleaningFields].every(requiredField => requiredField.value.trim() !== '' && isValidAddress(requiredField.value.trim()));
                if (allFilled) {

                    let finalFormObject = {}
                    const cleaningFormData = {
                        address: document.querySelector('#cleaning-address').value,
                        size: document.querySelector('#cleaning-size').value,
                        bathroomsnumber: document.querySelector('#cleaning-bathrooms-num').value,
                        date: document.querySelector('#cleaning-date').value,
                        notes: document.querySelector('#cleaning-notes').value,
                    }
                    finalFormObject.clientInfos = clientInfos
                    finalFormObject.cleaningFormData = cleaningFormData

                    jQuery.ajax({
                        url: ajaxurl,
                        type: "POST",
                        data: {
                            action: "send_cleaning_quote_final_action",
                            //nonce: my_ajax_object.nonce,
                            finalFormObject: finalFormObject,
                        },
                        success: function (response) {
                            console.log("Server response:", response);
                            stepperStep2.classList.remove('active')
                            stepperStep2.classList.add('finished')

                            document.getElementById('cleaning-step2').classList.remove('active');
                            document.getElementById('cleaning-step3').classList.add('active');
                            document.getElementById('cleaning-form-footer').style.display = 'none';
                        },
                    });
                }
            }


            const allMovingRequiredFields = document.querySelectorAll('.moving-field-required');
            const requiredMovingFields = Array.from(allMovingRequiredFields)
                .filter(el => el.offsetParent !== null);

            requiredMovingFields.forEach(requiredField => {
                requiredField.addEventListener('keyup', () => {
                    if (requiredField.value.trim() != '' && isValidAddress(requiredField.value)) {
                        requiredField.style.borderColor = "#CDCDCD"
                        requiredField.previousElementSibling.style.color = '#474747';
                    } else {
                        stepOneReady = false
                        jQuery("html").scrollTop(150);
                        requiredField.style.borderColor = "#FF0000"
                        requiredField.previousElementSibling.style.color = '#FF0000';
                    }
                })

            });
            function submitMovingForm() {

                const clientInfos = JSON.parse(sessionStorage.getItem('clientInfos'))
                const itemsData = JSON.parse(sessionStorage.getItem('itemsData'))

                /* Moving from required fields */
                let movingFromAddress = document.querySelector('#moving-from-address')
                let movingFromPostalCode = document.querySelector('#moving-from-postal-code')
                let movingFromPostalAddress = document.querySelector('#moving-from-postal-address')
                /* Moving to required fields */
                let movingToAddress = document.querySelector('#moving-to-address')
                let movingToPostalCode = document.querySelector('#moving-to-postal-code')
                let movingToPostalAddress = document.querySelector('#moving-to-postal-address')



                requiredMovingFields.forEach(requiredField => {
                    if (requiredField.value.trim() != '' && isValidAddress(requiredField.value)) {
                        requiredField.style.borderColor = "#CDCDCD"
                        requiredField.previousElementSibling.style.color = '#474747';
                    } else {
                        stepOneReady = false
                        jQuery("html").scrollTop(150);
                        requiredField.style.borderColor = "#FF0000"
                        requiredField.previousElementSibling.style.color = '#FF0000';
                    }
                });

                const allFilled = [...requiredMovingFields].every(requiredField => requiredField.value.trim() !== '' && isValidAddress(requiredField.value.trim()));
                if (allFilled) {
                    let finalFormObject = {}
                    let initialMovingFrom = {}
                    let initialMovingTo = {}
                    let initialMovingDetails = {}
                    if (propertyType === 'business') {
                        initialMovingFrom = {
                            address: movingFromAddress.value,
                            area: document.querySelector('#moving-business-from-area').value,
                            floor: document.querySelector('#moving-business-from-floor').value,
                            carrydistance: document.querySelector('#moving-business-from-carry-distance').value,
                            elevator: document.querySelector('#moving-from-elevator').checked,
                        }
                        initialMovingTo = {
                            address: movingToAddress.value,
                            area: document.querySelector('#moving-business-to-area').value,
                            floor: document.querySelector('#moving-business-to-floor').value,
                            carrydistance: document.querySelector('#moving-business-to-carry-distance').value,
                            elevator: document.querySelector('#moving-to-elevator').checked,
                        }
                        initialMovingDetails = {
                            employees: document.querySelector('#moving-business-employees').value,
                            date: document.querySelector('#moving-date').value,
                            flexibeldate: document.querySelector('#moving-business-flexibale-date').checked,
                            packing: document.querySelector('#moving-service-packing').checked,
                            packmaterials: document.querySelector('#moving-service-pack-materials').checked,
                            assembling: document.querySelector('#moving-service-assembling').checked,
                            recycle: document.querySelector('#moving-service-recycle').checked,
                            laundry: document.querySelector('#moving-service-laundry').checked,
                            notes: document.querySelector('#moving-notes').value,
                        }
                    } else if (propertyType === 'individual-home') {
                        initialMovingFrom = {
                            address: movingFromAddress.value,
                            postalcode: movingFromPostalCode.value,
                            postaladdress: movingFromPostalAddress.value,
                            buildingtype: document.querySelector('#moving-from-building-type').value,
                            elevator: document.querySelector('#moving-from-elevator').checked,
                            floor: document.querySelector('#moving-from-floor').value,
                            area: document.querySelector('#moving-from-area').value,
                            carrydistance: document.querySelector('#moving-from-carry-distance').value,
                        }
                        initialMovingTo = {
                            address: movingToAddress.value,
                            postalcode: movingToPostalCode.value,
                            postaladdress: movingToPostalAddress.value,
                            buildingtype: document.querySelector('#moving-to-building-type').value,
                            elevator: document.querySelector('#moving-to-elevator').checked,
                            floor: document.querySelector('#moving-to-floor').value,
                            area: document.querySelector('#moving-to-area').value,
                            carrydistance: document.querySelector('#moving-to-carry-distance').value,
                        }
                        initialMovingDetails = {
                            date: document.querySelector('#moving-date').value,
                            flexibeldate: document.querySelector('#moving-flexible-date').checked,
                            packing: document.querySelector('#moving-service-packing').checked,
                            packmaterials: document.querySelector('#moving-service-pack-materials').checked,
                            assembling: document.querySelector('#moving-service-assembling').checked,
                            recycle: document.querySelector('#moving-service-recycle').checked,
                            laundry: document.querySelector('#moving-service-laundry').checked,
                            notes: document.querySelector('#moving-notes').value,
                        }
                    }
                    if (finalVolume > 0) {
                        finalFormObject.itemsData = itemsData
                    }
                    finalFormObject.clientInfos = clientInfos

                    const movingFrom = cleanObject(initialMovingFrom);
                    const movingTo = cleanObject(initialMovingTo);
                    const movingDetails = cleanObject(initialMovingDetails);

                    finalFormObject.movingFrom = movingFrom
                    finalFormObject.movingTo = movingTo
                    finalFormObject.movingDetails = movingDetails

                    jQuery.ajax({
                        url: ajaxurl,
                        type: "POST",
                        data: {
                            action: "send_moving_quote_final_action",
                            //nonce: my_ajax_object.nonce,
                            finalFormObject: finalFormObject,
                        },
                        success: function (response) {
                            console.log("Server response:", response);
                            document.getElementById('step1').classList.remove('active');
                            document.getElementById('step2').classList.remove('active');
                            document.getElementById('step3').classList.add('active');
                            stepperStep3.classList.remove('active')
                            stepperStep3.classList.add('finished')
                            document.getElementById('moving-form-footer').style.display = 'none';
                        },
                    });
                }
            }


        </script>
        <?php get_footer(); ?>