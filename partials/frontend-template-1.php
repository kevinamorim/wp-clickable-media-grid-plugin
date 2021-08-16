<?php

if ( wp_is_mobile() == false ) {
    ?>

        <div class="cmg-templ-1-container">
            <div class="cmg-container--columns">
                <div class="cmg-img-container">
                    <a href="<?php echo $buttons_desktop[1]; ?>">
                    <?php
                        // #1
                        echo wp_get_attachment_image( $images_desktop_ids[0], 'full', '', [ 'class' => 'cmg-img-hover-zoom']  );
                    ?>
                    <span class="cmg-category-link"><?php echo $buttons_desktop[0] ?></span>
                    </a>
                </div>
                <div class="cmg-container--row">
                    <div class="cmg-img-container">
                        <a href="<?php echo $buttons_desktop[3]; ?>">
                        <?php
                            // #2
                            echo wp_get_attachment_image( $images_desktop_ids[1], 'full', '', [ 'class' => 'cmg-img-hover-zoom']  );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_desktop[2] ?></span>
                        </a>
                    </div>
                    <div class="cmg-img-container">
                        <a href="<?php echo $buttons_desktop[5]; ?>">
                        <?php
                            // #3
                            echo wp_get_attachment_image( $images_desktop_ids[2], 'full', '', [ 'class' => 'cmg-img-hover-zoom'] );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_desktop[4] ?></span>
                        </a>
                    </div>
                </div>
                <div class="cmg-container--row">
                    <div class="cmg-img-container">
                        <a href="<?php echo $buttons_desktop[7]; ?>">
                        <?php
                            // #4
                            echo wp_get_attachment_image( $images_desktop_ids[3], 'full', '', [ 'class' => 'cmg-img-hover-zoom']  );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_desktop[6] ?></span>
                        </a>
                    </div>
                    <div class="cmg-img-container">
                        <a href="<?php echo $buttons_desktop[9]; ?>">
                        <?php
                            // #5
                            echo wp_get_attachment_image( $images_desktop_ids[4], 'full', '', [ 'class' => 'cmg-img-hover-zoom']  );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_desktop[8] ?></span>
                        </a>
                    </div>
                </div>
                <div class="cmg-img-container">
                    <a href="<?php echo $buttons_desktop[11]; ?>">
                    <?php
                        // #6
                        echo wp_get_attachment_image( $images_desktop_ids[5], 'full', '', [ 'class' => 'cmg-img-hover-zoom']  );
                    ?>
                    <span class="cmg-category-link"><?php echo $buttons_desktop[10] ?></span>
                    </a>
                </div>
            </div>
            <div class="cmg-img-container">
                <a href="<?php echo $buttons_desktop[13]; ?>">
                <?php
                    // #7
                    echo wp_get_attachment_image( $images_desktop_ids[6], 'full', '', [ 'class' => 'cmg-img-hover-zoom']  );
                ?>
                <span class="cmg-category-link"><?php echo $buttons_desktop[12] ?></span>
                </a>
            </div>
        </div>


    <?php

} else {

    ?>
        <div class="cmg-templ-1-container">

            <div class="cmg-container--columns">
                <div class="cmg-img-container">
                    <a href="<?php echo $buttons_mobile[1]; ?>">
                        <?php
                            echo wp_get_attachment_image( $images_mobile_ids[0], 'full' );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_mobile[0] ?></span>
                    </a>
                </div>
                <div class="cmg-container--2-rows">
                    <div class="cmg-img-container">
                        <a href="<?php echo $buttons_mobile[3]; ?>">
                            <?php
                                echo wp_get_attachment_image( $images_mobile_ids[1], 'full' );
                            ?>
                            <span class="cmg-category-link"><?php echo $buttons_mobile[2] ?></span>
                        </a>
                    </div>
                    <div class="cmg-img-container">
                        <a href="<?php echo $buttons_mobile[5]; ?>">
                            <?php
                                echo wp_get_attachment_image( $images_mobile_ids[2],  'full' );
                            ?>
                            <span class="cmg-category-link"><?php echo $buttons_mobile[4] ?></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="cmg-container--columns">
                <div class="cmg-img-container">
                    <a href="<?php echo $buttons_mobile[7]; ?>">
                        <?php
                            echo wp_get_attachment_image( $images_mobile_ids[3], 'full' );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_mobile[6] ?></span>
                    </a>
                </div>
                <div class="cmg-img-container">
                    <a href="<?php echo $buttons_mobile[9]; ?>">
                        <?php
                            echo wp_get_attachment_image( $images_mobile_ids[4], 'full' );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_mobile[8] ?></span>
                    </a>
                </div>
            </div>

            <div class="cmg-container--columns">
                <div class="cmg-img-container">
                    <a href="<?php echo $buttons_mobile[11]; ?>">
                        <?php
                            echo wp_get_attachment_image( $images_mobile_ids[5], 'full' );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_mobile[10] ?></span>
                    </a>
                </div>
                <div class="cmg-img-container">
                    <a href="<?php echo $buttons_mobile[13]; ?>">
                        <?php
                            echo wp_get_attachment_image( $images_mobile_ids[6], 'full' );
                        ?>
                        <span class="cmg-category-link"><?php echo $buttons_mobile[12] ?></span>
                    </a>
                </div>
            </div>

        </div>

        <?php
}