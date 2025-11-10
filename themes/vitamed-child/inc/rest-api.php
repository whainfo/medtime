<?php
// Sync doctors on save
function sync_doctor_to_main($post_id, $post, $update) {
    if ($post->post_type !== 'doctors' || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) {
        return;
    }

    $main_url = 'https://wordpress-1210358-5722812.cloudwaysapps.com';
    $endpoint = $main_url . '/wp-json/sync/v1/doctor';

    $post_data = array(
        'post_title' => $post->post_title,
        'post_content' => $post->post_content,
        'post_status' => $post->post_status,
        'post_type' => 'doctors',
    );

    // Collect all meta
    $all_meta = get_post_meta($post_id);
    $meta_json = json_encode($all_meta);

    // Collect taxonomies
    $taxonomies = array();
    $doctor_taxonomies = array('languages', 'specialization', 'specialty', 'qualification', 'clinic-service');
    foreach ($doctor_taxonomies as $tax) {
        $terms = wp_get_object_terms($post_id, $tax, array('fields' => 'all'));
        $taxonomies[$tax] = array();
        foreach ($terms as $term) {
            $taxonomies[$tax][] = array(
                'name' => $term->name,
                'slug' => $term->slug,
                'parent' => $term->parent,
            );
        }
    }

    // Featured image URL
    $featured_image_url = has_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id, 'full') : '';

    // Send request
    $body = array(
        'child_site_slug' => get_option('site_slug'), // Replace with actual (e.g., get_option('child_site_slug'))
        'original_post_id' => $post_id,
        'post_data' => $post_data,
        'meta_json' => $meta_json,
        'taxonomies' => $taxonomies,
        'featured_image_url' => $featured_image_url,
    );

    wp_remote_post($endpoint, array('body' => $body, 'timeout' => 30));
}
add_action('save_post_doctors', 'sync_doctor_to_main', 20, 3);



function sync_clinic_to_main($force_site_slug = null) {
    $main_url = 'https://wordpress-1210358-5722812.cloudwaysapps.com';
    $endpoint = $main_url . '/wp-json/sync/v1/clinic';

    $site_slug = $force_site_slug ?: get_option('site_slug');
    if (empty($site_slug)) {
        error_log('Clinic sync skipped: site_slug is empty');
        return;
    }

    $child_site_id = defined('CHILD_SITE_ID') ? CHILD_SITE_ID : get_option('child_site_id');
    if (empty($child_site_id)) {
        $child_site_id = wp_generate_uuid4();
        update_option('child_site_id', $child_site_id);
        error_log('Generated new child_site_id: ' . $child_site_id);
    }

    $clinic_data = array(
        'post_title' => get_bloginfo('name'),
        'post_content' => get_bloginfo('description'),
        'post_status' => 'publish',
        'post_type' => 'clinics',
    );

    // Collect additional meta (extend as needed)
    $additional_meta = array(
        // 'address' => get_field('address', 'option'),
    );
    $meta_json = json_encode($additional_meta);

    $tax_data = array(
        'clinic_facilities' => get_field('clinic_facilities', 'option') ?: '',
        'clinic_services' => get_field('clinic_services', 'option') ?: '',
        'clinic_type' => get_field('clinic_type', 'option') ?: '',
        'specialization' => get_field('specialization', 'option') ?: '',
        'region' => get_field('region', 'option') ?: '',
        'district' => get_field('district', 'option') ?: '',
        'city' => get_field('city', 'option') ?: '',
    );

    $body = array(
        'site_slug' => $site_slug,
        'child_site_id' => $child_site_id,
        'clinic_data' => $clinic_data,
        'meta_json' => $meta_json,
        'tax_data' => $tax_data,
    );

    $response = wp_remote_post($endpoint, array('body' => $body, 'timeout' => 30));
    if (is_wp_error($response)) {
        error_log('Clinic sync failed: ' . $response->get_error_message());
    } else {
        $response_body = wp_remote_retrieve_body($response);
        error_log('Clinic sync response: ' . $response_body);
    }
}

add_action('update_option_site_slug', function ($old_value, $new_value) {
    if ($new_value !== $old_value) {
        error_log("Site slug changed from $old_value to $new_value");
        sync_clinic_to_main($new_value);
    }
}, 10, 2);

add_action('acf/save_post', function ($post_id) {
    if ($post_id === 'options') {
        $site_slug = get_option('site_slug');
        error_log("ACF options saved, syncing clinic with site_slug: $site_slug");
        sync_clinic_to_main($site_slug);
    }
}, 20);
