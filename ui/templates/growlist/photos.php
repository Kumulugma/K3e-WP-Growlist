<div class="wrap" id="K3eGrowlist">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Paczki zdjęć', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <div class="section">
                        <form method="post" action="admin.php?page=growlist_photos&save=form">
                            <div>
                                <div id="header">
                                    <h2><?= __('Konfiguracja dokumentu', 'k3e') ?></h2>
                                </div>
                                <div class="box">
                                    <div class="input">
                                        <label for="k3e_photo_album_date"><?= __('Data początkowa', 'k3e') ?></label>
                                        <input id="k3e_photo_album_date" type="date" name="PhotoAlbum[start_date]" value='<?= date('Y-m-d') ?>'>
                                        <input id="package_comment" type="text" name="PhotoAlbum[comment]" placeholder="<?= __('Komentarz', 'k3e') ?>">
                                
                                    </div>

                                    <div class="save">
                                        <input type='hidden' name="PhotoAlbum[checksum]" value="<?= md5(rand(0, 255)) ?>"/>
                                        <button class="button button-primary"  type="submit"><?= __('Wygeneruj', 'k3e') ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <h2 class="h5"><?= __('Wygenerowane albumy', 'k3e') ?></h2>
                    <div class="documents">
                        <?php
                        $args = array(
                            'post_type' => 'photo_album',
                            'order' => 'DESC',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        );

                        $files = new WP_Query($args);
                        ?>
                        <table id="files" class="table" data-counter="<?= $files->found_posts ?>">
                            <thead>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Paczka', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Komentarz', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Gotowe zdjęcia', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Wszystkie zdjecia', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Status', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Akcje', 'k3e') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($files->have_posts()) { ?>
                                    <?php $i = 1; ?>
                                    <?php while ($files->have_posts()) : $files->the_post(); ?>
                                        <tr id="row_<?= get_the_ID() ?>" data-form="0" data-nonce='<?= wp_create_nonce('k3e-photos-nonce') ?>'>
                                            <td><?= $i ?></td>
                                            <td>
                                                <?php if (get_post_meta(get_the_ID(), 'ready_photos', true) == get_post_meta(get_the_ID(), 'package_photos', true)) { ?>
                                                    <a href="/wp-content/uploads/<?= get_post_meta(get_post_meta(get_the_ID(), 'photo_package', true), '_wp_attached_file', true) ?>" style="text-decoration: none;"><?= get_the_title() ?></a>
                                                <?php } else { ?>
                                                    <?= get_the_title() ?>
                                                <?php } ?>
                                            </td>
                                            <td id="comment_<?= get_the_ID() ?>"><?= get_post_meta(get_the_ID(), 'document_comment', true) ?></td>
                                            <td><?= get_post_meta(get_the_ID(), 'ready_photos', true) ?></td>
                                            <td><?= get_post_meta(get_the_ID(), 'package_photos', true) ?></td>
                                            <td><?= (get_post_meta(get_the_ID(), 'package_status', true) == 'complete') ? __('Gotowe', 'k3e') : '' ?></td>
                                            <td>
                                                <button data-id="<?= get_the_ID() ?>" class="button button-primary btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>       
                                                <button data-id="<?= get_the_ID() ?>" class="button button-danger btn-remove"><i class="fa fa-trash" aria-hidden="true"></i></button>       
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endwhile; ?>
                                <?php } else { ?>
                                <td colspan="7" style="text-align: center;"><?= __('Brak paczek', 'k3e') ?></td>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Paczka', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Komentarz', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Gotowe zdjęcia', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Wszystkie zdjecia', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Status', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Akcje', 'k3e') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="section">
                        <form method="post" action="admin.php?page=growlist_photos&save=form">
                            <div class="box" id="forcePack">
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



