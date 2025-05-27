<?php /* Template Name: Form template  */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php wp_head(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Sen:wght@400..800&display=swap" rel="stylesheet">
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

    <?php } else {; ?>
        <script type="text/javascript">
            var devMode = "production"
        </script>
    <?php } ?>
</head>

<body <?php body_class(); ?>>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const clientInfos = sessionStorage.getItem('clientInfos');

            if (clientInfos) {
                const propertyType = JSON.parse(clientInfos).propertyType;
                const serviceType = JSON.parse(clientInfos).serviceType;
                if (serviceType === "moving") {
                    if (propertyType === 'business') {
                        document.getElementById('individualHomeItems').style.display = 'none';
                        document.getElementById('businessItems').style.display = 'grid';
                    } else if (propertyType === 'individual-home') {
                        document.getElementById('businessItems').style.display = 'none';
                        document.getElementById('individualHomeItems').style.display = 'grid';
                    }
                } else {
                    document.getElementById('moving-container').style.display = 'none';
                    document.getElementById('cleaning-container').style.display = 'flex';
                }

            }


        });
    </script>
    <header class="">
        <div class="header-content flex items-center px-9 py-7 bg-[#2F4C94]">
            <div class="mr-auto flex items-center gap-[115px]">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>" aria-label="<?php bloginfo('name'); ?> Logo">
                        <img src="<?php echo URL_BASE; ?>/images/logo-white.svg" alt="<?php bloginfo('name'); ?>">
                    </a>
                </div>
                <div class="form-stepper flex items-center gap-11">
                    <div class="flex gap-[15px] items-center stepper finished">
                        <svg class="stepper-contacts " width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 27C15.2728 27 17.0283 26.6508 18.6662 25.9724C20.3041 25.2939 21.7923 24.2995 23.0459 23.0459C24.2995 21.7923 25.2939 20.3041 25.9724 18.6662C26.6508 17.0283 27 15.2728 27 13.5C27 11.7272 26.6508 9.97167 25.9724 8.33377C25.2939 6.69588 24.2995 5.20765 23.0459 3.95406C21.7923 2.70047 20.3041 1.70606 18.6662 1.02763C17.0283 0.349188 15.2728 -2.64175e-08 13.5 0C9.91958 5.33525e-08 6.4858 1.42232 3.95406 3.95406C1.42232 6.4858 0 9.91958 0 13.5C0 17.0804 1.42232 20.5142 3.95406 23.0459C6.4858 25.5777 9.91958 27 13.5 27ZM13.152 18.96L20.652 9.96L18.348 8.04L11.898 15.7785L8.5605 12.4395L6.4395 14.5605L10.9395 19.0605L12.1005 20.2215L13.152 18.96Z" fill="" />
                        </svg>
                        <span class="text-lg font-medium text-white">
                            Contacts
                        </span>
                    </div>
                    <div class="flex gap-[15px] items-center stepper active" id="stepper-step2">
                        <svg class="stepper-contacts" width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 27C15.2728 27 17.0283 26.6508 18.6662 25.9724C20.3041 25.2939 21.7923 24.2995 23.0459 23.0459C24.2995 21.7923 25.2939 20.3041 25.9724 18.6662C26.6508 17.0283 27 15.2728 27 13.5C27 11.7272 26.6508 9.97167 25.9724 8.33377C25.2939 6.69588 24.2995 5.20765 23.0459 3.95406C21.7923 2.70047 20.3041 1.70606 18.6662 1.02763C17.0283 0.349188 15.2728 -2.64175e-08 13.5 0C9.91958 5.33525e-08 6.4858 1.42232 3.95406 3.95406C1.42232 6.4858 0 9.91958 0 13.5C0 17.0804 1.42232 20.5142 3.95406 23.0459C6.4858 25.5777 9.91958 27 13.5 27ZM13.152 18.96L20.652 9.96L18.348 8.04L11.898 15.7785L8.5605 12.4395L6.4395 14.5605L10.9395 19.0605L12.1005 20.2215L13.152 18.96Z" fill="" />
                        </svg>
                        <span class="text-lg font-medium text-white">
                            Details
                        </span>
                    </div>
                    <div class="flex gap-[15px] items-center stepper next" id="stepper-step3">
                        <svg class="stepper-contacts " width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 27C15.2728 27 17.0283 26.6508 18.6662 25.9724C20.3041 25.2939 21.7923 24.2995 23.0459 23.0459C24.2995 21.7923 25.2939 20.3041 25.9724 18.6662C26.6508 17.0283 27 15.2728 27 13.5C27 11.7272 26.6508 9.97167 25.9724 8.33377C25.2939 6.69588 24.2995 5.20765 23.0459 3.95406C21.7923 2.70047 20.3041 1.70606 18.6662 1.02763C17.0283 0.349188 15.2728 -2.64175e-08 13.5 0C9.91958 5.33525e-08 6.4858 1.42232 3.95406 3.95406C1.42232 6.4858 0 9.91958 0 13.5C0 17.0804 1.42232 20.5142 3.95406 23.0459C6.4858 25.5777 9.91958 27 13.5 27ZM13.152 18.96L20.652 9.96L18.348 8.04L11.898 15.7785L8.5605 12.4395L6.4395 14.5605L10.9395 19.0605L12.1005 20.2215L13.152 18.96Z" fill="" />
                        </svg>
                        <span class="text-lg font-medium text-white">
                            Address
                        </span>
                    </div>
                </div>
            </div>

            <div class="buttons flex items-center gap-4">
                <a href="#" class="btn btn-secondary text-white flex gap-1.5 items-center h-[45px]">
                    <img class=" brightness-0 invert-[1]" src="<?php echo URL_BASE; ?>/images/phone-blue.svg" alt="<?php bloginfo('name'); ?>">
                    458-000-66
                </a>
            </div>
            <div class="mobile-menu lg:hidden md:block">
                <img src="<?php echo URL_BASE; ?>/images/mobile-menu.svg" alt="<?php bloginfo('name'); ?>">
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
                    <div class="mb-auto hidden grid-cols-3 gap-y-[18px] w-full " id="individualHomeItems">
                        <?php
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

                        render_item_block('desk', 0.8, URL_BASE . '/images/form-icons/desk.svg', 'Desk');
                        render_item_block('drawer-unit', 0.2, URL_BASE . '/images/form-icons/drawer-unit.svg', 'Drawer unit');
                        render_item_block('double-bed', 1.2, URL_BASE . '/images/form-icons/double-bed.svg', 'Double bed');
                        render_item_block('bed', 0.7, URL_BASE . '/images/form-icons/bed.svg', 'Bed');
                        render_item_block('nightstand', 0.2, URL_BASE . '/images/form-icons/nightstand.svg', 'Nightstand');
                        render_item_block('garderobeskap', 0.8, URL_BASE . '/images/form-icons/garderobeskap.svg', 'Garderobeskap'); // need volume
                        render_item_block('garden-furniture', 2.5, URL_BASE . '/images/form-icons/garden-furniture.svg', 'Garden furniture');
                        render_item_block('grill', 1, URL_BASE . '/images/form-icons/grill.svg', 'Grill');
                        render_item_block('washing-machine', 1, URL_BASE . '/images/form-icons/washing-machine.svg', 'Washing machine');
                        render_item_block('dresser', 2, URL_BASE . '/images/form-icons/dresser.svg', 'Dresser');

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
                        ?>
                    </div>
                    <!-- Business items -->
                    <div class="mb-auto hidden grid-cols-3 gap-y-[18px] w-full " id="businessItems">
                        <?php
                        render_item_block('desk', 0.8, URL_BASE . '/images/form-icons/desk.svg', 'Desk');
                        render_item_block('office-chair', 0.8, URL_BASE . '/images/form-icons/office-chair.svg', 'Office chair');
                        render_item_block('drawer-unit', 0.2, URL_BASE . '/images/form-icons/drawer-unit.svg', 'Drawer unit');
                        render_item_block('it', 0.2, URL_BASE . '/images/form-icons/it.svg', 'IT utstyr');
                        render_item_block('pc-screen', 0.2, URL_BASE . '/images/form-icons/pc-screen.svg', 'Pc skjermer');
                        render_item_block('dining-table', 0.7, URL_BASE . '/images/form-icons/dining-table.svg', 'Dining table');
                        render_item_block('chair', 0.3, URL_BASE . '/images/form-icons/chair.svg', 'Chair');
                        render_item_block('display-cabinet', 1.5, URL_BASE . '/images/form-icons/display-cabinet.svg', 'Display cabinet');
                        render_item_block('sideboard', 0.6, URL_BASE . '/images/form-icons/sideboard.svg', 'Sideboard');

                        render_item_block('dresser', 2, URL_BASE . '/images/form-icons/dresser.svg', 'Dresser');
                        render_item_block('bookshelf', 0.9, URL_BASE . '/images/form-icons/bookshelf.svg', 'Bookshelf');
                        render_item_block('tall-desk', 0.9, URL_BASE . '/images/form-icons/tall-desk.svg', 'Høyt bord');
                        render_item_block('sofa', 3, URL_BASE . '/images/form-icons/sofa.svg', 'Sofa');
                        render_item_block('armchair', 0.6, URL_BASE . '/images/form-icons/arm-chair.svg', 'Armchair');
                        render_item_block('coffee-table', 0.3, URL_BASE . '/images/form-icons/coffee-table.svg', 'Coffee table ');
                        render_item_block('tv', 0.5, URL_BASE . '/images/form-icons/tv.svg', 'TV');
                        render_item_block('bilder', 0.5, URL_BASE . '/images/form-icons/bilder.svg', 'Bilder');
                        render_item_block('tavle', 0.5, URL_BASE . '/images/form-icons/tavle.svg', 'Tavle');

                        render_item_block('refrigerator', 1.2, URL_BASE . '/images/form-icons/refrigerator.svg', 'Refrigerator');
                        render_item_block('plantepott', 1.2, URL_BASE . '/images/form-icons/plant.svg', 'Plantepott');
                        render_item_block('printer', 1.2, URL_BASE . '/images/form-icons/printer.svg', 'Printer');
                        render_item_block('archive', 1.2, URL_BASE . '/images/form-icons/archive.svg', 'Arkivskap');
                        render_item_block('safe', 1.2, URL_BASE . '/images/form-icons/safe.svg', 'Safe');
                        render_item_block('garden-furniture', 2.5, URL_BASE . '/images/form-icons/garden-furniture.svg', 'Garden furniture');
                        render_item_block('stillepod', 2.5, URL_BASE . '/images/form-icons/stillepod.svg', 'Stillepod');
                        render_item_block('moving-boxes', 0.1, URL_BASE . '/images/form-icons/moving-boxes.svg', 'Moving boxes');
                        render_item_block('extra-cubic-meters', 1, URL_BASE . '/images/form-icons/extra-cubic-meters.svg', 'Extra cubic meters');
                        ?>
                    </div>
                    <div class="bg-[#F7F7E0] px-10 py-5 rounded-[5px] flex justify-between items-center w-full">
                        <div></div>
                        <div class=" text-2xl text-[#3D3D3D] font-bold">Volume: <span id="totalVolume">0</span></div>
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
                        <button onclick="goToBlock2()" class="cursor-pointer next-btn !text-2xl font-bold" data-step="2">
                            <span>Next</span>
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.7159 3.51593C13.0034 3.22847 13.3933 3.06699 13.7999 3.06699C14.2065 3.06699 14.5965 3.22847 14.884 3.51593L21.784 10.4159C22.0715 10.7035 22.2329 11.0934 22.2329 11.5C22.2329 11.9066 22.0715 12.2965 21.784 12.5841L14.884 19.4841C14.5948 19.7634 14.2075 19.9179 13.8055 19.9144C13.4034 19.9109 13.0188 19.7497 12.7345 19.4654C12.4503 19.1811 12.289 18.7965 12.2855 18.3945C12.282 17.9924 12.4366 17.6051 12.7159 17.3159L16.8666 13.0333H2.29993C1.89327 13.0333 1.50326 12.8718 1.2157 12.5842C0.928149 12.2967 0.766602 11.9067 0.766602 11.5C0.766602 11.0933 0.928149 10.7033 1.2157 10.4158C1.50326 10.1282 1.89327 9.96666 2.29993 9.96666H16.8666L12.7159 5.68406C12.4284 5.39652 12.2669 5.00658 12.2669 4.59999C12.2669 4.19341 12.4284 3.80347 12.7159 3.51593Z" fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="relative flex flex-col h-full step" id="step2">
                    <h2 class="mb-4">Address</h2>
                    <div class="flex gap-[124px] justify-between mb-[77px] w-full">
                        <!-- Moving from -->
                        <div class=" max-w-[512px] w-full" id="movingFrom">
                            <h4 class="mb-5">Moving from</h4>
                            <div class="mb-5">
                                <label for="" class="text-lg text-[#474747] mb-1">Address</label>
                                <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                            </div>
                            <div class="flex gap-[30px] mb-5">
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Postal code</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Postal adress</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                            </div>
                            <div class="flex gap-[30px] mb-5 items-center ">
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Building type</label>
                                    <select name="" id="" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                        <option value="Home">Home</option>
                                    </select>
                                </div>
                                <div class="flex flex-1 items-center gap-[14px] h-full mt-6">
                                    <input type="checkbox">
                                    <label for="" class="text-lg text-[#474747]">Elevator</label>
                                </div>
                            </div>
                            <div class="flex gap-[30px] mb-5">
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Floor</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Area</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                            </div>
                            <div class="flex gap-[30px] mb-5">
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Carrying distance</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                                <div class="flex-1">
                                </div>
                            </div>
                        </div>
                        <!-- Moving to -->
                        <div class=" max-w-[512px] w-full" id="movingTo">
                            <h4 class="mb-5">Moving to</h4>
                            <div class="mb-5">
                                <label for="" class="text-lg text-[#474747] mb-1">Address</label>
                                <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                            </div>
                            <div class="flex gap-[30px] mb-5">
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Postal code</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                                <div class="flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Postal adress</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                            </div>
                            <div class="flex gap-[30px] mb-5 items-center ">
                                <div class="flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Building type</label>
                                    <select name="" id="" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                        <option value="Home">Home</option>
                                    </select>
                                </div>
                                <div class="flex flex-1 items-center gap-[14px] h-full mt-6">
                                    <input type="checkbox">
                                    <label for="" class="text-lg text-[#474747]">Elevator</label>
                                </div>
                            </div>
                            <div class="flex gap-[30px] mb-5">
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Floor</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Area</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                            </div>
                            <div class="flex gap-[30px] mb-5">
                                <div class=" flex-1">
                                    <label for="" class="text-lg text-[#474747] mb-1">Carrying distance</label>
                                    <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
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
                                    <label for="" class="text-lg text-[#474747] mb-1">Desired date</label>
                                    <input type="date" class="w-full border border-[#CDCDCD] rounded-[3px]">
                                </div>
                                <div class="flex flex-1 items-center gap-[14px] h-full mt-6">
                                    <input type="checkbox">
                                    <label for="" class="text-lg text-[#474747]">Flexible date</label>
                                </div>
                            </div>
                        </div>
                        <label for="" class="text-lg text-[#474747] mb-5 block">Extra services:</label>
                        <div class="flex gap-[34px] items-center mb-5">
                            <div class="flex items-center gap-[14px]">
                                <input type="checkbox">
                                <label for="" class="text-lg text-[#474747]">Packing</label>
                            </div>
                            <div class="flex items-center gap-[14px]">
                                <input type="checkbox">
                                <label for="" class="text-lg text-[#474747]">Packaging materials</label>
                            </div>
                            <div class="flex items-center gap-[14px]">
                                <input type="checkbox">
                                <label for="" class="text-lg text-[#474747]">Assembeling</label>
                            </div>
                            <div class="flex items-center gap-[14px]">
                                <input type="checkbox">
                                <label for="" class="text-lg text-[#474747]">Recycle station</label>
                            </div>
                            <div class="flex items-center gap-[14px]">
                                <input type="checkbox">
                                <label for="" class="text-lg text-[#474747]">Flyttevask</label>
                            </div>
                        </div>
                        <div class="max-w-[512px]">
                            <label for="" class="text-lg text-[#474747] mb-1">Moving notes (eg. heavy things)</label>
                            <textarea name="" id="" class="w-full border border-[#CDCDCD] rounded-[3px] " rows="3"></textarea>
                        </div>
                    </div>
                    <div class="bg-[#F7F7E0] px-10 py-5 rounded-[5px] flex justify-between items-center mt-[30px] relative w-full">
                        <div></div>
                        <div class="text-2xl text-[#3D3D3D] font-bold absolute left-1/2 -translate-x-1/2">You are only one click away!</div>
                        <button id="send-moving-quote" class="cursor-pointer next-btn !text-2xl font-bold">
                            <span>Submit</span>
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.7159 3.51593C13.0034 3.22847 13.3933 3.06699 13.7999 3.06699C14.2065 3.06699 14.5965 3.22847 14.884 3.51593L21.784 10.4159C22.0715 10.7035 22.2329 11.0934 22.2329 11.5C22.2329 11.9066 22.0715 12.2965 21.784 12.5841L14.884 19.4841C14.5948 19.7634 14.2075 19.9179 13.8055 19.9144C13.4034 19.9109 13.0188 19.7497 12.7345 19.4654C12.4503 19.1811 12.289 18.7965 12.2855 18.3945C12.282 17.9924 12.4366 17.6051 12.7159 17.3159L16.8666 13.0333H2.29993C1.89327 13.0333 1.50326 12.8718 1.2157 12.5842C0.928149 12.2967 0.766602 11.9067 0.766602 11.5C0.766602 11.0933 0.928149 10.7033 1.2157 10.4158C1.50326 10.1282 1.89327 9.96666 2.29993 9.96666H16.8666L12.7159 5.68406C12.4284 5.39652 12.2669 5.00658 12.2669 4.59999C12.2669 4.19341 12.4284 3.80347 12.7159 3.51593Z" fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Cleaning Container -->
            <div class="container h-full relative overflow-hidden flex-col hidden" id="cleaning-container">
                <div class="flex flex-row-reverse justify-between">
                    <div class="max-w-[590px]">
                        <h4 class="max-w-[420px] mb-[26px]">Standard moving cleaning includes:</h4>
                        <ul>
                            <li class="flex items-center gap-4 text-black mb-[23px] leading-[130%]">
                                <img src="<?php echo URL_BASE; ?>/images/check-green.svg" alt="<?php bloginfo('name'); ?>">
                                Cleaning of all cabinets and drawers (inside and outside);
                            </li>
                            <li class="flex items-center gap-4 text-black mb-[23px] leading-[130%]">
                                <img src="<?php echo URL_BASE; ?>/images/check-green.svg" alt="<?php bloginfo('name'); ?>">
                                Thorough cleaning of bathrooms and kitchens;
                            </li>
                            <li class="flex items-center gap-4 text-black mb-[23px] leading-[130%]">
                                <img src="<?php echo URL_BASE; ?>/images/check-green.svg" alt="<?php bloginfo('name'); ?>">
                                Dry cleaning of ceilings, walls and other non-washable surfaces;
                            </li>
                        </ul>
                    </div>
                    <div class="max-w-[512px] w-full">
                        <h2 class="mb-4">Details</h2>
                        <div class="mb-5 w-full">
                            <label for="" class="text-lg text-[#474747] mb-1">Address</label>
                            <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                        </div>
                        <div class="flex gap-[30px] mb-5">
                            <div class=" flex-1">
                                <label for="" class="text-lg text-[#474747] mb-1">Size of home in sq m</label>
                                <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                            </div>
                            <div class=" flex-1">
                                <label for="" class="text-lg text-[#474747] mb-1">Number of bathrooms</label>
                                <input type="text" class="w-full border border-[#CDCDCD] rounded-[3px]">
                            </div>
                        </div>
                        <div class="flex gap-[30px] mb-5">
                            <div class="flex-1">
                                <label for="" class="text-lg text-[#474747] mb-1">Desired date</label>
                                <input type="date" class="w-full border border-[#CDCDCD] rounded-[3px]">
                            </div>
                            <div class=" flex-1"></div>
                        </div>
                        <div class="max-w-[512px]">
                            <label for="" class="text-lg text-[#474747] mb-1">Notes</label>
                            <textarea name="" id="" class="w-full border border-[#CDCDCD] rounded-[3px] " rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-[#F7F7E0] px-10 py-5 rounded-[5px] flex justify-between items-center mt-auto relative w-full">
                    <div></div>
                    <div class="text-2xl text-[#3D3D3D] font-bold absolute left-1/2 -translate-x-1/2">You are only one click away!</div>
                    <button id="send-cleaning-quote" class="cursor-pointer next-btn !text-2xl font-bold">
                        <span>Submit</span>
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.7159 3.51593C13.0034 3.22847 13.3933 3.06699 13.7999 3.06699C14.2065 3.06699 14.5965 3.22847 14.884 3.51593L21.784 10.4159C22.0715 10.7035 22.2329 11.0934 22.2329 11.5C22.2329 11.9066 22.0715 12.2965 21.784 12.5841L14.884 19.4841C14.5948 19.7634 14.2075 19.9179 13.8055 19.9144C13.4034 19.9109 13.0188 19.7497 12.7345 19.4654C12.4503 19.1811 12.289 18.7965 12.2855 18.3945C12.282 17.9924 12.4366 17.6051 12.7159 17.3159L16.8666 13.0333H2.29993C1.89327 13.0333 1.50326 12.8718 1.2157 12.5842C0.928149 12.2967 0.766602 11.9067 0.766602 11.5C0.766602 11.0933 0.928149 10.7033 1.2157 10.4158C1.50326 10.1282 1.89327 9.96666 2.29993 9.96666H16.8666L12.7159 5.68406C12.4284 5.39652 12.2669 5.00658 12.2669 4.59999C12.2669 4.19341 12.4284 3.80347 12.7159 3.51593Z" fill="white" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>
        <script>
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
                document.getElementById('totalVolume').textContent = total + " m³";
            }


            function goToBlock2() {
                document.getElementById('step1').classList.remove('active');
                document.getElementById('step2').classList.add('active');

                const items = document.querySelectorAll(".item");
                let data = {};

                items.forEach((item) => {
                    const id = item.dataset.id;
                    const volume = parseFloat(item.dataset.volume);
                    const qty = parseInt(item.querySelector(".qty").textContent);
                    if (qty > 0) {
                        data[id] = {
                            quantity: qty,
                            volumePerItem: volume,
                            totalVolume: Math.round(qty * volume * 100) / 100,
                        };
                    }
                });
                console.log(data);
                // Store in sessionStorage (client-side)
                sessionStorage.setItem("itemsData", JSON.stringify(data));
                const stepperStep2 = document.querySelector('#stepper-step2')
                const stepperStep3 = document.querySelector('#stepper-step3')

                stepperStep2.classList.remove('active')
                stepperStep2.classList.add('finished')

                stepperStep3.classList.add('active')
                stepperStep3.classList.remove('next')
            }
        </script>
        <?php get_footer(); ?>