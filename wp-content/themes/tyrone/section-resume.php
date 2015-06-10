<?php 

$jobs = new WP_Query(
    [
        'post_type' => 'job',
        'meta_key'=>'job_init_date',  
        'order' => 'desc'
    ]
);

$schools = new WP_Query(
    [
        'post_type' => 'school',
        'meta_key'=>'school_init_date',  
        'order' => 'desc'
    ]
);


?>

<!-- Resume Section -->
                <article class="hs-content resume-section" id="section2">
                    <span class="sec-icon fa fa-newspaper-o"></span>
                    <div class="hs-inner">
                        <span class="before-title">.02</span>
                        <h2>EMPLEO Y FORMACIÓN</h2>
                        <!-- Resume Wrapper -->
                        <div class="resume-wrapper">                        
                            <?php     
                            if($jobs->have_posts())
                            {
                            ?>
                                <ul class="resume">
                                    <!-- Resume timeline -->     
                                    <li class="time-label">
                                        <span class="content-title">EMPLEO</span>
                                    </li>  
                                    <?php 
                                    while($jobs->have_posts()){
                                        $jobs->the_post();

                                        $post_meta = get_post_custom($post->ID);
                                    ?>                              
                                        <li>
                                            <div class="resume-tag">
                                                <span class="fa fa-briefcase"></span>
                                                <div class="resume-date">
                                                    <span><?php echo get_date($post_meta['job_init_date'][0] , 'Y')?></span>
                                                    <div class="separator"></div>
                                                    <span>
                                                    <?php 
                                                    if( !empty( $post_meta['job_current'][0] ) )
                                                    {
                                                        echo "ACTUAL";
                                                    }
                                                    else
                                                    {
                                                        echo get_date($post_meta['job_end_date'][0] , 'Y');
                                                    }
                                                    ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="timeline-item">
                                                <span class="timeline-location"><i class="fa fa-map-marker"></i><?php echo $post_meta['job_city'][0]; ?></span>
                                                <h3 class="timeline-header"><?php echo $post_meta['job'][0]; ?></h3>
                                                <div class="timeline-body">
                                                    <h4><?php echo $post_meta['job_company'][0]; ?></h4>
                                                    <span><?php echo $post_meta['job_description'][0]; ?></span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php 
                                    }
                                    ?>
                                </ul>
                            <?php 
                            }
                            ?>

                            <?php     
                            if($schools->have_posts())
                            {
                            ?>
                                <ul class="resume" >
                                    <li class="time-label">
                                        <span class="content-title">FORMACIÓN</span>
                                    </li>
                                    <?php 
                                    while($schools->have_posts()){
                                        $schools->the_post();

                                        $post_meta = get_post_custom($post->ID);
                                    ?>  
                                        <li>
                                            <div class="resume-tag">
                                                <span class="fa fa-graduation-cap"></span>
                                                <div class="resume-date">
                                                     <span><?php echo get_date($post_meta['school_init_date'][0] , 'Y')?></span>
                                                    <div class="separator"></div>
                                                    <span>
                                                    <?php 
                                                    if( !empty( $post_meta['school_current'][0] ) )
                                                    {
                                                        echo "ACTUAL";
                                                    }
                                                    else
                                                    {
                                                        echo get_date($post_meta['school_end_date'][0] , 'Y');
                                                    }
                                                    ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="timeline-item">
                                                <span class="timeline-location"><i class="fa fa-map-marker"></i><?php echo $post_meta['school_city'][0]; ?></span>
                                                <h3 class="timeline-header"><?php echo $post_meta['school_degree'][0]; ?></h3>
                                                <div class="timeline-body">
                                                    <h4><?php echo $post_meta['school'][0]; ?></h4>
                                                    <span><!--Lorem ipsum dolor sit amet, consectetur adipiscingVivam sit amet ligula non lectus cursus egestas. Cras erat lorem.--></span>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- End Resume timeline -->                                    
                                    <?php 
                                    }
                                    ?>
                                </ul>
                            <?php 
                            }
                            ?>
                        </div>
                        <!-- End Resume Wrapper -->
                    </div>
                </article>
                <!-- End Resume Section-->