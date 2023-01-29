<?php
$args = array(
    'post_type' => 'species',
    'order' => 'ASC',
    'orderby' => 'title',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'species_state',
            'value' => '2',
            'compare' => '='
        )
    ),
);
?>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th scope="col"><?= __('Lp.', 'k3e') ?></th>
            <th scope="col"><?= __('Kod', 'k3e') ?></th>
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
                    <td><small><a href="<?= get_permalink(get_the_ID()) ?>"><?= get_post_meta(get_the_ID(), "species_code", true) ?></a></small></td>
                    <td><a href="<?= get_permalink(get_the_ID()) ?>"><small><?= get_the_title() ?></small> <small><?= get_post_meta(get_the_ID(), "species_name", true) ?></small></a></td>
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