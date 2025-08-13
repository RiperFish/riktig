<?php /* Template Name: Home page template  */ ?>
<?php get_header();

/* $repeater_data = get_post_meta(get_the_ID(), 'custom_repeater_field', true);

if (!empty($repeater_data)) : ?>
    <div class="custom-repeater-wrapper">
        <?php foreach ($repeater_data as $row) :
            $title = esc_html($row['title']);
            $image_url = wp_get_attachment_image_url(intval($row['image']), 'medium');
        ?>
            <div class="custom-repeater-item">
                <?php if ($image_url): ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo $title; ?>" />
                <?php endif; ?>
                <h4><?php echo $title; ?></h4>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;
 */
?>

<section class="hero-section bg-accent relative lg:mb-[60px]">
    <div class="outer-container relative mx-auto" style="max-width: 1440px;">
        <div class="container" style="margin-inline: unset;">
            <div class="text-container max-w-[570px] pt-[68px] pb-20 ml-20 ">
                <h1 class="mb-1.5">
                    <?php echo get_field('hero_section')['headline']; ?>
                </h1>
                <a href="#reviews-section">
                    <div class="rating flex flex-col mb-9">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl text-white">4.9</span>
                            <div class="flex items-center gap-1">
                                <?php echo render_svg_stars(4.9); ?>
                            </div>
                        </div>
                        <div>
                            <span class="opacity-80 text-white text-">
                                Basert på mer enn 500 anmeldelser fra <strong>Google</strong> og andre nettsteder
                            </span>
                        </div>
                    </div>
                </a>
                <div class="mb-7">
                    <p class="text-white opacity-80">
                        <?php echo get_field('hero_section')['subheadline']; ?>
                    </p>
                </div>
                <div class="buttons flex gap-8 text">
                    <a href="#get-quote" class="btn btn-secondary text-white">Jeg trenger Flyttehjelp</a>
                    <a href="#get-quote" class="btn btn-secondary text-white">Jeg trenger Vaskehjelp</a>
                </div>
            </div>
            <div class="hero-img">
                <?php if (get_field('hero_section')['image']): ?>
                    <img src="<?php echo get_field('hero_section')['image']; ?>" alt="<?php bloginfo('name'); ?>" />
                <?php endif; ?>
            </div>

            <!-- <img class="hero-img" src="<?php echo URL_BASE; ?>/images/home-hero-img.jpg" alt="<?php bloginfo('name'); ?>"> -->
        </div>
    </div>


</section>
<div class="mb-14 -mt-11 lg:mt-0 no-bg">
    <div class="container grid grid-cols-2 lg:flex md:grid md:grid-cols-3 gap-9">
        <?php
        $repeater_data = get_field('achievements')['achievements']; // replace with your field name
        if (!empty($repeater_data)): ?>
            <?php foreach ($repeater_data as $row):
                $title = esc_html($row['title'] ?? '');
                $image_url = wp_get_attachment_image_url(intval($row['image'] ?? 0), 'medium');
                ?>

                <div class="flex flex-col  items-center w-full justify-start">
                    <?php if ($image_url): ?>
                        <img class=" w-[72px] h-[72px] mb-4" src="<?php echo esc_url($image_url); ?>" alt="<?php echo $title; ?>" />
                    <?php endif; ?>
                    <h5 class="text-base md:text-lg text-[#474747] text-center"><?php echo $title; ?></h5>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Moving services -->
