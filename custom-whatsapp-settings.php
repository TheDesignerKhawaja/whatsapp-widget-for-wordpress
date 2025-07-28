<?php
// Register the settings for WhatsApp numbers and keywords
function custom_whatsapp_settings_init() {
    add_settings_section(
        'custom_whatsapp_settings_section',
        'custom WhatsApp Chat Settings',
        'custom_whatsapp_settings_section_callback',
        'general'
    );

    add_settings_field(
        'custom_primary_whatsapp',
        'Primary WhatsApp Number',
        'custom_primary_whatsapp_callback',
        'general',
        'custom_whatsapp_settings_section'
    );
    // Register the setting with sanitization for phone numbers
    register_setting('general', 'custom_primary_whatsapp', 'custom_sanitize_phone_number');

    add_settings_field(
        'custom_secondary_whatsapp',
        'Secondary WhatsApp Number',
        'custom_secondary_whatsapp_callback',
        'general',
        'custom_whatsapp_settings_section'
    );
    // Register the setting with sanitization for phone numbers
    register_setting('general', 'custom_secondary_whatsapp', 'custom_sanitize_phone_number');

    add_settings_field(
        'custom_keywords_secondary_whatsapp',
        'Comma-Separated Keywords for Secondary Number',
        'custom_keywords_secondary_whatsapp_callback',
        'general',
        'custom_whatsapp_settings_section'
    );
    // Register the setting with custom sanitization callback
    register_setting('general', 'custom_keywords_secondary_whatsapp', 'custom_sanitize_keywords');
	
	add_settings_field(
        'custom_backup_whatsapp',
        'Backup WhatsApp Number',
        'custom_backup_whatsapp_callback',
        'general',
        'custom_whatsapp_settings_section'
    );
    // Register the setting with sanitization for phone numbers
    register_setting('general', 'custom_backup_whatsapp', 'custom_sanitize_phone_number');
	
	add_settings_field(
        'custom_keywords_backup_whatsapp',
        'Comma-Separated Keywords for Backup Number',
        'custom_keywords_backup_whatsapp_callback',
        'general',
        'custom_whatsapp_settings_section'
    );
    // Register the setting with custom sanitization callback
    register_setting('general', 'custom_keywords_backup_whatsapp', 'custom_sanitize_keywords');
}

// Callback functions for fields
function custom_whatsapp_settings_section_callback() {
    echo '<p>Configure the WhatsApp numbers and keywords for custom Solutions chat widget.</p>';
}

function custom_primary_whatsapp_callback() {
    $primary_number = get_option('custom_primary_whatsapp', '');
    echo '<input type="text" name="custom_primary_whatsapp" value="' . esc_attr($primary_number) . '" class="regular-text" placeholder="without spaces">';
}

function custom_secondary_whatsapp_callback() {
    $secondary_number = get_option('custom_secondary_whatsapp', '');
    echo '<input type="text" name="custom_secondary_whatsapp" value="' . esc_attr($secondary_number) . '" class="regular-text" placeholder="without spaces">';
}

function custom_backup_whatsapp_callback() {
    $secondary_number = get_option('custom_backup_whatsapp', '');
    echo '<input type="text" name="custom_backup_whatsapp" value="' . esc_attr($secondary_number) . '" class="regular-text" placeholder="without spaces">';
}

function custom_keywords_secondary_whatsapp_callback() {
    $keywords = get_option('custom_keywords_secondary_whatsapp', '');
    echo '<textarea name="custom_keywords_secondary_whatsapp" rows="3" class="regular-text" placeholder="e.g., contact, capital, blue-world">' . esc_textarea($keywords) . '</textarea>';
    echo '<p>Secondary Number will be displayed on pages/posts that include these keywords in their slug.</p>';
}

function custom_keywords_backup_whatsapp_callback() {
    $keywords = get_option('custom_keywords_backup_whatsapp', '');
    echo '<textarea name="custom_keywords_backup_whatsapp" rows="3" class="regular-text" placeholder="e.g., contact, capital, blue-world">' . esc_textarea($keywords) . '</textarea>';
    echo '<p>Backup Number will be displayed on pages/posts that include these keywords in their slug.</p>';
}

// Custom sanitization for phone numbers
function custom_sanitize_phone_number($phone_number) {
    // Remove spaces and non-numeric characters except for '+' and '0'
    $phone_number = preg_replace('/\D/', '', $phone_number);

    // If the phone number starts with '0', replace it with '92'
    if (substr($phone_number, 0, 1) === '0') {
        $phone_number = '92' . substr($phone_number, 1);
    }

    // If the phone number starts with '+', remove the '+'
    if (substr($phone_number, 0, 1) === '+') {
        $phone_number = substr($phone_number, 1);
    }

    // Return the sanitized phone number
    return $phone_number;
}

// Custom sanitization callback for keywords
function custom_sanitize_keywords($keywords) {
    // Remove trailing commas and spaces, then split by comma
    $keywords = trim($keywords, ','); // Remove any trailing commas
    $keywords_array = array_map('trim', explode(',', $keywords)); // Trim spaces from each keyword
    $keywords_array = array_filter($keywords_array, function($keyword) {
        return !empty($keyword); // Remove any empty entries
    });
    
    // Return the cleaned-up keywords as a comma-separated string
    return implode(',', $keywords_array);
}

// Hook into admin_init
add_action('admin_init', 'custom_whatsapp_settings_init');


// Include WhatsApp widget
function custom_whatsapp_widget_include() {
    include_once get_stylesheet_directory() . '/custom-whatsapp-widget.php';
}

// Register the shortcode
function custom_whatsapp_shortcode() {
    ob_start();
    custom_whatsapp_widget_include();
    return ob_get_clean();
}
add_shortcode('custom_whatsapp', 'custom_whatsapp_shortcode');
?>