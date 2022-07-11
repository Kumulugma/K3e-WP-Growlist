<?php

function getGrowlistPhotos($post_id) {
    $species_photos = get_post_meta($post_id, "species_photos", true);
    if (!empty($species_photos)) {
        $species_photos = unserialize($post_images);
        $species_photos = explode(",", $post_images);
    } else {
        $species_photos = [];
    }
    return $species_photos;
}