<section class="max-w-[1400px] mx-auto bg-[#F4F7FF] px-20 py-16 rounded-[50px] border border-[#E7EBF6]">
    <div class="container flex justify-between relative">
        <div class="section-left-container max-w-[605px]">
            <h2 class=" mb-1.5 text-center md:text-left"><?php echo get_field('moving_section')['section_title']; ?>
            </h2>
            <div class="service-key-features flex items-center gap-12 mb-7 ">
                <div class="flex items-center gap-1.5">
                    <img src="<?php echo URL_BASE; ?>/images/clean.svg" alt="<?php bloginfo('name'); ?>">
                    <span class="text-base text-[#474747]">
                        <?php echo get_field('moving_section')['key_features']['key_feature_one']; ?></span>
                </div>
                <div class="flex items-center gap-1.5">
                    <img src="<?php echo URL_BASE; ?>/images/shield.svg" alt="<?php bloginfo('name'); ?>">
                    <span class="text-base text-[#474747]">
                        <?php echo get_field('moving_section')['key_features']['key_feature_two']; ?></span>
                </div>
                <div class="flex items-center gap-1.5">
                    <img src="<?php echo URL_BASE; ?>/images/calculator.svg" alt="<?php bloginfo('name'); ?>">
                    <span class="text-base text-[#474747]">
                        <?php echo get_field('moving_section')['key_features']['key_feature_three']; ?></span>
                </div>
            </div>
            <div
                class="section-img max-w-[499px] max-h-[466px] rounded-[50px] w-full h-full mt-3 absolute right-0 top-0">
                <?php if (get_field('moving_section')['moving_section_image']): ?>
                    <img class="rounded-[50px]" src="<?php echo get_field('moving_section')['moving_section_image']; ?>"
                        alt="<?php bloginfo('name'); ?>" />
                <?php endif; ?>
            </div>
            <div class="mb-8">
                <p class="text-[#3D3D3D] opacity-80">
                    <?php echo get_field('moving_section')['section_excerpt']; ?>
                </p>
            </div>
            <!-- Accordion -->
            <div class="mb-9" id="accordion"> <!-- space-y-4 is a cool tailwind feature -->
                <?php
                $moving_process_data = get_field('moving_section')['moving_process']; // replace with your field name
                if (!empty($moving_process_data)): ?>
                    <?php foreach ($moving_process_data as $row):
                        $process_title = esc_html($row['process'] ?? '');
                        $process_desc = esc_html($row['process-desc'] ?? '');
                        ?>
                        <!-- Accordion Item -->
                        <div class="accordion-item border-b border-b-[#2F4C94] mb-4">
                            <div
                                class="text-lg text-[#2F4C94] font-medium w-full text-left pr-4 pb-4 flex gap-5 items-center accordion-toggle cursor-pointer">
                                <span class="indicator transition-transform transform">+</span>
                                <span class="text-base md:text-[18px]"><?php echo $process_title ?></span>
                            </div>
                            <div class=" accordion-content text-lg max-h-0 overflow-hidden transition-all duration-300">
                                <div class="pb-4 pl-[30px] pr-5 text-base md:text-[18px]">
                                    <?php echo $process_desc ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="buttons flex flex-col md:flex-row items-center gap-4 md:gap-5">
                <a href="#get-quote" class="btn btn-primary flex items-center w-full md:w-fit h-[44px] ">Få et
                    tilbud</a>
                <a href="<?php echo get_page_by_template("moving-service-template.php")[0]->guid; ?>"
                    class="btn btn-secondary flex items-center h-[48px] w-full md:w-fit bg-white">
                    Les Mer
                </a>

            </div>
        </div>

    </div>
