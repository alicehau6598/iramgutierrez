<?php

$video_id = get_theme_mod('video_youtube_id', false); 

$email_contact = get_theme_mod('email_contact', false);

$phone_contact = get_theme_mod('phone_contact', false);

$latitude = get_theme_mod('latitude', false);

$longitude = get_theme_mod('longitude', false);

$place = get_theme_mod('place', false);

$bio = get_page_by_title('Bio');

$queryBio = false;

if($bio)
{
    $queryBio = new WP_Query(
        [
            'page_id' => $bio->ID
        ]
    );
}

$hobbies = new WP_Query(
    [
        'post_type' => 'hobby',
        'order' => 'asc'
    ]
);

$facts = new WP_Query(
    [
        'post_type' => 'fact',
        'order' => 'asc'
    ]
);

?>
<!-- About section -->        
                <article class="hs-content about-section" id="section1">
                    <span class="sec-icon fa fa-home"></span>
                    <div class="hs-inner">
                        <span class="before-title">.01</span>
                        <h2>SOBRE MÍ</h2>
                        <span class="content-title">PERFIL</span>
                        
                        <div class="aboutInfo-contanier">
                            <div class="about-card">
                                <div class="face2 card-face">
                                    <?php if($latitude && $longitude){ ?>
                                    <div id="cd-google-map"  data-latitude="<?php echo $latitude; ?>" data-longitude="<?php echo $longitude; ?>">
                                        <div id="google-container"></div>
                                        <address><?php echo $place; ?></address>
                                        <div class="back-cover" data-card-back="data-card-back">
                                            <i class="fa fa-long-arrow-left"></i>
                                        </div>

                                        <div id="cd-zoom-in"></div>
                                        <div id="cd-zoom-out"></div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="face1 card-face">
                                    <div class="about-cover card-face">

                                        <?php if($video_id){ ?>

                                            <!-- HEADER OVERLAY --> 
                                            <div class="lj-overlay lj-overlay-color"></div>
                                            <!-- /HEADER OVERLAY -->

                                            <!-- YOUTUBE PLAYER -->
                                            <div class="yt-player" data-property="{videoURL:'http://youtu.be/<?php echo $video_id; ?>', containment:'div.about-cover', startAt:0, mute:true, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:100}"></div>
                                       
                                        <?php } ?>
                                         <?php if($latitude && $longitude){ ?>
                                        <a class="map-location" data-card-front="data-card-front"><img src="<?php bloginfo('template_directory')?>/images/map-icon.png" alt="">
                                        </a>
                                        <?php } ?>
                                        <div class="about-details">
                                            <?php if($email_contact){ ?>
                                            <div>
                                                <span class="fa fa-inbox"></span><span class="detail"><?php echo $email_contact; ?></span>
                                            </div>
                                            <?php } ?>
                                            <?php if($phone_contact){ ?>
                                            <div>
                                                <span class="fa fa-phone"></span><span class="detail"><?php echo $phone_contact; ?></span>
                                            </div>
                                            <?php } ?>
                                        </div>

                                        <div class="cover-content-wrapper">

                                            <span class="status col-xs-6 " >
                                                <span class="fa fa-circle"></span>
                                                <span class="text"><strong>Freelance</strong></span>
                                            </span>

                                            <?php if($video_id){ ?>

                                            <div class="col-xs-6 yt-controls" data-scroll-reveal="wait 1.75s, then enter right and move 20px over 1s">
                                            
                                                    <a id="yt-volume" class="fa fa-volume-off" href="#">&nbsp;</a>
                                            
                                                    <a id="yt-play" class="fa fa-pause" href="#">&nbsp;</a>
                                            
                                            </div>

                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="more-details">
                                <div class="tabbable tabs-vertical tabs-left">
                                    <ul id="myTab" class="nav nav-tabs">
                                        <?php if($bio){ ?>
                                        <li class="active">
                                            <a href="#bio" data-toggle="tab"><?php echo $bio->post_title;?></a>
                                        </li>
                                        <?php } ?>
                                        <?php if($hobbies->have_posts()){ ?>
                                        <li>
                                            <a href="#hobbies" data-toggle="tab">Hobbies</a>
                                        </li>
                                        <?php } ?>
                                        <?php if($facts->have_posts()){ ?>
                                        <li>
                                            <a href="#facts" data-toggle="tab">Logros</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <?php        
                                        if($queryBio->have_posts()){
                                            while ($queryBio->have_posts()){
                                                $queryBio->the_post();
                                        ?>
                                        <div class="tab-pane fade in active" id="bio">
                                            <h3><?php echo strtoupper(get_the_title()); ?></h3>
                                            <h4></h4>
                                            <?php the_content(); ?>
                                        </div>                                                
                                        <?php

                                            } 
                                        }
                                        ?>
                                        <?php     
                                        if($hobbies->have_posts())
                                        {
                                        ?>

                                        <div class="tab-pane fade" id="hobbies">
                                            <h3>HOBBIES</h3>
                                            <h4>INTERESES</h4>
                                            <?php
                                            while($hobbies->have_posts()){

                                                $hobbies->the_post();

                                                $icon = get_post_meta( get_the_id(), 'hobby_icon', true );
                                                ?>
                                                <div class="hobbie-wrapper row">
                                                    <div class="hobbie-icon col-md-3"><i class="fa <?php echo $icon; ?>"></i>
                                                    </div>
                                                    <div class="hobbie-description col-md-9">
                                                        <?php the_content(); ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <?php
                                            }
                                            ?>
                                            <div style="clear:both;"></div>
                                        </div>
                                            <?php
                                        }
                                        ?>

                                        <?php     
                                        if($facts->have_posts())
                                        {
                                        ?>
                                        
                                        <div class="tab-pane fade" id="facts">
                                            <h3>LOGROS</h3>
                                            <h4>MIS NÚMEROS</h4>
                                            <?php
                                            while($facts->have_posts()){

                                                $facts->the_post();

                                                $icon = get_post_meta( get_the_id(), 'fact_icon', true );

                                                $quantity = get_post_meta( get_the_id(), 'fact_quantity', true );
                                                ?>
                                            <div class="facts-wrapper col-md-6">
                                                <div class="facts-icon"><i class="fa <?php echo $icon; ?>"></i>
                                                </div>
                                                <div class="facts-number"><?php echo $quantity; ?></div>
                                                <div class="facts-description"><?php echo wp_strtoupper(get_the_title()); ?></div>
                                            </div>
                                                <?php
                                            }
                                            ?>                                            
                                            <div style="clear:both;"></div>
                                        </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </article>
                <!-- End About Section -->