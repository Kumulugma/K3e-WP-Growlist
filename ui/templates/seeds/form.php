<?php
wp_nonce_field(basename(__FILE__), "meta-box-nonce");
?>
<?php $species_seeds = get_post_meta($object->ID, "species_seeds", true); ?>
<?php $species_seeds_amount = get_post_meta($object->ID, "species_seeds_amount", true); ?>
<?php $species_seeds_price = get_post_meta($object->ID, "species_seeds_price", true); ?>

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
    <p class="meta-options k3e_field">
        <label for="k3e_species_seeds"><?= __('Czy jest na sprzedaż?', 'k3e') ?></label>
        <select id="k3e_species_seeds" name="species_seeds">
            <option value="0" <?= $species_seeds == 0 ? 'selected' : '' ?>><?= __('Nie', 'k3e') ?></option>
            <option value="1" <?= $species_seeds == 1 ? 'selected' : '' ?>><?= __('Tak', 'k3e') ?></option>
        </select>
    </p>
    <p class="meta-options k3e_field">
        <label for="k3e_species_seeds_amount"><?= __('Ilość nasion', 'k3e') ?></label>
        <input id="k3e_species_seeds_amount" type="number" name="species_seeds_amount" value='<?= $species_seeds_amount ?>'>
    </p>
    <p class="meta-options k3e_field">
        <label for="k3e_species_seeds_price"><?= __('Cena', 'k3e') ?></label>
        <input id="k3e_species_seeds_price" type="number" name="species_seeds_price" value='<?= $species_seeds_price ?>'>
    </p>
</div>