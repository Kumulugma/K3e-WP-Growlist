<?php
$tab = isset($_GET['tab']) ? $_GET['tab'] : "";
?>

<ul class="nav nav-tabs justify-content-center row" id="myGrowlistTabs" role="tablist">
    <?php $i = 1; ?>
    <?php foreach (get_terms('groups', array('hide_empty' => false,)) as $group) { ?>
        <li class="nav-item col p-0">
            <a class="nav-link h-100 p-0 <?= (($i == 1 && ($tab) == "" ) || $tab == $group->slug ? 'active' : '') ?>" id="<?= $group->slug ?>-tab" data-toggle="tab" href="#<?= $group->slug ?>" role="tab" aria-controls="<?= $group->slug ?> " aria-selected="true">
                <img src="<?= wp_get_attachment_image_url(get_term_meta($group->term_id, 'k3e_groups_img', true), 'big-icons') ?>" class="rounded mt-2 mx-auto d-block" alt="<?= $group->name ?>" data-toggle="tooltip" title="<?= $group->name ?>">
                <h5 class="d-block text-center lh-1">
                    <small><?= $group->name ?></small>
                </h5>

            </a>
        </li> 
        <?php $i++; ?>
    <?php } ?>
</ul>
<div class="tab-content mt-2" id="myGrowlist">
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
        <div class="tab-pane fade show <?= (($j == 1 && ($tab) == "" ) || $tab == $group->slug ? 'active' : '') ?>" id="<?= $group->slug ?>" role="tabpanel" aria-labelledby="<?= $group->slug ?>-tab">

            <div class="accordion" id="accordionSpecies-<?= $group->slug ?>">
                <div class="card">
                    <div class="card-header" id="headingOne-<?= $group->slug ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne-<?= $group->slug ?>" aria-expanded="true" aria-controls="collapseOne-<?= $group->slug ?>">
                                <?= __("Tabela okazów", "k3e"); ?>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne-<?= $group->slug ?>" class="collapse show" aria-labelledby="headingOne-<?= $group->slug ?>" data-parent="#accordionSpecies-<?= $group->slug ?>">
                        <div class="card-body">
                            <div class="row">
                                <?php $i = 1; ?>
                                <?php
                                $species = new WP_Query($args);
                                if ($species->have_posts()) :
                                    while ($species->have_posts()) : $species->the_post();
                                        ?>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-2 p-2 text-center">
                                                    <a href="<?= get_permalink(get_the_ID()) ?>">
                                                        <?= get_the_post_thumbnail(get_the_ID(), 'lightbox', ['class' => 'rounded']) ?>
                                                    </a>
                                                </div>
                                                <div class="col-md-10 d-flex align-items-center species-content">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <a href="<?= get_permalink(get_the_ID()) ?>">
                                                                <?= get_the_title() ?> <?= get_post_meta(get_the_ID(), "species_name", true) ?>
                                                                <?php $photos = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true))) ?>

                                                                <?php if (count($photos) > 0 && $photos[0] != "") { ?>
                                                                    <i class="far fa-images"></i> x  <?= count($photos) ?>
                                                                <?php } ?>
                                                            </a>
                                                        </div>
                                                        <div class="col-12">
                                                            <?php $comment = get_post_meta(get_the_ID(), "species_comment", true) ?>
                                                            <?php if ($comment != "") { ?>
                                                                <br>
                                                                <small class="border-top font-weight-light"><?= $comment ?></small>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-12">
                                                            <small>
                                                                <?php foreach (get_the_terms($species->get_the_ID(), 'volume') as $volume) { ?>
                                                                    <?= $volume->name ?> 
                                                                <?php } ?>
                                                            </small>
                                                        </div>

                                                        <div class="col-12">
                                                            <?php if (get_post_meta(get_the_ID(), "species_code", true) != "") { ?>
                                                                <a href="<?= get_permalink(get_the_ID()) ?>"><?= get_post_meta(get_the_ID(), "species_code", true) ?></a>
                                                                <?php $species_own = get_post_meta(get_the_ID(), "species_own", true) ?>
                                                                <?php if ($species_own == '1') { ?>
                                                                    <i class="far fa-info-circle" title="<?= __('Unikat', 'k3e') ?>"></i>
                                                                <?php } ?>
                                                            <?php } ?>  
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>                                            
                                        </div>
                                        <?php
                                        $i++;
                                    endwhile;
                                endif;
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo-<?= $group->slug ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo-<?= $group->slug ?>" aria-expanded="false" aria-controls="collapseTwo-<?= $group->slug ?>">
                                <?= __("Lista prosta", "k3e"); ?>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo-<?= $group->slug ?>" class="collapse" aria-labelledby="headingTwo-<?= $group->slug ?>" data-parent="#accordionSpecies-<?= $group->slug ?>">
                        <div class="card-body">
                            <table class="table table-sm table-striped table-simple">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= __('Lp.', 'k3e') ?></th>
                                        <th scope="col"><?= __('Kod', 'k3e') ?></th>
                                        <th scope="col"><?= __('Gatunek', 'k3e') ?></th>
                                        <th scope="col"><?= __('Komentarz', 'k3e') ?></th>
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
                                                <td><?= $i ?></td>
                                                <td><a href="<?= get_permalink(get_the_ID()) ?>"><?= get_post_meta(get_the_ID(), "species_code", true) ?></a></td>
                                                <td><a href="<?= get_permalink(get_the_ID()) ?>"><?= get_the_title() ?> <?= get_post_meta(get_the_ID(), "species_name", true) ?></a></td>
                                                <td><?php $comment = get_post_meta(get_the_ID(), "species_comment", true) ?></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        endwhile;
                                    else:
                                        ?>
                                        <tr>
                                            <th class="text-center" colspan="4"><?= __('Lista jest pusta', 'k3e') ?></th>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php $j++; ?>
        <?php
    }
    ?>
</div>


