<?php 

$jobs = new WP_Query(
    [
        'post_type' => 'job',
        'meta_key'=>'job_init_date',  
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
                                                    <span><?php echo get_date($post_meta['job_init_date'][0] , 'm - Y')?></span>
                                                    <div class="separator"></div>
                                                    <span>
                                                    <?php 
                                                    if( !empty( $post_meta['job_current'][0] ) )
                                                    {
                                                        echo "ACTUAL";
                                                    }
                                                    else
                                                    {
                                                        echo get_date($post_meta['job_end_date'][0] , 'm - Y');
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
                                    <!--<li>
                                        <div class="resume-tag">
                                            <span class="fa fa-briefcase"></span>
                                            <div class="resume-date">
                                                <span>2011</span>
                                                <div class="separator"></div>
                                                <span>2015</span>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="timeline-location"><i class="fa fa-map-marker"></i>Distrito Federal</span>
                                            <h3 class="timeline-header">DESARROLLADOR WEB</h3>
                                            <div class="timeline-body">
                                                <h4>CLICKER 360</h4>
                                                <span>Desarrollo de múltiples sistemas y aplicaciones enfocadas al marketing digital.</span>
                                            </div>
                                        </div>
                                    </li>-->
                                </ul>
                            <?php 
                            }
                            ?>
                            <ul class="resume" >
                                <li class="time-label">
                                    <span class="content-title">FORMACIÓN</span>
                                </li>
                                <li>
                                    <div class="resume-tag">
                                        <span class="fa fa-graduation-cap"></span>
                                        <div class="resume-date">
                                            <span>2006</span>
                                            <div class="separator"></div>
                                            <span>2010</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <span class="timeline-location"><i class="fa fa-map-marker"></i>ESTADO DE MEXICO</span>
                                        <h3 class="timeline-header">INGENIERO EN COMPUTACIÓN</h3>
                                        <div class="timeline-body">
                                            <h4>UNIVERSIDAD AUTÓNOMA DEL ESTADO DE MÉXICO</h4>
                                            <span><!--Lorem ipsum dolor sit amet, consectetur adipiscingVivam sit amet ligula non lectus cursus egestas. Cras erat lorem.--></span>
                                        </div>
                                    </div>
                                </li>
                                <!-- End Resume timeline -->
                            </ul>
                        </div>
                        <!-- End Resume Wrapper -->
                    </div>
                </article>
                <!-- End Resume Section-->