<div class="wrap" id="configuration-page">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Statystyki listy roślin', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:50%;">
                <div class="card" style="max-width: none; margin:2px">
                    <?php
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'posts_per_page' => -1
                    );

                    $species = new WP_Query($args);

                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'species_state',
                                'value' => '1',
                                'compare' => '='
                            )
                        ),
                    );

                    $correct = new WP_Query($args);
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'species_state',
                                'value' => '2',
                                'compare' => '='
                            )
                        ),
                    );

                    $sown = new WP_Query($args);
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'species_state',
                                'value' => '3',
                                'compare' => '='
                            )
                        ),
                    );

                    $in_flight = new WP_Query($args);
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'species_state',
                                'value' => '4',
                                'compare' => '='
                            )
                        ),
                    );

                    $lost = new WP_Query($args);
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'orderby' => 'title',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'species_state',
                                'value' => '5',
                                'compare' => '='
                            )
                        ),
                    );

                    $renew = new WP_Query($args);
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                        'meta_key' => '_thumbnail_id',
                    );

                    $thumbnails = new WP_Query($args);
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'species_photos',
                                'value' => 's:7:"s:0:"";";',
                                'compare' => '='
                            )
                        )
                    );

                    $no_photos = new WP_Query($args);
                    ?>
                    <h2><?= __('Informacje', 'k3e') ?></h2>

                    <table class="display" style="width:100%" >
                        <tbody>
                            <tr>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= __('Wszystkich gatunków', 'k3e') ?></td>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= $species->found_posts ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= __('Widocznych', 'k3e') ?></td>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= $correct->found_posts ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= __('W locie', 'k3e') ?></td>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= $in_flight->found_posts ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= __('Wysianych', 'k3e') ?></td>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= $sown->found_posts ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= __('Utraconych', 'k3e') ?></td>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= $lost->found_posts + $renew->found_posts ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= __('W poszukiwaniu', 'k3e') ?></td>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= $renew->found_posts ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= __('Bez miniatury', 'k3e') ?></td>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= $species->found_posts - $thumbnails->found_posts ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= __('Bez zdjęć', 'k3e') ?></td>
                                <td style="border-bottom: 1px solid #c3c4c7;"><?= $no_photos->found_posts ?></td>
                            </tr>
                    </table>
                    <?php $providers = get_terms('provider', array('hide_empty' => false,)) ?>
                    <h2><?= __('Dostawcy', 'k3e') ?></h2>
                    <table class="display" style="width:100%" >
                        <tbody>
                            <?php foreach ($providers as $provder) { ?>
                                <tr>
                                    <td style="border-bottom: 1px solid #c3c4c7;"><?= $provder->name ?></td>
                                    <td style="border-bottom: 1px solid #c3c4c7;"><?= $provder->count ?></td>
                                </tr>
                            <?php } ?>

                    </table>
                </div>
            </div>

            <div class="postbox-container" style="width:50%;">
                <div class="card" style="max-width: none; margin:2px">

                    <?php $volumes = get_terms('volume', array('hide_empty' => false,)) ?>
                    <?php $volumes = array_reverse($volumes); ?>
                    <h2><?= __('Roczniki', 'k3e') ?></h2>
                    <table class="display" style="width:100%" >
                        <tbody>
                            <?php foreach ($volumes as $volume) { ?>
                                <tr>
                                    <td style="border-bottom: 1px solid #c3c4c7;">
                                        <b><?= $volume->name ?>: <?= $volume->count ?></b>
                                        <hr>
                                        <?php foreach (get_terms('groups', array('hide_empty' => false,)) as $group) { ?>
                                            <?php
                                            $args = array(
                                                'post_type' => 'species',
                                                'posts_per_page' => -1,
                                                'tax_query' => array(
                                                    'relation' => 'AND',
                                                    array(
                                                        'taxonomy' => 'volume',
                                                        'field' => 'slug',
                                                        'terms' => $volume->slug
                                                    ),
                                                    array(
                                                        'taxonomy' => 'groups',
                                                        'field' => 'slug',
                                                        'terms' => $group->slug
                                                    )
                                                ),);
                                            ?>
                                            <?php $species = new WP_Query($args); ?>
                                            <?php if ($species->found_posts > 0) { ?>
                                                <div><?= $group->name ?>: <?= $species->found_posts ?></div>
                                            <?php } ?>
                                        <?php } ?>

                                    </td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>