<?php

add_filter('cron_schedules', 'k3e_every_five_minutes');

function k3e_every_five_minutes($schedules) {
    $schedules['every_five_minutes'] = array(
        'interval' => 60 * 5,
        'display' => __('Every 5 Minutes', 'k3e')
    );
    return $schedules;
}

// Schedule an action if it's not already scheduled
if (!wp_next_scheduled('pack_album')) {
    wp_schedule_event(time(), 'every_five_minutes', 'pack_album');
}

// Hook into that action that'll fire every five minutes
add_action('pack_album', 'pack_photos');

function pack_photos() {

       manuallyPackPhotos();
            
}
