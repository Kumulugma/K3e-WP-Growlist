<?php
$args = array(
    'post_type' => 'species',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'species_spare',
            'value' => '1',
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
            <th scope="col"><?= __('Komentarz', 'k3e') ?></th>
            <th scope="col"><?= __('Cena', 'k3e') ?></th>
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
                    <td><a href="<?= get_permalink(get_the_ID()) ?>"><?= get_the_title() ?> <?= get_post_meta(get_the_ID(), "species_name", true) ?></a></td>
                    <td><?= get_post_meta(get_the_ID(), "species_comment", true) ?></td>
                    <td><?= get_post_meta(get_the_ID(), "species_spare_price", true) ?>PLN</td>
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