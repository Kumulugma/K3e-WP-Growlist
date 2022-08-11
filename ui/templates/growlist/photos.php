<div class="wrap" id="configuration-page">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Paczki zdjęć', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <div class="k3e_box">
                        <style scoped>
                            .k3e_box{
                                display: grid;
                                grid-template-columns: max-content 1fr;
                                grid-row-gap: 10px;
                                grid-column-gap: 20px;
                            }
                            .k3e_field{
                                display: contents;
                            }
                        </style>
                        <form method="post" action="admin.php?page=growlist_photos&save=form">
                            <div>
                                <p class="meta-options k3e_field">
                                    <label for="k3e_photo_album_date"><?= __('Data początkowa', 'k3e') ?></label>
                                    <input id="k3e_photo_album_date" type="date" name="PhotoAlbum[start_date]" value='<?= date('Y-m-d') ?>'>
                                </p>   
                            </div>

                            <div  style="display: block; padding-top: 5px;">
                                <input type='hidden' name="PhotoAlbum[checksum]" value="<?= md5(rand(0, 255)) ?>"/>
                                <button class="button button-primary"  type="submit"><?= __('Wygeneruj', 'k3e') ?></button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <h2><?= __('Wygenerowane albumy', 'k3e') ?></h2>
                    <div class="k3e_box">
                        <?php
                        $args = array(
                            'post_type' => 'photo_album',
                            'order' => 'DESC',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        );

                        $files = new WP_Query($args);
                        ?>
                        <table id="growlist" class="display" style="width:100%" data-counter="<?= $files->found_posts ?>">
                            <thead>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Paczka', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Gotowe zdjęcia', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Wszystkie zdjecia', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Status', 'k3e') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($files->have_posts()) { ?>
                                    <?php $i = 1; ?>
                                    <?php while ($files->have_posts()) : $files->the_post(); ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td>
                                                <?php if (get_post_meta(get_the_ID(), 'ready_photos', true) == get_post_meta(get_the_ID(), 'package_photos', true)) { ?>
                                                    <a href="/wp-content/uploads/<?= get_post_meta(get_post_meta(get_the_ID(), 'photo_package', true), '_wp_attached_file', true) ?>" style="text-decoration: none;"><?= get_the_title() ?></a>
                                                <?php } else { ?>
                                                    <?= get_the_title() ?>
                                                <?php } ?>
                                            </td>
                                            <td><?= get_post_meta(get_the_ID(), 'ready_photos', true) ?></td>
                                            <td><?= get_post_meta(get_the_ID(), 'package_photos', true) ?></td>
                                            <td><?= (get_post_meta(get_the_ID(), 'package_status', true) == 'complete') ? __('Gotowe', 'k3e') : '' ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endwhile; ?>
                                <?php } else { ?>
                                <td colspan="2" style="text-align: center;"><?= __('Brak paczek', 'k3e') ?></td>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Paczka', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Gotowe zdjęcia', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Wszystkie zdjecia', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Status', 'k3e') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div>

                        <form method="post" action="admin.php?page=growlist_photos&save=form">
                            <div  style="display: block; padding-top: 5px;">
                                <input type='hidden' name="PhotoAlbum[checksum]" value="<?= md5(rand(0, 255)) ?>"/>
                                <button class="button button-secondary" name="PhotoAlbum[pack]" value="<?= __('Pakuj ręcznie', 'k3e') ?>" type="submit"><?= __('Pakuj ręcznie', 'k3e') ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
?>



