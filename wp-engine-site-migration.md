# Site Migration to WP Engine

## Preparations

1. Crawl the original site and document all URLs.
2. Identify and list all subdomains.
3. Audit the root directory (`public_html`) for important files, such as:
    - config / verification files and
    - Subdomain directories or folders containing files like PDFs
    - `.htaccess` with redirects
    - robots.txt, llms.txt, favicons
4. Identify large `error_logs` to exclude during migration.

## Migration

1. Create a site in [WP Engine](https://my.wpengine.com/sites).
    - Add Site > Migrate a site > Use our migration plugin.
    - Enter site details.
    - <img width="355" height="378" alt="migration-process" src="https://github.com/user-attachments/assets/434c7d4f-1df1-4896-9bb3-12330e3c0b7e" />    
2. Go to the origin site and install the "Site Migration" plugin.
3. Copy the "Connection info" from the WP Engine dashboard and paste it into the origin site plugin.
4. Select default or custom migration:
    - Exclude large `error_logs`.
    - For custom migrations, select important files from the Root Files that need to be migrated (e.g., `llms.txt`, favicons).
    - Start the migration and wait for the notification.
5. Ensure all subdomains are migrated.
6. Verify that important root directory files have been copied over.
7. Confirm that large `error_log` files have been successfully excluded.

## After Migration

1. Ensure crawlers are disallowed in `robots.txt` for development sites.
2. Move and verify `.htaccess` redirects (if using Yoast redirects, switch to PHP).
3. Verify all forms are working: check Notifications, reCaptcha, and Airtable sync. 
    - *Note: reCaptcha might need the dev URL added.*
4. Check that referrer tracking is working via JS Session Storage.
5. Check and resolve all old URLs.
6. Check all templates for errors, style issues, and console logs.

## After Main Domain Switch

1. Restore `robots.txt` to its original state.
2. Verify forms on the live domain (Notifications, reCaptcha, and Airtable sync).
3. Check for any remaining dev URLs (e.g., `.wpenginepowered.com`).
4. Run a final crawl to confirm all URLs are accessible and correct.

## Others

1. Remove the Site Migration plugin if it is no longer needed.