</section>
<!-- Cleaning services -->
<section class=" py-24 no-bg">
    <div class="container flex justify-between relative">
        <div class="section-left-container max-w-[605px]">
            <h2 class=" mb-1.5 text-center md:text-left"><?php echo get_field('cleaning_section')['section_title']; ?>
            </h2>
            <div class="flex items-center gap-12 mb-7 justify-center md:justify-start">
                <div class="flex items-center gap-4">
                    <img src="<?php echo URL_BASE; ?>/images/leaf-green.svg" alt="<?php bloginfo('name'); ?>">
                    <span class="text-base text-[#474747]">
                        <?php echo get_field('cleaning_section')['key_feature']; ?></span>
                </div>
            </div>
            <style>
                .diamond-cropped {
                    /*  display: block;
                    width: 480px;
                    height: 480px;
                    object-fit: cover;

                    mask-image: url('data:image/svg+xml;utf8,<svg width="475" height="476" viewBox="0 0 475 476" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="237.5" y="-20.1675" width="365" height="365" rx="50" transform="rotate(45 237.5 -20.1675)" fill="white"/></svg>');

                    mask-mode: alpha;
                    mask-size: 100% 100%;
                    mask-repeat: no-repeat;

                    -webkit-mask-image: url('data:image/svg+xml;utf8,<svg width="475" height="476" viewBox="0 0 475 476" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="237.5" y="-20.1675" width="365" height="365" rx="50" transform="rotate(45 237.5 -20.1675)" fill="white"/></svg>');
                    -webkit-mask-size: 100% 100%;
                    -webkit-mask-repeat: no-repeat; */
                }
            </style>
            <div
                class="section-img mt-3 max-w-[480px] max-h-[480px] h-full absolute md:right-5 md:top-0 right-0 top-0 ">
                <?php if (get_field('cleaning_section')['cleaning_section_image']): ?>
                    <img class="diamond-cropped lg:rounded-0 rounded-[50px]"
                        src="<?php echo get_field('cleaning_section')['cleaning_section_image']; ?>"
                        alt="<?php bloginfo('name'); ?>" />
                <?php endif; ?>
            </div>




            <div class="mb-8">
                <p class="text-[#3D3D3D] opacity-80">
                    <?php echo get_field('cleaning_section')['section_excerpt']; ?>
                </p>
            </div>
            <!-- Accordion -->
            <div class="mb-9" id="accordion"> <!-- space-y-4 is a cool tailwind feature -->
                <?php
                $moving_process_data = get_field('cleaning_section')['cleaning_process']; // replace with your field name
                if (!empty($moving_process_data)): ?>
                    <?php foreach ($moving_process_data as $row):
                        $process_title = esc_html($row['process'] ?? '');
                        $process_desc = esc_html($row['process-desc'] ?? '');
                        ?>
                        <!-- Accordion Item -->
                        <div class="accordion-item border-b border-b-[#2F4C94] mb-4">
                            <div
                                class="text-lg text-[#2F4C94] font-medium w-full text-left pr-4 pb-4 flex gap-5 items-center accordion-toggle cursor-pointer">
                                <span class="indicator transition-transform transform">+</span>
                                <span class="text-base md:text-[18px]"><?php echo $process_title ?></span>
                            </div>
                            <div class=" accordion-content text-lg max-h-0 overflow-hidden transition-all duration-300">
                                <div class="pb-4 pl-[30px] pr-5 text-base md:text-[18px]">
                                    <?php echo $process_desc ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


            </div>
            <div class="buttons flex flex-col md:flex-row items-center gap-4 md:gap-5">
                <a href="#get-quote" class="btn btn-primary flex items-center w-full md:w-fit h-[44px] ">Få et
                    tilbud</a>
                <a href="<?php echo get_page_by_template("cleaning-service-template.php")[0]->guid; ?>"
                    class="btn btn-secondary flex items-center h-[48px] w-full md:w-fit bg-white">
                    Les Mer
                </a>

            </div>
        </div>

    </div>
