</main>

<footer>
    <div class="bg-[#F8F8F8]">
        <div class="container ">
            <div class="py-8 flex items-center">
                <div class="logo mr-20">
                    <a href="<?php echo home_url(); ?>" aria-label="<?php bloginfo('name'); ?> Logo">
                        <img class="w-[133px]" src="<?php echo URL_BASE; ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
                    </a>
                </div>
                <div class="infos flex gap-[30px]">
                    <div>
                        <span class=" text-[#474747] opacity-80 text-base block">Riktig valg AS</span>
                        <span class=" text-[#474747] opacity-80 text-base block">Org. nr.: 913 942 000</span>
                    </div>
                    <div>
                        <span class=" text-[#474747] opacity-80 text-base block">Professor birkelands</span>
                        <span class=" text-[#474747] opacity-80 text-base block">vei 36, 1081 Oslo</span>
                    </div>
                    <div>
                        <span class=" text-[#474747] opacity-80 text-base block">458 000 66</span>
                        <span class=" text-[#] opacity-80 text-base block">
                            <a class="text-[#2F4C94]" href="mailto:info@riktigflytting.no">info@riktigflytting.no</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container py-[14px]">
            <p class="text-[#878787] opacity-80 text-sm">Riktig valg AS, <?php echo date("Y");?>, all rights reserved</p>
        </div>

    </div>


</footer>
<?php wp_footer(); ?>

</body>

</html>