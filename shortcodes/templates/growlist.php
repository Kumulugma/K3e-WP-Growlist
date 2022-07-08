<ul class="nav nav-tabs" id="myGrowlistTabs" role="tablist">
    <?php $i = 1; ?>
    <?php foreach (get_terms('groups', array('hide_empty' => false,)) as $group) { ?>
        <li class="nav-item">
            <a class="nav-link <?= ($i == 1 ? 'active' : '') ?>" id="<?= $group->slug ?>-tab" data-toggle="tab" href="#<?= $group->slug ?>" role="tab" aria-controls="<?= $group->slug ?> " aria-selected="true"><small><?= $group->name ?></small></a>
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
                        <th scope="col"><?= __('Lp.', 'k3e') ?></th>
                        <th scope="col"><?= __('Kod', 'k3e') ?></th>
                        <th scope="col"><?= __('Gatunek', 'k3e') ?></th>
                        <th scope="col"><?= __('Komentarz', 'k3e') ?></th>
                        <th scope="col"><?= __('Rocznik', 'k3e') ?></th>
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
                                <td><a href="<?= get_permalink(get_the_ID()) ?>"><?= get_post_meta(get_the_ID(), "species_code", true) ?></a></td>
                                <td>
                                    <a href="<?= get_permalink(get_the_ID()) ?>">
                                        <?= get_the_title() ?> <small><?= get_post_meta(get_the_ID(), "species_name", true) ?></small>
                                        <?php $photos = explode(",", unserialize(get_post_meta(get_the_ID(), "species_photos", true))) ?>

                                        <?php if (count($photos) > 1) { ?>
                                            <i class="far fa-images"></i> x  <?= count($photos) - 1 ?>
                                        <?php } ?>
                                    </a>
                                </td>
                                <td><?= get_post_meta(get_the_ID(), "species_comment", true) ?></td>
                                <td><?php foreach (get_the_terms($species->get_the_ID(), 'volume') as $volume) { ?>
                                        <?= $volume->name ?> 
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        endwhile;
                    else:
                        ?>
                        <tr>
                            <th colspan="5" class="text-center"><?= __('Lista jest pusta', 'k3e') ?></th>
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


