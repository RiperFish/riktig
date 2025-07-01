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

<section class="hero-section bg-accent relative lg:mb-10">
    <div class="outer-container relative mx-auto" style="max-width: 1440px;">
        <div class="container" style="margin-inline: unset;">
            <div class="text-container max-w-[570px] pt-[68px] pb-20 ml-20 ">
                <h1 class="mb-1.5">
                    <?php echo get_field('hero_section')['headline']; ?>
                </h1>
                <div class="rating flex gap-2.5 items-center mb-9">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl text-white">4.9</span>
                        <div class="flex items-center gap-1">
                            <?php echo render_svg_stars(4.9); ?>
                        </div>
                    </div>
                    <div>
                        <span class="opacity-80 text-white text-">Based on 500+ <strong>Google</strong> and other site
                            reviews</span>
                    </div>
                </div>
                <div class="mb-7">
                    <p class="text-white opacity-80">
                        <?php echo get_field('hero_section')['subheadline']; ?>
                    </p>
                </div>
                <div class="buttons flex gap-8 text">
                    <a href="#get-quote" class="btn btn-secondary text-white">I Need a Moving</a>
                    <a href="#get-quote" class="btn btn-secondary text-white">I Need a Cleaning</a>
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
                <a href="#get-quote" class="btn btn-primary flex items-center w-full md:w-fit h-[44px] ">Get a Quote</a>
                <a href="<?php echo get_page_by_template("moving-service-template.php")[0]->guid; ?>"
                    class="btn btn-secondary flex items-center h-[48px] w-full md:w-fit bg-white">
                    Read More
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
                <a href="#get-quote" class="btn btn-primary flex items-center w-full md:w-fit h-[44px] ">Get a Quote</a>
                <a href="<?php echo get_page_by_template("cleaning-service-template.php")[0]->guid; ?>"
                    class="btn btn-secondary flex items-center h-[48px] w-full md:w-fit bg-white">
                    Read More
                </a>

            </div>
        </div>

    </div>
</section>
<!-- Google reviews -->
<section class="bg-[#F4F7FF] pt-16 pb-20">
    <div class="container">
        <h2>References</h2>
        <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
    </div>
</section>
<!-- Get a quote -->
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
        <h1 class="mb-7">Get a price quote Today</h1>
        <div class=" relative min-h-36">
            <div class="step active" id="step1">
                <div class="flex items-center w-fit gap-6 mx-auto">
                    <img class=" rounded-full hidden md:block" width="62"
                        src="<?php echo URL_BASE; ?>/images/avatar.jpg" alt="Manager">
                    <div class=" md:px-7 md:py-2.5 md:bg-white rounded-br-[9px] rounded-bl-[9px] rounded-tr-[9px]">
                        <span
                            class=" text-xl text-white font-normal md:text-2xl opacity-80 md:text-[#2F4C94] md:font-bold text-[20px]">What
                            services do you
                            need?</span>
                    </div>
                </div>
                <div class="buttons w-full md:w-auto flex flex-col md:flex-row gap-4 md:gap-8 text mt-7 justify-center">
                    <button class="btn btn-secondary text-white next-step !px-[50px] relative service-selector"
                        data-step="2" data-service="moving">I Need a Moving</button>
                    <button class="btn btn-secondary text-white next-step !px-[50px] relative service-selector"
                        data-step="3" data-service="cleaning">I Need a Cleaning</button>
                </div>
            </div>
            <div class="step" id="step2">
                <div class="flex items-center w-fit gap-6 mx-auto">
                    <img class=" rounded-full hidden md:block" width="62"
                        src="<?php echo URL_BASE; ?>/images/avatar.jpg" alt="Manager">
                    <div class=" md:px-7 md:py-2.5 md:bg-white rounded-br-[9px] rounded-bl-[9px] rounded-tr-[9px]">
                        <span
                            class="text-xl text-white font-normal md:text-2xl opacity-80 md:text-[#2F4C94] md:font-bold text-[20px]">Is
                            it a business or
                            an
                            individual home?</span>
                    </div>
                </div>
                <div class="buttons w-full md:w-auto flex flex-col md:flex-row gap-4 md:gap-8 text mt-7 justify-center">
                    <button class="btn btn-secondary text-white next-step !px-[50px] relative property-type-selector"
                        data-step="3" data-property-type="individual-home">Individual home</button>
                    <button class="btn btn-secondary text-white next-step !px-[50px] relative property-type-selector"
                        data-step="3" data-property-type="business">Business</button>
                </div>
            </div>
            <div class="step contact-details" id="step3">
                <div class="flex items-center w-fit gap-6 mx-auto">
                    <img class=" rounded-full hidden md:block" width="62"
                        src="<?php echo URL_BASE; ?>/images/avatar.jpg" alt="Manager">
                    <div class=" md:px-7 md:py-2.5 md:bg-white rounded-br-[9px] rounded-bl-[9px] rounded-tr-[9px]">
                        <span
                            class="text-xl text-white font-normal md:text-2xl opacity-80 md:text-[#2F4C94] md:font-bold text-[20px]">Please
                            provide your
                            contact details</span>
                    </div>
                </div>
                <div class="mt-4 w-full md:w-auto flex flex-col md:flex-row gap-4 md:gap-7">
                    <div class="text-lg text-white font-medium grid">
                        <label for="email" class="text-left mb-1">Email address *</label>
                        <input class="max-w-48 required-input" type="email" id="email">
                    </div>
                    <div class="text-lg text-white font-medium grid">
                        <label for="name" class="text-left mb-1" id="name-label"></label>
                        <input class="max-w-48" type="text" id="name">
                    </div>
                    <div class="text-lg text-white font-medium grid">
                        <label for="phone" class="text-left mb-1">Phone</label>
                        <input class="max-w-48 required-input" type="text" id="phone">
                    </div>
                </div>

                <div id="quote-step-one" class="next-btn !text-2xl font-bold mt-9 cursor-pointer">
                    <span>Next</span>
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
        let propertyType = ""
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
                    document.querySelector('.contact-details #name-label').textContent = "Name"
                }
            })
        });
        propertyTypeSelector.forEach(selector => {
            selector.addEventListener('click', () => {
                propertyType = selector.dataset.propertyType
                if (propertyType == "business") {
                    document.querySelector('.contact-details #name-label').textContent = "Company name *"
                }
                if (propertyType == "individual-home") {
                    document.querySelector('.contact-details #name-label').textContent = "Name"
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
                    moreOptions.querySelector('span').textContent = 'Loading…';      // optional feedback
                    moreOptions.style.cursor = 'not-allowed';  // optional styling

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
                        data: {
                            action: "send_moving_quote_step_one_action",
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