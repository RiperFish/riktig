<?php /* Template Name: Cleaning template  */ ?>
<?php get_header(); ?>
<section class="hero-section template-hero-section bg-accent relative lg:mb-20">
    <div class="outer-container relative mx-auto" style="max-width: 1440px;">
        <div class="container" style="margin-inline: unset;">
            <div class="text-container max-w-[570px] pt-[68px] pb-20 ml-20">
                <h1 class="mb-3">
                    <?php the_title(); ?>
                </h1>
                <?php
                $args = [
                    'post_type' => 'page',
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'home.php',
                    'posts_per_page' => 1,          // only need one
                ];
                $pages = get_posts($args);
                ?>
                <div class="flex items-center gap-5 mb-6">
                    <img src="<?php echo URL_BASE; ?>/images/leaf-green.svg" alt="<?php bloginfo('name'); ?>">
                    <span
                        class="text-[20px] text-[#C0F942] font-bold"><?php echo get_field('cleaning_section', $pages[0]->ID)['key_feature']; ?></span>

                </div>
                <div class="mb-7">
                    <p class="text-white opacity-80">
                        <?php echo get_field('hero_section')['paragraph']; ?>
                    </p>
                </div>
                <div class="buttons flex gap-8 text">
                    <a href="<?php echo home_url(); ?>/#get-quote" class="btn btn-secondary text-white">Få
                        pristilbud</a>
                </div>
            </div>
            <div class="hero-img">
                <?php if (get_field('hero_section')['hero_image']): ?>
                    <img class="h-full" src="<?php echo get_field('hero_section')['hero_image']; ?>"
                        alt="<?php bloginfo('name'); ?>" />
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<section class=" mb-0 md:mb-28 -mt-14 md:mt-0">
    <div class="container">
        <div class="flex flex-col lg:flex-row lg:gap-10 justify-between">
            <div class="max-w-[570px]">
                <h4 class="max-w-[420px] mb-[26px]">Standard flyttevask inkluderer:</h4>
                <div class="template-more-content list-check">
                    <?php echo get_field('hero_section')['editor']; ?>
                    <!-- <ul>
                        <li class="flex items-center gap-4 text-black mb-[23px] leading-[130%]">
                            <img src="<?php echo URL_BASE; ?>/images/check-green.svg" alt="<?php bloginfo('name'); ?>">
                            Cleaning of all cabinets and drawers (inside and outside);
                        </li>
                    </ul> -->
                </div>

            </div>
            <div
                class="lg:max-w-[605px] bg-[#F4F7FF] border border-[#E7EBF6] md:rounded-[50px] -mx-4 md:mx-0 mt-4 px-4 md:px-11 pt-8 md:pt-14 pb-10">
                <h4 class="mb-[14px]">Få pristilbud</h4>
                <?php echo do_shortcode('[contact-form-7 id="6f8552e" title="Cleaning quote form"]') ?>
            </div>
        </div>

    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/sv.js"></script>
<script>
    flatpickr("#date", {
        dateFormat: "d/m/Y",
        locale: "sv"
    });
</script>
<?php get_footer(); ?>