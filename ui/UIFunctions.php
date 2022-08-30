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

function manuallyPackPhotos() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $limit = 30;
    $counter = 0;
   
    $args = array(
        'post_type' => 'photo_album',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    $packages = new WP_Query($args);
    if ($packages->have_posts()) {

        while ($packages->have_posts()) : $packages->the_post();
            if ($counter == $limit) {
                return;
            }

            $status = get_post_meta(get_the_ID(), 'package_status', true);

            if ($status != 'complete') {

                $photo_package = get_post_meta(get_the_ID(), 'photo_package', true);
                if (!$photo_package) {
                    createZipAttachment(get_the_title());
                }
                $post_id = get_the_ID();
                $photo_package = get_post_meta($post_id, 'photo_package', true);
                $start_date = get_post_meta($post_id, 'start_date', true);

                $query_images = getPhotos($start_date);
                if ($query_images->have_posts()) {
                    $ready_photos = get_post_meta($post_id, 'ready_photos', true);
                    $package_photos = get_post_meta($post_id, 'package_photos', true);

                    $zip = new ZipArchive;

                    if ($zip->open(get_attached_file($photo_package)) === TRUE) {
                        $photo_i = 0;
                        while ($query_images->have_posts()) : $query_images->the_post();
                            if ($counter == $limit) {
                                update_post_meta($post_id, 'ready_photos', $ready_photos);
                                return;
                            }
                            if ($photo_i == $ready_photos) {
                                $attachment = get_attached_file(get_the_ID());
                                $source_image = $attachment;
                                $image_sizes = getimagesize($source_image);
                                $destination_image = $source_image;
                                $destination_extension = substr($destination_image, -3);
                                $destination_image = substr($destination_image, 0, -4) . "-package." . $destination_extension;
                                echo " test ";
                                echo fileComplete($source_image);
                                if ($image_sizes[0] > 1900 && (fileComplete($source_image) || $destination_extension == 'png')) {
                                    echo " start ";
                                    copy($source_image, $destination_image);

                                    /* Create some objects */
                                    $image = new Imagick($destination_image);

                                    $description = get_the_content(get_the_ID());

                                    if (!empty($description)) {
                                        $rect = [
                                            'x' => 0,
                                            'y' => 40,
                                            'h' => 300,
                                            'w' => 2000,
                                        ];
                                    } else {
                                        $rect = [
                                            'x' => 0,
                                            'y' => 40,
                                            'h' => 200,
                                            'w' => 2000,
                                        ];
                                    }

// Draw a Region-of-interest for reference.
                                    $roi = new ImagickDraw();
                                    $roi->setFillColor('white');
                                    $roi->setFillOpacity(.75);
                                    $roi->rectangle($rect['x'],
                                            $rect['y'],
                                            $rect['x'] + $rect['w'],
                                            $rect['y'] + $rect['h']);
                                    $image->drawImage($roi);

                                    $ctx1 = new ImagickDraw();
                                    $ctx1->setFillColor('#3e3c3c');
                                    $ctx1->setFontSize(70);

                                    $metrics1 = $image->queryFontMetrics($ctx1, str_replace("&#8217;", "'", str_replace("&#8211;", "-", html_entity_decode(get_the_title(get_the_ID())))));

                                    $ctx2 = new ImagickDraw();
                                    $ctx2->setFillColor('#454545');
                                    $ctx2->setFontSize(50);

                                    $metrics2 = $image->queryFontMetrics($ctx2, $description);

                                    if (!empty($description)) {

                                        $offset1 = [
                                            'x' => $rect['x'] + $rect['w'] / 2 - $metrics1['textWidth'] / 2,
                                            'y' => $rect['y'] + $rect['h'] / 3 + $metrics1['textHeight'] / 3 + $metrics1['descender'],
                                        ];

                                        $offset2 = [
                                            'x' => $rect['x'] + $rect['w'] / 4 - $metrics2['textWidth'],
                                            'y' => $rect['y'] + $rect['h'] / 4 + $metrics2['textHeight'] / 0.35 + $metrics2['descender'],
                                        ];
                                        $image->annotateImage($ctx2,
                                                $offset2['x'],
                                                $offset2['y'],
                                                0,
                                                $description);
                                    } else {

                                        $offset1 = [
                                            'x' => $rect['x'] + $rect['w'] / 2 - $metrics1['textWidth'] / 2,
                                            'y' => $rect['y'] + $rect['h'] / 2 + $metrics1['textHeight'] / 2 + $metrics1['descender'],
                                        ];
                                    }

                                    $image->annotateImage($ctx1,
                                            $offset1['x'],
                                            $offset1['y'],
                                            0,
                                            str_replace("&#8217;", "'", str_replace("&#8211;", "-", html_entity_decode(get_the_title(get_the_ID())))));
                                    $image->writeimage($destination_image);

                                    //Wyświetlenie w przypadku naprawy
//                                    ob_clean();
//                                    header('Content-type: image/png');
//                                    echo $image;


                                    $zip->addFile($destination_image, basename($attachment));
                                }
                                $ready_photos++;
                                $counter++;
                            }
                            if ($ready_photos == $package_photos) {
                                add_post_meta($post_id, 'package_status', 'complete');
                            }
                            $photo_i++;
                        endwhile;
                    }
                    update_post_meta($post_id, 'ready_photos', $ready_photos);
                    $zip->close();
                }
            }

        endwhile;
    }
}

function getPhotos($start_date) {

    $query_images_args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'post_status' => 'inherit',
        'posts_per_page' => - 1,
        'date_query' => array(
            array(
                'after' => $start_date,
                'before' => date('Y-m-d H:i:s'),
                'inclusive' => true,
            ),
        ),
    );
    return new WP_Query($query_images_args);
}

function createZipAttachment($filename) {

    $file_path = wp_upload_dir()['path'] . '/' . sanitize_title($filename) . '.zip';
    $file_url = wp_upload_dir()['url'] . '/' . sanitize_title($filename) . '.zip';
//        touch($file_path);
    $zip = new ZipArchive;
    $file = $zip->open($file_path, ZipArchive::CREATE);
    if ($file === TRUE) {
        $zip->addFromString('readme.txt', 'Automatyczna paczka zdjęć.');
        $zip->close();
    }

    $attr = [
        'post_type' => 'attachment',
        'post_mime_type' => 'application/zip',
        'guid' => $file_url,
        'post_name' => $filename,
        'post_status' => 'inherit',
        'post_title' => $filename,
        'post_content' => $filename,
        'post_excerpt' => $filename,
    ];
    $attach_id = wp_insert_post($attr);
    add_post_meta($attach_id, '_wp_attached_file', substr(wp_upload_dir()['subdir'], 1) . '/' . sanitize_title($filename) . '.zip');
    add_post_meta(get_the_ID(), 'photo_package', $attach_id);
}

function fileComplete($file_path) {
    $file = fopen($file_path, 'r');
    if (0 !== fseek($file, -2, SEEK_END) || "\xFF\xD9" !== fread($file, 2)) {
        fclose($file);
        return FALSE;
    }
    return true;
}
