<div class="wrap" id="configuration-page">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Lista roślin', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <?php
                    $args = array(
                        'post_type' => 'species',
                        'order' => 'ASC',
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
                                <th style="text-align: left;">Stan</th>
                                <th style="text-align: left;">Komentarz</th>
                                <th style="text-align: left;">Pochodzenie</th>
                                <th style="text-align: left;">Rok</th>
                                <th style="text-align: left;">Zdjęcia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($species->have_posts()) { ?>
                                <?php $i = 1; ?>
                                <?php while ($species->have_posts()) : $species->the_post(); ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= get_post_meta(get_the_ID(), 'species_code', true) ?: '' ?></td>
                                        <td><a href="/wp-admin/post.php?action=edit&post=<?= get_the_ID() ?>" style="text-decoration: none;"><?= get_the_title() ?> <?= get_post_meta(get_the_ID(), 'species_name', true) ?></a></td>
                                        <td>
                                            <?php foreach (get_the_terms(get_the_ID(), 'groups') as $group) { ?>
                                                <?= $group->name ?> 
                                            <?php } ?>
                                        </td>
                                        <td><?= get_post_meta(get_the_ID(), 'species_state', true) ?></span></td>
                                        <td><?= get_post_meta(get_the_ID(), 'species_comment', true) ?></td>
                                        <td>
                                            <?php foreach (get_the_terms(get_the_ID(), 'provider') as $provider) { ?>
                                                <?= $provider->name ?> 
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <?php foreach (get_the_terms(get_the_ID(), 'volume') as $volume) { ?>
                                                <?= $volume->name ?> 
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php
                                            $post_images = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true)));
                                            ?>
                                            <?= count($post_images) - 1 ?>
                                        </td>
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
                                <th style="text-align: left;">Stan</th>
                                <th style="text-align: left;">Komentarz</th>
                                <th style="text-align: left;">Pochodzenie</th>
                                <th style="text-align: left;">Rok</th>
                                <th style="text-align: left;">Zdjęcia</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>