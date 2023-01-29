<div class="wrap" id="K3eGrowlist">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Listy PDF', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <div class="section">
                        <form method="post" action="admin.php?page=growlist_pdf&save=form">
                            <div>
                                <div id="header">
                                    <h2><?= __('Konfiguracja dokumentu', 'k3e') ?></h2>
                                </div>
                                <div class="box">
                                    <div class="input">
                                        <label for="k3e_document_pdf_name"><?= __('Nazwa dokumentu', 'k3e') ?></label>
                                        <input id="k3e_document_pdf_name" type="text" name="Growlist[document_pdf_name]" value='<?= __('Lista roślin ', 'k3e') . date('Y-m-d H:i:s') ?>'>
                                        <input id="package_comment" type="text" name="Growlist[document_comment]" placeholder="<?= __('Komentarz', 'k3e') ?>">
                                    </div>
                                    <div class="select">
                                        <select name="Growlist[species_status]">
                                            <option value="-1"><?= __('Wszystkie', 'k3e') ?></option>
                                            <option value="1"><?= __('Ok', 'k3e') ?></option>
                                            <option value="2"><?= __('Wysiew', 'k3e') ?></option>
                                            <option value="3"><?= __('Nie przetrwał', 'k3e') ?></option>
                                        </select>
                                    </div>
                                    <div class="save">
                                        <input type='hidden' name="Growlist[PDF]" value="<?= md5(rand(0, 255)) ?>"/>
                                        <button class="button button-primary"  type="submit">Wygeneruj</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <h2 class="h5"><?= __('Wygenerowane dokumenty', 'k3e') ?></h2>
                    <div class="documents">
                        <?php
                        $args = array(
                            'post_type' => 'attachment',
                            'order' => 'DESC',
                            'post_status' => 'inherit',
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                array(
                                    'key' => '_growlist_document',
                                    'compare' => 'EXISTS'
                                )
                            ),
                        );

                        $files = new WP_Query($args);
                        ?>
                        <table id="files" class="table" data-counter="<?= $files->found_posts ?>">
                            <thead>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Dokument', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Komentarz', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Akcje', 'k3e') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($files->have_posts()) { ?>
                                    <?php $i = 1; ?>
                                    <?php while ($files->have_posts()) : $files->the_post(); ?>
                                        <tr id="row_<?= get_the_ID() ?>" data-form="0" data-nonce='<?= wp_create_nonce('k3e-list-nonce') ?>'>
                                            <td><?= $i ?></td>
                                            <td><a href="<?= wp_get_attachment_url(get_the_ID()) ?>" style="text-decoration: none;"><?= get_the_title() ?></a></td>
                                            <td id="comment_<?= get_the_ID() ?>"><?= get_post_meta(get_the_ID(), '_document_comment', true) ?></td>
                                            <td>
                                                <button data-id="<?= get_the_ID() ?>" class="button button-primary btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>       
                                                <button data-id="<?= get_the_ID() ?>" class="button button-danger btn-remove"><i class="fa fa-trash" aria-hidden="true"></i></button>       
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endwhile; ?>
                                <?php } else { ?>
                                <td colspan="4" style="text-align: center;"><?= __('Brak wspisów', 'k3e') ?></td>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Dokument', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Komentarz', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Akcje', 'k3e') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






