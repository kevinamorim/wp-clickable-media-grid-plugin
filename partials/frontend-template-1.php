<?php

if ( wp_is_mobile() == false ) {
    ?>

        <div class="cmg-templ-1-container">
            <div class="cmg-container--columns">
                <div class="cmg-img-container">
                    <?php
                        // #1
                        echo wp_get_attachment_image( $images_ids[0], 'full' );
                    ?>
                </div>
                <div class="cmg-container--row">
                    <div class="cmg-img-container">
                        <?php
                            // #2
                            echo wp_get_attachment_image( $images_ids[1], 'full' );
                        ?>
                    </div>
                    <div class="cmg-img-container">
                        <?php
                            // #3
                            echo wp_get_attachment_image( $images_ids[2], 'full' );
                        ?>
                    </div>
                </div>
                <div class="cmg-container--row">
                    <div class="cmg-img-container">
                        <?php
                            // #4
                            echo wp_get_attachment_image( $images_ids[3], 'full' );
                        ?>
                    </div>
                    <div class="cmg-img-container">
                        <?php
                            // #5
                            echo wp_get_attachment_image( $images_ids[4], 'full' );
                        ?>
                    </div>
                </div>
                <div class="cmg-img-container">
                    <?php
                        // #6
                        echo wp_get_attachment_image( $images_ids[5], 'full' );
                    ?>
                </div>
            </div>
            <div class="cmg-img-container">
                <?php
                    // #7
                    echo wp_get_attachment_image( $images_ids[6], 'full' );
                ?>
            </div>
        </div>


    <?php

} else {

    ?>
        <div class="cmg-templ-1-container">

            <div class="cmg-container--columns">
                <div class="cmg-img-container">
                    <?php
                        echo wp_get_attachment_image( 23, 'full' ); // Viagem
                    ?>
                </div>
                <div class="cmg-container--2-rows">
                    <div class="cmg-img-container">
                        <?php
                            echo wp_get_attachment_image( 21, 'full' ); // Cintos
                        ?>
                    </div>
                    <div class="cmg-img-container">
                        <?php
                            echo wp_get_attachment_image( 21,  'full' ); // Cintos
                        ?>
                    </div>
                </div>
            </div>

            <div class="cmg-container--columns">
                <div class="cmg-img-container">
                    <?php
                        echo wp_get_attachment_image( 21, 'full' ); // Cintos
                    ?>
                </div>
                <div class="cmg-img-container">
                    <?php
                        echo wp_get_attachment_image( 24, 'full' ); // Manutenção
                    ?>
                </div>
            </div>

            <div class="cmg-container--columns">
                <div class="cmg-img-container">
                    <?php
                        echo wp_get_attachment_image( 21, 'full' ); // Cintos
                    ?>
                </div>
                <div class="cmg-img-container">
                    <?php
                        echo wp_get_attachment_image( 24, 'full' ); // Manutenção
                    ?>
                </div>
            </div>

        </div>

        <?php
}