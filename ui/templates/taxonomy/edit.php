<?php
// get meta data value
$image_id = get_term_meta($term->term_id, 'k3e_groups_img', true);
?>
<tr class="form-field">
    <th>
        <label for="k3e_groups_img"><?= __('Ikona', 'k3e') ?></label>
    </th>
    <td>
        <?php if ($image = wp_get_attachment_image_url($image_id, 'big-icons')) : ?>
            <a href="#" class="k3e-groups-upload">
                <img src="<?php echo esc_url($image) ?>" />
            </a>
            <br>
            <a href="#" class="k3e-groups-remove"><?= __('Usuń obrazek', 'k3e') ?></a>
            <input type="hidden" name="k3e_groups_img" value="<?php echo absint($image_id) ?>">
        <?php else : ?>
            <a href="#" class="button k3e-groups-upload"><?= __('Wgraj obrazek', 'k3e') ?></a>
            <br>
            <a href="#" class="k3e-groups-remove" style="display:none"><?= __('Usuń obrazek', 'k3e') ?></a>
            <input type="hidden" id="k3e_groups_img_form" name="k3e_groups_img" value="">
        <?php endif; ?>
    </td>
</tr><?php
        