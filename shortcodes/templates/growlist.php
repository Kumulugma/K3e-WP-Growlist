<ul class="nav nav-tabs justify-content-center" id="myGrowlistTabs" role="tablist">
    <?php $i = 1; ?>
    <?php foreach (get_terms('groups', array('hide_empty' => false,)) as $group) { ?>
        <li class="nav-item">
            <a class="nav-link <?= ($i == 1 ? 'active' : '') ?>" id="<?= $group->slug ?>-tab" data-toggle="tab" href="#<?= $group->slug ?>" role="tab" aria-controls="<?= $group->slug ?> " aria-selected="true">
                <img src="<?=wp_get_attachment_image_url(get_term_meta($group->term_id, 'k3e_groups_img', true), 'big-icons')?>" class="rounded mt-2" alt="<?= $group->name ?>" data-toggle="tooltip" title="<?= $group->name ?>">
            </a>
        </li> 
        <?php $i++; ?>
    <?php } ?>
</ul>
<div class="tab-content" id="myGrowlist">
    <?php $j = 1; ?>
    <?php foreach (get_terms('groups', array('hide_empty' => false,)) as $group) { ?>

        <?php
        $args = array(
            'post_type' => 'species',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'title',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'groups',
                    'field' => 'slug',
                    'terms' => $group->slug
                )
            ),
            'meta_query' => array(
                array(
                    'key' => 'species_state',
                    'value' => '1',
                    'compare' => '='
                )
            )
        );
        ?>    
        <div class="tab-pane fade show <?= ($j == 1 ? 'active' : '') ?>" id="<?= $group->slug ?>" role="tabpanel" aria-labelledby="<?= $group->slug ?>-tab">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%"><?= __('Lp.', 'k3e') ?></th>
                        <th scope="col" style="width: 10%"><?= __('Kod', 'k3e') ?></th>
                        <th scope="col"><?= __('Gatunek', 'k3e') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php
                    $species = new WP_Query($args);
                    if ($species->have_posts()) :
                        while ($species->have_posts()) : $species->the_post();
                            ?>

                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td>
                                    <a href="<?= get_permalink(get_the_ID()) ?>"><?= get_post_meta(get_the_ID(), "species_code", true) ?></a>
                                    <?php $species_own = get_post_meta(get_the_ID(), "species_own", true) ?>
                                    <?php if ($species_own == '1') { ?>
                                        <i class="far fa-info-circle" title="<?= __('Unikat', 'k3e') ?>"></i>
                                    <?php } ?>

                                </td>
                                <td>
                                    <a href="<?= get_permalink(get_the_ID()) ?>">
                                        <?= get_the_title() ?> <?= get_post_meta(get_the_ID(), "species_name", true) ?>
                                        <?php $photos = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true))) ?>

                                        <?php if (count($photos) > 0 && $photos[0] != "") { ?>
                                            <i class="far fa-images"></i> x  <?= count($photos) ?>
                                        <?php } ?>
                                    </a>
                                    <?php $comment = get_post_meta(get_the_ID(), "species_comment", true) ?>
                                    <?php if($comment != "") { ?>
                                    <br>
                                    <small class="border-top font-weight-light"><?= $comment ?></small>
                                    <?php } ?>
                                    <br>
                                    <small>
                                        <?php foreach (get_the_terms($species->get_the_ID(), 'volume') as $volume) { ?>
                                            <?= $volume->name ?> 
                                        <?php } ?>
                                    </small>

                                </td>
                            </tr>
                            <?php
                            $i++;
                        endwhile;
                    else:
                        ?>
                        <tr>
                            <th colspan="3" class="text-center"><?= __('Lista jest pusta', 'k3e') ?></th>
                        </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>


        </div>
        <?php $j++; ?>
        <?php
    }
    ?>
</div>


