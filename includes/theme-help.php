
<section class="layers-area-wrapper">

	
    <div class="layers-onboard-wrapper">

        <div class="layers-onboard-controllers">
            <div class="onboard-nav-dots layers-pull-left" id="layers-onboard-anchors"></div>
            <a class="layers-button btn-link layers-pull-right" href="" id="layers-onboard-skip"><?php _e( 'Skip' , 'layers-child-demo' ); ?></a>
        </div>

        <div class="layers-onboard-slider">

            <!-- STEP 1 -->
            <div class="layers-onboard-slide layers-animate layers-onboard-slide-current">
                <div class="layers-column layers-span-4 postbox">
                    <div class="layers-content-large">
                        <!-- Your content goes here -->
                        <div class="layers-section-title layers-small layers-no-push-bottom">
                            <div class="layers-push-bottom-small">
                                <small class="layers-label label-secondary">
                                    <?php _e( 'Demo!' , 'layers-child-demo' ); ?>
                                </small>
                            </div>
                            <h3 class="layers-heading">
                                <?php _e( 'Thanks for Installing the Child Theme Demo!' , 'layers-child-demo' ); ?>
                            </h3>
                            <div class="layers-excerpt">
                                <p>
                                    <?php _e( 'This setup wizard serves as an introduction to your theme and any special options it may have.' , 'layers-child-demo' ); ?>
                                </p>
                                <ul>
                                    <li><a href="http://docs.layerswp.com/theming/" target="_blank"><?php _e( 'Open the Guide in a New Tab' , 'layers-child-demo' ); ?></a></li>
                                    <li><a href="http://docs.layerswp.com/how-to-add-help-pages-onboarding-to-layers-themes-or-extensions/" target="_blank"><?php _e( 'Open the Oboarding Tutorial' , 'layers-child-demo' ); ?></a></li>
                                </ul>    
                            </div>
                        </div>
                    </div>
                    <div class="layers-button-well">
                        <a class="layers-button btn-primary layers-pull-right onbard-next-step" href=""><?php _e( 'Got it, Next Step &rarr;' , 'layers-child-demo' ); ?></a>
                    </div>
                </div>
                <div class="layers-column layers-span-8 no-gutter layers-demo-video">
                    <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/help.jpg'; ?>" />
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="layers-onboard-slide layers-animate layers-onboard-slide-inactive">
                <div class="layers-column layers-span-4 postbox">
                    <div class="layers-content-large">
                        <!-- Your content goes here -->
                        <div class="layers-section-title layers-small layers-no-push-bottom">
                            <div class="layers-push-bottom-small">
                                <small class="layers-label label-secondary">
                                    <?php _e( 'Demo!' , 'layers-child-demo' ); ?>
                                </small>
                            </div>
                            <h3 class="layers-heading">
                                <?php _e( 'Add Video or Images' , 'layers-child-demo' ); ?>
                            </h3>
                            <div class="layers-excerpt">
                                <p>
                                    <?php _e( 'Using this wizard template, you can add an HTML5 video (mp4 format) by using the layers_show_html5_video() function in the right column, or simply add a screenshot or graphic illustrating your step. You may also add extended text or HTML in that column, but it must be compatible with the WordPress admin.' , 'layers-child-demo' ); ?>
                                </p>
                                 <p>
                                    <?php _e( 'Basic lists may be used to link your users to offsite resources too, such as your online documentation or companion products.' , 'layers-child-demo' ); ?>
                                </p>
                                <ul>
                                    <li><a href="http://docs.layerswp.com" target="_blank"><?php _e( 'View Our Documentation' , 'layers-child-demo' ); ?></a></li>
                                    <li><a href="http://docs.layerswp.com/support/" target="_blank"><?php _e( 'Get Support' , 'layers-child-demo' ); ?></a></li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                    <div class="layers-button-well">
                        <a class="layers-button btn-primary layers-pull-right" href="<?php echo admin_url( 'customize.php' ); ?>"><?php _e( 'Launch Customizer &rarr;' , 'layerswp' ); ?></a>
                    </div>
                </div>
                <div class="layers-column layers-span-8 no-gutter layers-demo-video">
                    <?php layers_show_html5_video( 'https://s3.amazonaws.com/cdn.oboxsites.com/layers/videos/storekit-widgets.mp4', 660 ); ?>
                </div>
            </div>
			
           
    

    </div>
</section>
