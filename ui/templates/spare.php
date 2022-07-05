<div class="wrap" id="configuration-page">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Lista nadmiarowych', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <?php
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
                        'meta_query' => array(
                            array(
                                'key' => 'species_spare',
                                'value' => '1',
                                'compare' => '='
                            )
                        ),
                    );

                    $species = new WP_Query($args);
                    ?>
                    <table id="growlist" class="display" style="width:100%" data-counter="<?= $species->found_posts ?>">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Lp.</th>
                                <th style="text-align: left;">Kod</th>
                                <th style="text-align: left;">Nazwa</th>
                                <th style="text-align: left;">Grupa</th>
                                <th style="text-align: left;">Komentarz</th>
                                <th style="text-align: left;">Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($species->have_posts()) { ?>
                                <?php $i = 1; ?>
                                <?php while ($species->have_posts()) : $species->the_post(); ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= get_post_meta(get_the_ID(), 'species_code', true) ?: '' ?></td>
                                        <td><a href="/wp-admin/post.php?action=edit&post=<?= get_the_ID() ?>" style="text-decoration: none;"><?=get_the_title()?> <?= get_post_meta(get_the_ID(), 'species_name', true) ?></a></td>
                                        <td>
                                            <?php foreach (get_the_terms(get_the_ID(), 'groups') as $group) { ?>
                                                <?= $group->name ?> 
                                            <?php } ?>
                                        </td>
                                        <td><?= get_post_meta(get_the_ID(), 'species_comment', true) ?></td>
                                        <td><?= get_post_meta(get_the_ID(), 'species_spare_price', true) ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endwhile; ?>
                            <?php } else { ?>
                            <td colspan="9" style="text-align: center;">Brak danych</td>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: left;">Lp.</th>
                                <th style="text-align: left;">Kod</th>
                                <th style="text-align: left;">Nazwa</th>
                                <th style="text-align: left;">Grupa</th>
                                <th style="text-align: left;">Komentarz</th>
                                <th style="text-align: left;">Cena</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>