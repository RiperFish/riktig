</main>

<footer>
    <div class="bg-[#F8F8F8]">
        <div class="container ">
            <div class="py-8 flex items-center">

                <div class="infos grid grid-cols-2 md:flex gap-[30px]">
                    <div class="logo md:mr-20 flex items-center">
                        <a href="<?php echo home_url(); ?>" aria-label="<?php bloginfo('name'); ?> Logo">
                            <img class="max-w-[120px] md:w-[133px]" src="<?php echo URL_BASE; ?>/images/logo.svg"
                                alt="<?php bloginfo('name'); ?>">
                        </a>
                    </div>
                    <?php if (get_option('company_name') || get_option('org_number')) { ?>
                        <div>
                            <?php if (get_option('company_name')) { ?>
                                <span
                                    class=" text-[#474747] opacity-80 text-sm md:text-base block"><?php echo get_option('company_name') ?></span>
                            <?php } ?>
                            <?php if (get_option('org_number')) { ?>
                                <span class=" text-[#474747] opacity-80 text-sm md:text-base block">Org. nr.:
                                    <?php echo get_option('org_number') ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (get_option('address')) { ?>
                        <div class=" max-w-[160px]">
                            <span
                                class=" text-[#474747] opacity-80 text-sm md:text-base block"><?php echo get_option('address') ?></span>
                            <!-- <span class=" text-[#474747] opacity-80 text-base block">Professor birkelands</span>
                        <span class=" text-[#474747] opacity-80 text-base block">vei 36, 1081 Oslo</span> -->
                        </div>
                    <?php } ?>
                    <?php if (get_option('company_phone') || get_option('email_input')) { ?>
                        <div>
                            <span
                                class=" text-[#474747] opacity-80 text-sm md:text-base block"><?php echo get_option('company_phone') ?></span>
                            <span class=" text-[#] opacity-80 text-sm md:text-base block">
                                <a class="text-[#2F4C94]"
                                    href="mailto:<?php echo get_option('address') ?>"><?php echo get_option('email_input') ?></a>
                            </span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container py-[14px]">
            <p class="text-[#878787] opacity-80 text-sm md:text-base">Riktig valg AS, <?php echo date("Y"); ?>, Alle rettigheter forbeholdt
            </p>
        </div>

    </div>


</footer>
<?php wp_footer(); ?>

</body>

</html>