</section>
<!-- Google reviews -->
<section class="bg-[#F4F7FF] pt-16 pb-20" id="reviews-section">
    <div class="container">
        <h2>Referanser</h2>
        <div class="rating flex items-center mb-9">
            <div class="flex items-center gap-3">
                <span class="text-2xl text-[#474747]">4.9</span>
                <div class="flex items-center gap-1">
                    <?php echo render_svg_stars(4.9); ?>
                </div>
            </div>
            <div>
                <span class="opacity-80 text-[#474747] flex items-center ml-2.5">
                    Basert på mer enn 500 anmeldelser fra
                    <svg style="margin-inline: 14px 7px;margin-top: 4px;" width="59" height="20" viewBox="0 0 59 20"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_95_126)">
                            <path
                                d="M25.1077 10.2566C25.1077 13.0326 22.9407 15.0783 20.2814 15.0783C17.622 15.0783 15.4551 13.0326 15.4551 10.2566C15.4551 7.4609 17.622 5.43481 20.2814 5.43481C22.9407 5.43481 25.1077 7.4609 25.1077 10.2566ZM22.9949 10.2566C22.9949 8.52177 21.739 7.33481 20.2814 7.33481C18.8237 7.33481 17.5678 8.52177 17.5678 10.2566C17.5678 11.9739 18.8237 13.1783 20.2814 13.1783C21.739 13.1783 22.9949 11.9718 22.9949 10.2566Z"
                                fill="#EA4335" />
                            <path
                                d="M35.5198 10.2566C35.5198 13.0326 33.3528 15.0783 30.6935 15.0783C28.0341 15.0783 25.8672 13.0326 25.8672 10.2566C25.8672 7.46308 28.0341 5.43481 30.6935 5.43481C33.3528 5.43481 35.5198 7.4609 35.5198 10.2566ZM33.407 10.2566C33.407 8.52177 32.1511 7.33481 30.6935 7.33481C29.2358 7.33481 27.9799 8.52177 27.9799 10.2566C27.9799 11.9739 29.2358 13.1783 30.6935 13.1783C32.1511 13.1783 33.407 11.9718 33.407 10.2566Z"
                                fill="#FBBC05" />
                            <path
                                d="M45.4975 5.72612V14.3826C45.4975 17.9435 43.4021 19.3979 40.925 19.3979C38.5932 19.3979 37.1898 17.8348 36.6605 16.5566L38.4999 15.7892C38.8275 16.5739 39.63 17.5 40.9228 17.5C42.5085 17.5 43.4911 16.5196 43.4911 14.6739V13.9805H43.4173C42.9445 14.5652 42.0334 15.0761 40.8838 15.0761C38.4782 15.0761 36.2744 12.9761 36.2744 10.2739C36.2744 7.55221 38.4782 5.43481 40.8838 5.43481C42.0313 5.43481 42.9423 5.94568 43.4173 6.51308H43.4911V5.72829H45.4975V5.72612ZM43.6407 10.2739C43.6407 8.57612 42.5106 7.33481 41.0725 7.33481C39.6149 7.33481 38.3936 8.57612 38.3936 10.2739C38.3936 11.9544 39.6149 13.1783 41.0725 13.1783C42.5106 13.1783 43.6407 11.9544 43.6407 10.2739Z"
                                fill="#4285F4" />
                            <path d="M48.8048 0.6521V14.7825H46.7441V0.6521H48.8048Z" fill="#34A853" />
                            <path
                                d="M56.8353 11.8435L58.4751 12.9391C57.9459 13.7239 56.6704 15.0761 54.4666 15.0761C51.7335 15.0761 49.6924 12.9587 49.6924 10.2544C49.6924 7.38696 51.7509 5.43262 54.2302 5.43262C56.7268 5.43262 57.948 7.42392 58.3472 8.50001L58.5662 9.04783L52.1348 11.7174C52.6272 12.6848 53.3929 13.1783 54.4666 13.1783C55.5425 13.1783 56.2887 12.6478 56.8353 11.8435ZM51.7878 10.1087L56.0869 8.31957C55.8505 7.7174 55.139 7.29783 54.3018 7.29783C53.228 7.29783 51.7335 8.24783 51.7878 10.1087Z"
                                fill="#EA4335" />
                            <path
                                d="M7.65485 9.00229V6.95664H14.5331C14.6004 7.31316 14.6351 7.7349 14.6351 8.19143C14.6351 9.72621 14.2164 11.624 12.8672 12.9762C11.5549 14.3458 9.8782 15.0762 7.65702 15.0762C3.54004 15.0762 0.078125 11.7153 0.078125 7.58925C0.078125 3.46316 3.54004 0.102295 7.65702 0.102295C9.9346 0.102295 11.5571 0.997947 12.7761 2.16534L11.3358 3.60882C10.4617 2.78708 9.27735 2.14795 7.65485 2.14795C4.64846 2.14795 2.29713 4.57621 2.29713 7.58925C2.29713 10.6023 4.64846 13.0306 7.65485 13.0306C9.60489 13.0306 10.7155 12.2458 11.4269 11.5327C12.0039 10.9545 12.3835 10.1284 12.5332 9.00012L7.65485 9.00229Z"
                                fill="#4285F4" />
                        </g>
                        <defs>
                            <clipPath id="clip0_95_126">
                                <rect width="59" height="20" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    og andre nettsteder
                </span>
            </div>
        </div>
        <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
    </div>
