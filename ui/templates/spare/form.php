<?php
wp_nonce_field(basename(__FILE__), "meta-box-nonce");
?>
<?php $species_spare = get_post_meta($object->ID, "species_spare", true); ?>
<?php $species_spare_price = get_post_meta($object->ID, "species_spare_price", true); ?>

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
        <label for="k3e_species_spare"><?= __('Czy jest na sprzedaż?', 'k3e') ?></label>
        <select id="k3e_species_spare" name="species_spare">
            <option value="0" <?=$species_spare == 0 ? 'selected' : '' ?>><?=__('Nie', 'k3e')?></option>
            <option value="1" <?=$species_spare == 1 ? 'selected' : '' ?>><?=__('Tak', 'k3e')?></option>
        </select>
    </p>
    <p class="meta-options k3e_field">
        <label for="k3e_species_spare_price"><?= __('Cena', 'k3e') ?></label>
        <input id="k3e_species_spare_price" type="number" name="species_spare_price" value='<?= $species_spare_price ?>'>
    </p>
</div>