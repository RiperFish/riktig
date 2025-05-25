<?php /* Template Name: Contact template  */ ?>
<?php get_header(); ?>
<section class="about-hero-section pt-[68px] bg-accent pb-20 relative mb-24">
    <div class="container">
        <div class="flex justify-between">
            <div class="max-w-[570px]">
                <h1 class="mb-4">
                    Contacts
                </h1>
                <p class="text-white !text-[32px] font-normal mb-[30px]" style="font-family: 'Sen', sans-serif;">
                    Trenger du bistand innen Flytting eller Vask? Kontakt oss, så hjelper vi deg!
                </p>
                <div class="flex gap-10  mb-6">
                    <div>
                        <span class="block opacity-80 text-lg text-white">Riktig valg AS</span>
                        <span class="block opacity-80 text-lg text-white">Org. nr.: 913 942 000</span>
                        <span class="block opacity-80 text-lg text-white">Industriveien 10B,</span>
                        <span class="block opacity-80 text-lg text-white">1473 Lørenskog</span>
                    </div>
                    <div>
                        <span class="block opacity-80 text-lg text-white">
                            Tel: <a href="#">45800066</a></span>
                        <span class="block opacity-80 text-lg text-white underline">
                            <a href="mailto:">info@riktigflytting.no</a>
                        </span>
                    </div>
                </div>
                <p class="opacity-80">
                    Vårt hovedkontor befinnes i Lørenskog og Oslo, mens vi har flyttebiler stående og klart til oppdrag rundt overalt i Viken område.
                </p>
            </div>
            <div class="max-w-[605px] bg-[#F4F7FF] border border-[#E7EBF6] rounded-[50px] px-[76px] py-14">
                <h4 class="mb-[14px]">Send us a message</h4>
                <?php echo do_shortcode('[contact-form-7 id="739227a" title="Send a message form"]') ?>
            </div>
        </div>
    </div>

</section>

<section class="mb-16 our-team">
    <div class="container">
        <h2 class=" mb-14">Contact our team</h2>
        <div class="flex gap-8 justify-between">
            <div class="team-member flex justify-end bg-[#F4F7FF] rounded-[20px] border border-[#E7EBF6] relative px-4 max-w-[393px] max-h-[218px] w-full h-full pt-11 pb-14">
                <img src="<?php echo URL_BASE; ?>/images/team-member.png" class="absolute bottom-0 left-3">
                <div>
                    <span class="name text-[20px] text-[#2F4C94] font-medium block">Eduardas</span>
                    <span class="name text-lg text-[#3d3d3d] role block mb-5">Manager</span>
                    <a href="#" class="btn btn-secondary flex gap-1 items-center h-[45px] w-fit bg-white font-medium px-4 ">
                        <img width="26" src="<?php echo URL_BASE; ?>/images/phone-blue.svg" alt="<?php bloginfo('name'); ?>">
                        458-000-66
                    </a>
                </div>
            </div>
            <div class="team-member flex justify-end bg-[#F4F7FF] rounded-[20px] border border-[#E7EBF6] relative px-4 max-w-[393px] max-h-[218px] w-full h-full pt-11 pb-14">
                <img src="<?php echo URL_BASE; ?>/images/team-member.png" class="absolute bottom-0 left-3">
                <div>
                    <span class="name text-[20px] text-[#2F4C94] font-medium block">Eduardas</span>
                    <span class="name text-lg text-[#3d3d3d] role block mb-5">Manager</span>
                    <a href="#" class="btn btn-secondary flex gap-1 items-center h-[45px] w-fit bg-white font-medium px-4 ">
                        <img width="26" src="<?php echo URL_BASE; ?>/images/phone-blue.svg" alt="<?php bloginfo('name'); ?>">
                        458-000-66
                    </a>
                </div>
            </div>
            <div class="team-member flex justify-end bg-[#F4F7FF] rounded-[20px] border border-[#E7EBF6] relative px-4 max-w-[393px] max-h-[218px] w-full h-full pt-11 pb-14">
                <img src="<?php echo URL_BASE; ?>/images/team-member.png" class="absolute bottom-0 left-3">
                <div>
                    <span class="name text-[20px] text-[#2F4C94] font-medium block">Eduardas</span>
                    <span class="name text-lg text-[#3d3d3d] role block mb-5">Manager</span>
                    <a href="#" class="btn btn-secondary flex gap-1 items-center h-[45px] w-fit bg-white font-medium px-4 ">
                        <img width="26" src="<?php echo URL_BASE; ?>/images/phone-blue.svg" alt="<?php bloginfo('name'); ?>">
                        458-000-66
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-[#2F4C94] pt-20 pb-28">
    <div class="container text-center">
        <h1 class="mb-7">Get a price quote Today</h1>
        <div class="flex items-center w-fit gap-6 mx-auto">
            <img class=" rounded-full" width="62" src="<?php echo URL_BASE; ?>/images/avatar.jpg" alt="Manager">
            <div class=" px-7 py-2.5 bg-white rounded-br-[9px] rounded-bl-[9px] rounded-tr-[9px]">
                <span class="text-2xl opacity-80 text-[#2F4C94] font-bold text-[20px]">What services do you need?</span>
            </div>

        </div>
        <div class="buttons flex gap-8 text mt-9 justify-center">
            <a href="#" class="btn btn-secondary text-white">I Need a Moving</a>
            <a href="#" class="btn btn-secondary text-white">I Need a Cleaning</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>