</section>
<!-- Få et tilbud -->
<section class="bg-[#2F4C94] pt-[120px] pb-[152px] get-quote" id="get-quote">
    <div class="container text-center">
        <style>
            .step {
                opacity: 0;
                visibility: hidden;
                transition: all 0.4s ease;
                position: absolute;
                width: 100%;

                left: 50%;
                transform: translateX(-50%);
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .step.active {
                opacity: 1;
                visibility: visible;
                position: relative;
            }
        </style>
        <h1 class="mb-7">Få pristilbud i dag</h1>
        <div class=" relative min-h-36">
            <div class="step active" id="step1">
                <div class="flex items-center w-fit gap-6 mx-auto">
                    <img class=" rounded-full hidden md:block bg-white" width="62"
                        src="<?php echo URL_BASE; ?>/images/avatar.png" alt="Manager">
                    <div class=" md:px-7 md:py-2.5 md:bg-white rounded-br-[9px] rounded-bl-[9px] rounded-tr-[9px]">
                        <span
                            class=" text-xl text-white font-normal md:text-2xl opacity-80 md:text-[#2F4C94] md:font-bold text-[20px]">Hva
                            kan vi hjelpe deg med?</span>
                    </div>
                </div>
                <div class="buttons w-full md:w-auto flex flex-col md:flex-row gap-4 md:gap-8 text mt-7 justify-center">
                    <button class="btn btn-secondary text-white next-step !px-[50px] relative service-selector"
                        data-step="2" data-service="moving" data-service-nor="Jeg trenger Flyttehjelp">Jeg trenger
                        Flyttehjelp</button>
                    <button class="btn btn-secondary text-white next-step !px-[50px] relative service-selector"
                        data-step="3" data-service="cleaning" data-service-nor="Jeg trenger Vaskehjelp">Jeg trenger
                        Vaskehjelp</button>
                </div>
            </div>
            <div class="step" id="step2">
                <div class="flex items-center w-fit gap-6 mx-auto">
                    <img class=" rounded-full hidden md:block bg-white" width="62"
                        src="<?php echo URL_BASE; ?>/images/avatar.png" alt="Manager">
                    <div class=" md:px-7 md:py-2.5 md:bg-white rounded-br-[9px] rounded-bl-[9px] rounded-tr-[9px]">
                        <span
                            class="text-xl text-white font-normal md:text-2xl opacity-80 md:text-[#2F4C94] md:font-bold text-[20px]">
                            Er det en bedrift eller en privat bolig?</span>
                    </div>
                </div>
                <div class="buttons w-full md:w-auto flex flex-col md:flex-row gap-4 md:gap-8 text mt-7 justify-center">
                    <button class="btn btn-secondary text-white next-step !px-[50px] relative property-type-selector"
                        data-step="3" data-property-type="individual-home"
                        data-property-type-nor="Privat">Privat</button>
                    <button class="btn btn-secondary text-white next-step !px-[50px] relative property-type-selector"
                        data-step="3" data-property-type="business" data-property-type-nor="Bedrift">Bedrift</button>
                </div>
            </div>
            <div class="step contact-details" id="step3">
                <div class="flex items-center w-fit gap-6 mx-auto">
                    <img class=" rounded-full hidden md:block bg-white" width="62"
                        src="<?php echo URL_BASE; ?>/images/avatar.png" alt="Manager">
                    <div class=" md:px-7 md:py-2.5 md:bg-white rounded-br-[9px] rounded-bl-[9px] rounded-tr-[9px]">
                        <span
                            class="text-xl text-white font-normal md:text-2xl opacity-80 md:text-[#2F4C94] md:font-bold text-[20px]">Vennligst
                            oppgi kontaktinformasjonen din</span>
                    </div>
                </div>
                <div class="mt-4 w-full md:w-auto flex flex-col md:flex-row gap-4 md:gap-7">
                    <div class="text-lg text-white font-medium grid">
                        <label for="email" class="text-left mb-1">E-post adresse *</label>
                        <input class="max-w-48 required-input" type="email" id="email">
                    </div>
                    <div class="text-lg text-white font-medium grid">
                        <label for="name" class="text-left mb-1" id="name-label"></label>
                        <input class="max-w-48" type="text" id="name">
                    </div>
                    <div class="text-lg text-white font-medium grid">
                        <label for="phone" class="text-left mb-1">Telefon</label>
                        <input class="max-w-48 required-input" type="text" id="phone">
                    </div>
                </div>

                <div id="quote-step-one" class="btn next-btn !text-2xl font-bold mt-9 cursor-pointer">
                    <span>Neste</span>
                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.7159 3.51593C13.0034 3.22847 13.3933 3.06699 13.7999 3.06699C14.2065 3.06699 14.5965 3.22847 14.884 3.51593L21.784 10.4159C22.0715 10.7035 22.2329 11.0934 22.2329 11.5C22.2329 11.9066 22.0715 12.2965 21.784 12.5841L14.884 19.4841C14.5948 19.7634 14.2075 19.9179 13.8055 19.9144C13.4034 19.9109 13.0188 19.7497 12.7345 19.4654C12.4503 19.1811 12.289 18.7965 12.2855 18.3945C12.282 17.9924 12.4366 17.6051 12.7159 17.3159L16.8666 13.0333H2.29993C1.89327 13.0333 1.50326 12.8718 1.2157 12.5842C0.928149 12.2967 0.766602 11.9067 0.766602 11.5C0.766602 11.0933 0.928149 10.7033 1.2157 10.4158C1.50326 10.1282 1.89327 9.96666 2.29993 9.96666H16.8666L12.7159 5.68406C12.4284 5.39652 12.2669 5.00658 12.2669 4.59999C12.2669 4.19341 12.4284 3.80347 12.7159 3.51593Z"
                            fill="#2F4C94" />
                    </svg>
                </div>
            </div>

        </div>
    </div>
    <script>
        let serviceType = ""
        let serviceTypeNor = ""
        let propertyType = ""
        let propertyTypeNor = ""
        let contactInfos = {
            email: "",
            name: "",
            phone: ""
        }

        const serviceSelector = document.querySelectorAll('.service-selector')
        const propertyTypeSelector = document.querySelectorAll('.property-type-selector')

        serviceSelector.forEach(selector => {
            selector.addEventListener('click', () => {
                serviceType = selector.dataset.service
                if (serviceType == "cleaning") {
                    document.querySelector('.contact-details #name-label').textContent = "Navn"
                    serviceTypeNor = selector.dataset.serviceNor
                }
                if (serviceType == "moving") {
                    serviceTypeNor = selector.dataset.serviceNor
                }
            })
        });
        propertyTypeSelector.forEach(selector => {
            selector.addEventListener('click', () => {
                propertyType = selector.dataset.propertyType

                if (propertyType == "business") {
                    document.querySelector('.contact-details #name-label').textContent = "Firmanavn *"
                    propertyTypeNor = selector.dataset.propertyTypeNor
                }
                if (propertyType == "individual-home") {
                    document.querySelector('.contact-details #name-label').textContent = "Navn"
                    propertyTypeNor = selector.dataset.propertyTypeNor
                }
            })
        });
        function isValidEmail(email) {
            // Basic RFC-2822-based regex
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email.trim());
        }
        function isValidName(name) {
            //const re = /^[A-Za-z0-9]+(?:\s[A-Za-z0-9]+)*$/;
            const re = /^[\p{L}0-9]+(?:\s[\p{L}0-9]+)*$/u;
            return re.test(name.trim());
        }
        function generateRandomIdWithName(name, length = 13) {
            const id = Math.random().toString(36).substr(2, length);
            const timestamp = Date.now(); // current time in milliseconds
            return `${name}-${id}-${timestamp}`;
        }
        const moreOptions = document.querySelector("#quote-step-one");
        let stepOneReady = false
        if (moreOptions !== null) {
            let email = document.querySelector('input#email')
            let name = document.querySelector('input#name')
            let phone = document.querySelector('input#phone')
            email.addEventListener('keyup', () => {
                if (email.value.trim() != '' && isValidEmail(email.value.trim())) {
                    email.previousElementSibling.style.color = '#fff';
                    email.style.borderColor = "#fff"
                } else {
                    email.previousElementSibling.style.color = '#FF0000';
                    email.style.borderColor = "#FF0000"
                    stepOneReady = false
                }
            })
            name.addEventListener('keyup', () => {
                if (name.value.trim() != '' && isValidName(name.value.trim())) {
                    name.previousElementSibling.style.color = '#fff';
                    name.style.borderColor = "#fff"
                } else {
                    name.previousElementSibling.style.color = '#FF0000';
                    name.style.borderColor = "#FF0000"
                    stepOneReady = false
                }
            })
            // check if form inputs are not empty before moving to next page
            moreOptions.addEventListener('click', (e) => {

                if (email.value.trim() != '' && isValidEmail(email.value.trim())) {
                    email.previousElementSibling.style.color = '#fff';
                    email.style.borderColor = "#fff"
                } else {
                    email.previousElementSibling.style.color = '#FF0000';
                    email.style.borderColor = "#FF0000"
                    stepOneReady = false
                }
                if (name.value.trim() != '' && isValidName(name.value.trim())) {
                    name.previousElementSibling.style.color = '#fff';
                    name.style.borderColor = "#fff"
                } else {
                    name.previousElementSibling.style.color = '#FF0000';
                    name.style.borderColor = "#FF0000"
                    stepOneReady = false
                }

                if (name.value.trim() != '' && isValidEmail(email.value.trim()) && email.value.trim() != '' && isValidName(name.value.trim())) {
                    stepOneReady = true
                }

                if (stepOneReady == true) {
                    moreOptions.disabled = true;
                    moreOptions.querySelector('span').textContent = 'Laster…';      // optional feedback
                    moreOptions.style.cursor = 'not-allowed';  // optional styling

                    contactInfos.emailId = "<?php echo session_id(); ?>" // generateRandomIdWithName(name.value);
                    contactInfos.email = email.value
                    contactInfos.name = name.value
                    contactInfos.phone = phone.value

                    let clientInfos = {};
                    clientInfos = {
                        serviceType: serviceType,
                        propertyType: propertyType,
                        contactInfos: contactInfos
                    }

                    sessionStorage.setItem("clientInfos", JSON.stringify(clientInfos));

                    jQuery.ajax({
                        url: ajaxurl,
                        type: "POST",
                        //dataType: 'json',
                        data: {
                            //action: "send_moving_quote_step_one_action",
                            action: "send_moving_quote_step_one_action_db",
                            //nonce: my_ajax_object.nonce,
                            clientInfos: clientInfos,
                        },
                        success: function (response) {
                            console.log("Server response:", response);
                            window.location.href = "<?php echo get_page_by_template("form-template.php")[0]->guid; ?>";
                        },
                    });
                }

            });

        }

        let currentStep = 1;

        const nextStepBtns = document.querySelectorAll('.next-step')
        nextStepBtns.forEach(nextStepBtn => {
            nextStepBtn.addEventListener('click', (e) => {
                e.target.classList.add('selected')
                const step = nextStepBtn.dataset.step
                const desiredService = nextStepBtn.dataset.service

                if (desiredService == "cleaning") {

                }

                const currentEl = document.getElementById('step' + currentStep);
                const nextEl = document.getElementById('step' + step);

                setTimeout(() => {
                    currentEl.classList.remove('active');
                    nextEl.classList.add('active');
                    currentStep = step;
                }, 300); // match the CSS transition duration (300ms)
            })
        });
    </script>
</section>
<?php get_footer(); ?>