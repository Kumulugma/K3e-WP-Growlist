<div class="wrap" id="configuration-page">
    <h1 class="wp-heading-inline">
        <?php esc_html_e('Poszukiwane okazy', 'k3e'); ?>
    </h1>


    <div id="dashboard-widgets-wrap">
        <div id="dashboard-widgets" class="metabox-holder">
            <div class="postbox-container" style="width:100%;">
                <div class="card" style="max-width: none; margin:2px">
                    <?php
                    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
                    ?>
                    <?php $wishlist = unserialize(get_option('wishlist')); ?>

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
                        <form method="post" action="admin.php?page=wishlist&save=form">
                            <div class="meta-options k3e_field" style="display: block;">
                                <label for="k3e_wishlist"><?= __('Poszukiwane', 'k3e') ?></label>
                            </div>
                            <div class="meta-options k3e_field" style="display: block;">
                                <textarea id="k3e_wishlist" name="Growlist[wishlist]" cols="240" rows="20"><?= $wishlist ?></textarea>
                            </div>
                            <div  style="display: block;">
                                <button class="button button-primary" type="submit">Zapisz</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

