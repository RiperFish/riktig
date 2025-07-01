<?php /* Template Name: About us template  */ ?>
<?php get_header(); ?>

<section class="hero-section template-hero-section bg-accent relative lg:mb-20">
    <div class="outer-container relative mx-auto" style="max-width: 1440px;">
        <div class="container" style="margin-inline: unset;">
            <div class="text-container max-w-[570px] pt-[68px] pb-20 ml-20">
                <h1 class="mb-7">
                    About Us
                </h1>
                <div class="text-white  opacity-80">
                    <?php echo get_field('hero_section')['paragraph']; ?>
                </div>
            </div>
            <div class="hero-img">
                <?php if (get_field('hero_section')['image']): ?>
                    <img class=" h-full" src="<?php echo get_field('hero_section')['image']; ?>"
                        alt="<?php bloginfo('name'); ?>" />
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>


<div class="mb-14 -mt-11 lg:mt-0 no-bg">
    <div class="container grid grid-cols-2 lg:flex md:grid md:grid-cols-3 gap-9">
        <!-- <div class="flex flex-col justify-center items-center w-fit">
            <img class=" w-[72px] h-[72px] border mb-4" src="" alt="">
            <span class="text-lg text-[#474747] text-center">Gaselle 2024 nominees</span>
        </div> -->
        <?php
        $args = [
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => 'home.php',
            'posts_per_page' => 1,          // only need one
        ];
        $pages = get_posts($args);

        $repeater_data = get_field('achievements', $pages[0]->ID)['achievements']; // replace with your field name
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
<section class="mb-0 lg:mb-16 our-team">
    <div class="container">
        <h2 class=" mb-14 ">Our team</h2>
        <div class="flex flex-col md:flex-row md:flex-wrap xl:flex-nowrap md:justify-center gap-8 items-center">
            <?php
            $repeater_data = get_field('team_members'); // replace with your field name
            if (!empty($repeater_data)): ?>
                <?php foreach ($repeater_data as $row):
                    $title = esc_html($row['title'] ?? '');
                    $position = esc_html($row['position'] ?? '');
                    $phone_number = esc_html($row['phone_number'] ?? '');
                    $image_url = wp_get_attachment_image_url(intval($row['image'] ?? 0), 'medium');
                    ?>
                    <div
                        class="team-member flex justify-end bg-[#F4F7FF] rounded-[20px] border border-[#E7EBF6] relative px-4 max-w-[420px] md:max-w-[393px] max-h-[218px] w-full h-full pt-11 pb-14">
                        <img class="absolute bottom-0 left-3 max-w-[120px] md:w-full md:max-w-[171px]"
                            src="<?php echo $image_url; ?>">
                        <div>
                            <span class="name text-[20px] text-[#2F4C94] font-medium block"><?php echo $title; ?></span>
                            <span
                                class="name text-lg text-[#3d3d3d] role block mb-5"><?php echo str_replace(" / ", " /<br> ", $position); ?></span>
                            <a href="#"
                                class="btn btn-secondary flex gap-1 items-center h-[45px] w-fit bg-white font-medium px-4 ">
                                <img width="26" src="<?php echo URL_BASE; ?>/images/phone-blue.svg"
                                    alt="<?php bloginfo('name'); ?>">
                                <?php echo $phone_number; ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="mb-16 about-us-extra-content">
    <div class="container">
        <h2 class=" mb-3">We do everything inside</h2>
        <?php echo get_field('extra_content'); ?>
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
                        <input class="max-w-48" type="email" id="email">
                    </div>
                    <div class="text-lg text-white font-medium grid">
                        <label for="name" class="text-left mb-1" id="name-label"></label>
                        <input class="max-w-48" type="text" id="name">
                    </div>
                    <div class="text-lg text-white font-medium grid">
                        <label for="phone" class="text-left mb-1">Phone</label>
                        <input class="max-w-48" type="text" id="phone">
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
            const re = /^[A-Za-z0-9]+(?:\s[A-Za-z0-9]+)*$/;
            return re.test(name.trim());
        }
        const moreOptions = document.querySelector("#quote-step-one");
        let stepOneReady = false
        if (moreOptions !== null) {
            // check if form inputs are not empty before moving to next page
            moreOptions.addEventListener('click', (e) => {
                //e.preventDefault()
                let email = document.querySelector('input#email')
                let name = document.querySelector('input#name')
                let phone = document.querySelector('input#phone')
                if (email.value.trim() != '' && isValidEmail(email.value)) {
                    email.previousElementSibling.style.color = '#fff';
                    email.style.borderColor = "#fff"
                } else {
                    stepOneReady = false
                    email.previousElementSibling.style.color = '#FF0000';
                    email.style.borderColor = "#FF0000"
                }
                if (name.value.trim() != '' && isValidName(name.value)) {
                    name.previousElementSibling.style.color = '#fff';
                    name.style.borderColor = "#fff"
                } else {
                    stepOneReady = false
                    name.previousElementSibling.style.color = '#FF0000';
                    name.style.borderColor = "#FF0000"
                }

                if (name.value.trim() != '' && isValidEmail(email.value) && email.value.trim() != '' && isValidName(name.value)) {
                    stepOneReady = true
                }

                if (stepOneReady == true) {
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

            })

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