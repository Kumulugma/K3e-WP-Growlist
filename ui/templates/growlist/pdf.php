<div class="wrap" id="configuration-page">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Listy PDF', 'k3e'); ?>
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
                        <form method="post" action="admin.php?page=growlist_pdf&save=form">
                            <div>
                                <p class="meta-options k3e_field">
                                    <label for="k3e_document_pdf_name"><?= __('Nazwa dokumentu', 'k3e') ?></label>
                                    <input id="k3e_document_pdf_name" type="text" name="Growlist[document_pdf_name]" value='<?= __('Lista roślin ', 'k3e') . date('Y-m-d H:i:s') ?>'>
                                </p>   
                            </div>
                            <div>
                                <h2><?= __('Status wpisów', 'k3e') ?></h2>
                                <p class="meta-options k3e_field">
                                    <input type="radio" id="k3e_labels_small" name="Growlist[species_status]" value="-1" checked>
                                    <label for="k3e_labels_small"><?= __('Wszystkie', 'k3e') ?></label>
                                    <br>
                                    <input type="radio" id="k3e_labels_1" name="Growlist[species_status]" value="1">
                                    <label for="k3e_labels_1"><?= __('Ok', 'k3e') ?></label>
                                    <br>
                                    <input type="radio" id="k3e_labels_2" name="Growlist[species_status]" value="2">
                                    <label for="k3e_labels_2"><?= __('Wysiew', 'k3e') ?></label>
                                    <br>
                                    <input type="radio" id="k3e_labels_3" name="Growlist[species_status]" value="3">
                                    <label for="k3e_labels_3"><?= __('Leci', 'k3e') ?></label>
                                    <br>
                                    <input type="radio" id="k3e_labels_4" name="Growlist[species_status]" value="4">
                                    <label for="k3e_labels_4"><?= __('Nie przetrwał', 'k3e') ?></label>
                                    <br>
                                    <input type="radio" id="k3e_labels_5" name="Growlist[species_status]" value="5">
                                    <label for="k3e_labels_5"><?= __('Ponownie poszukiwany', 'k3e') ?></label>

                                </p>
                            </div>
                            <div  style="display: block; padding-top: 5px;">
                                <input type='hidden' name="Growlist[PDF]" value="<?= md5(rand(0, 255)) ?>"/>
                                <button class="button button-primary"  type="submit">Wygeneruj</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <h2><?= __('Wygenerowane dokumenty', 'k3e') ?></h2>
                    <div class="k3e_box">
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
                        <table id="growlist" class="display" style="width:100%" data-counter="<?= $files->found_posts ?>">
                            <thead>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Dokument', 'k3e') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($files->have_posts()) { ?>
                                    <?php $i = 1; ?>
                                    <?php while ($files->have_posts()) : $files->the_post(); ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><a href="<?= wp_get_attachment_url(get_the_ID()) ?>" style="text-decoration: none;"><?= get_the_title() ?></a></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endwhile; ?>
                                <?php } else { ?>
                                <td colspan="2" style="text-align: center;"><?= __('Brak wspisów', 'k3e') ?></td>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: left;"><?= __('Lp.', 'k3e') ?></th>
                                    <th style="text-align: left;"><?= __('Dokument', 'k3e') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






