<?php
function allow_webp_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'allow_webp_upload');

function fix_webp_mime_type($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'webp') {
        $data['ext'] = 'webp';
        $data['type'] = 'image/webp';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'fix_webp_mime_type', 10, 4);