# WhatsApp Widget for WordPress

This adds a pre-styled WhatsApp link widget on front-end and adds settings to the WordPress Settings page to configure the widget.

When a visitor clicks the button in widget, it takes the user to configured WhatsApp number link with a message including the website name and title of the current page.

In settings, you can configure three WhatsApp Numbers,
- A primary number to appear everywhere.
- A secondary & and a backup number to appear on pages with your specified keywords in the slug.

## Installation Instructions

### Step 1: Upload the Files
1. Copy the `custom-whatsapp-settings.php` & `custom-whatsapp-widget.php` files to your WordPress theme/child-theme directory.

### Step 2: Link the Settings File in `functions.php`
1. Open your theme’s `functions.php` file.
2. Include the settings file by adding the following line at the end:

   ```php
   require_once get_stylesheet_directory() . '/custom-whatsapp-settings.php';
   ```

### Step 3: Verify the Settings Page
1. Go to **WordPress Dashboard > Settings > General**.
2. Scroll down to see the new settings fields for the WhatsApp widget.

### Step 4: Configure the WhatsApp Widget
1. Fill in the required fields (WhatsApp number, keywords settings, etc.).
2. Save changes.

### Step 5: Ensure the Widget is Displayed
1. The widget should now appear on your website according to the configured settings.
2. If it doesn’t appear, ensure your theme has the necessary hooks or manually add the widget display function where needed.

## Uninstallation
To remove this feature:
1. Delete or comment out the `require_once` line from `functions.php`.
2. Remove the feature files from your theme directory.

---
## How to update Functionaliy and Styles?
If Style or Functionality update is needed, you may update unminified versions of CSS & JS. Make sure to minify and replace the updated CSS/JS in `$css` & `$js` variables inside `custom-whatsapp-widget.php`.

## Support
If you encounter any issues, ensure the files are correctly placed and the required dependencies are included in `functions.php`. Debug mode in WordPress (`WP_DEBUG`) can help diagnose errors. Contact me on [LinkedIn](https://www.linkedin.com/in/khawajahaider) for further support and help.