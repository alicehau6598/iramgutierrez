<?php get_header(); ?>

    <?php get_template_part('section' , 'menu'); ?>           
        
        <!-- hs-content-scroller -->
        <div class="hs-content-scroller">

            <?php get_template_part('section' , 'top_menu'); ?>

            <!-- hs-content-wrapper -->
            <div class="hs-content-wrapper">    

                <?php get_template_part('section' , 'about_me'); ?>

                <?php get_template_part('section' , 'resume'); ?>

                <?php get_template_part('section' , 'skills'); ?>

                <?php get_template_part('section' , 'works'); ?>

                <?php get_template_part('section' , 'team'); ?>

                <?php get_template_part('section' , 'services'); ?>

                <?php get_template_part('section' , 'pricing'); ?>

                <?php get_template_part('section' , 'contact'); ?>

                <!-- Back Footer Section -->
                <article class="hs-content" id="back2">
                </article>
                <!-- Back Footer Section -->
            </div>
                <!-- End hs-content-wrapper -->
        </div>
            <!-- End hs-content-scroller -->

<?php get_footer(); ?>