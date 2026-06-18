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
    - Enter site details and click "Add site"
    - <img width="355" height="378" alt="migration-process" src="https://github.com/user-attachments/assets/434c7d4f-1df1-4896-9bb3-12330e3c0b7e" />    
2. The process will take a couple of minutes and then redirect you to the migration page. Once there, follow the instructions shown in the screenshot.
    - <img width="739" height="476" alt="image" src="https://github.com/user-attachments/assets/534688bd-a689-4ade-9aa2-4410994ffdae" />
3. Copy the "Connection info" from the WP Engine dashboard and paste it into the origin site plugin.
    - <img width="547" height="550" alt="image" src="https://github.com/user-attachments/assets/49a258cd-88c0-4433-9169-6d1a04863668" />
4. Select default or custom migration:
    - Exclude large `error_logs`.
    - For custom migrations, select important files from the Root Files that need to be migrated (e.g., `llms.txt`, favicons).
    - Start the migration and wait for the notification.
    - <img width="547" height="693" alt="image" src="https://github.com/user-attachments/assets/40338156-101a-4736-8baa-88890689b9ab" />
5. Verify that important root directory files have been copied over.

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
