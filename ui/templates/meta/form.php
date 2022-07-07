<?php
wp_nonce_field(basename(__FILE__), "meta-box-nonce");
?>
<?php $species_code = get_post_meta($object->ID, "species_code", true); ?>
<?php $species_state = get_post_meta($object->ID, "species_state", true); ?>
<?php $species_comment = get_post_meta($object->ID, "species_comment", true); ?>
<?php $species_name = get_post_meta($object->ID, "species_name", true); ?>

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
        <label for="k3e_species_name"><?= __('Dodatkowa nazwa', 'k3e') ?></label>
        <input id="k3e_species_name" type="text" name="species_name" value='<?= $species_name ?>'>
    </p>
    <p class="meta-options k3e_field">
        <label for="k3e_species_code"><?= __('Kod rośliny', 'k3e') ?></label>
        <input id="k3e_species_code" type="text" name="species_code" value='<?= $species_code ?>'>
    </p>
    <p class="meta-options k3e_field">
        <label for="k3e_species_state"><?= __('Status', 'k3e') ?></label>
        <select name="species_state" id="k3e_species_state">
            <option value="1" <?=$species_state == '1' ? 'selected' : ''?>><?=__('Ok','k3e')?></option>
            <option value="2" <?=$species_state == '2' ? 'selected' : ''?>><?=__('Wysiew','k3e')?></option>
            <option value="3" <?=$species_state == '3' ? 'selected' : ''?>><?=__('Leci','k3e')?></option>
            <option value="4" <?=$species_state == '4' ? 'selected' : ''?>><?=__('Nie przetrwał','k3e')?></option>
            <option value="5" <?=$species_state == '5' ? 'selected' : ''?>><?=__('Ponownie poszukiwany','k3e')?></option>
        </select>
    </p>
    <p class="meta-options k3e_field">
        <label for="k3e_species_comment"><?= __('Komentarz', 'k3e') ?></label>
        <textarea id="k3e_species_comment" name="species_comment"><?= $species_comment ?></textarea>
    </p>
</div>

