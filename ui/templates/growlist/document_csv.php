<?php

$filename = !empty(htmlentities($_POST['Growlist']['document_csv_name'])) ? htmlentities($_POST['Growlist']['document_csv_name']) : 'document_' . date('Y-m-d_H:i:s');

$delimiter = ";";
$f = fopen(wp_upload_dir()['path'] . '/' . sanitize_title($filename) . '.csv', "w");
fwrite($f, "\xEF\xBB\xBF"); //Łatka na kodowanie znaków
//
// Set column headers 
$fields = array('KOD', 'GATUNEK', 'OPIS', 'GRUPA', 'STATUS', 'KOMENTARZ', 'MINIATURA');
fputcsv($f, $fields, $delimiter);

$growlist = json_decode(get_option('_csv_growlist'));

foreach ($growlist as $k => $item) {
    $lineData = array(
        ($item->code), 
        html_entity_decode($item->name), 
        html_entity_decode($item->mininame), 
        ($item->group),
        ($item->state), 
        html_entity_decode($item->comment), 
        ($item->thumbnail == '1' ? 'Tak' : '---')
        );
    fputcsv($f, $lineData, $delimiter);
}

//fseek($f, 0);
fclose($f);

$attr = [
    'post_type' => 'attachment',
    'post_mime_type' => 'text/csv',
    'guid' => $file_url,
    'post_name' => $filename,
    'post_status' => 'inherit',
    'post_title' => $filename,
    'post_content' => $filename,
    'post_excerpt' => $filename,
];
$attach_id = wp_insert_post($attr);

add_post_meta($attach_id, '_wp_attached_file', substr(wp_upload_dir()['subdir'], 1) . '/' . sanitize_title($filename) . '.csv');
add_post_meta($attach_id, '_growlist_export', $filename);
