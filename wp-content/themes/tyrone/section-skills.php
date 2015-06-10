<?php 

$skills = get_skills();

?>
 <!-- Skills Section -->
                <article class="hs-content skills-section" id="section3">
                    <span class="sec-icon fa fa-diamond"></span>
                    <div class="hs-inner">
                        <span class="before-title">.04</span>
                        <h2>EXPERIENCIA</h2>
                        <?php 
                        foreach($skills as $skill){ 

                            if( $skill['posts']->have_posts() ){ 

                                ?>
                                <span class="content-title text-uppercase"><?php echo $skill['category']->name; ?></span>
                                <?php
                            
                                while( $skill['posts']->have_posts() ){ 
                                    
                                    $skill['posts']->the_post(); 

                                    $post_meta = get_post_custom($post->ID);

                                    ?>

                                    <div class="skolls">                            
                                        <div class="bar-main-container">
                                            <div class="wrap">
                                                <div class="bar-percentage" data-percentage="<?php echo $post_meta['skill_percent'][0]; ?>"></div>                      
                                                <span class="label"><?php the_title(); ?></span><br><br>
                                                <span class="skill-detail text-uppercase">
                                                    <i class="fa fa-bar-chart"></i>
                                                    NIVEL : <?php echo $post_meta['skill_level'][0]; ?>
                                                </span>
                                                <span class="skill-detail right text-uppercase">
                                                <i class="fa fa-binoculars"></i>EXPERIENCIA : <?php echo $post_meta['skill_experience'][0]; ?></span>
                                                <div class="bar-container">
                                                    <div class="bar"></div>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                    </div> 

                                    <?php
                                } 
                            } 
                        } 
                        ?>                                       
                    </div>
                </article>
                <!-- End Skills Section -->