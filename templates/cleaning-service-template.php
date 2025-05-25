<?php /* Template Name: Cleaning template  */ ?>
<?php get_header(); ?>
<section class="hero-section pt-[68px] bg-accent pb-20 relative mb-20">
    <div class="container">
        <div class="max-w-[562px]">
            <h1 class="mb-3">
                Cleaning
            </h1>
            <div class="flex items-center gap-5 mb-6">
                <img src="<?php echo URL_BASE; ?>/images/leaf-green.svg" alt="<?php bloginfo('name'); ?>">
                <span class="text-[20px] text-[#C0F942] font-bold">ECO Friendly materials</span>
            </div>
            <div class="mb-7">
                <p class="text-white opacity-80">
                    Then it may be appropriate to leave the cleaning of your house or apartment to professionals. We give you a guarantee so that you do not have to worry about whether the cleaning of your house or apartment will be approved by the new owner or the landlord. If they have any problems with the job, we will make sure that this is corrected so that you can concentrate on any unpacking and other tasks in your new home.
                </p>
            </div>
            <div class="buttons flex gap-8 text">
                <a href="#" class="btn btn-secondary text-white">Get a Quote</a>
            </div>
        </div>
    </div>
</section>

<section class=" mb-28">
    <div class="container">
        <div class="flex justify-between">
            <div class="max-w-[570px]">
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
            <div class="max-w-[605px] bg-[#F4F7FF] border border-[#E7EBF6] rounded-[50px] px-[45px] pt-14 pb-10">
                <h4 class="mb-[14px]">Get a Quote</h4>
                <?php echo do_shortcode('[contact-form-7 id="6f8552e" title="Cleaning quote form"]') ?>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>