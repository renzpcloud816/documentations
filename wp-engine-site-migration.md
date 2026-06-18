# Site Migration to WP Engine

## Preparations

1. **Crawl the original site** and document all URLs.
2. **Identify and list** all subdomains.
3. **Audit the root directory (`public_html`)** for important files, such as:
    - config / verification files and
    - Subdomain directories or folders containing files like PDFs
    - `.htaccess` with redirects
    - `robots.txt`, `llms.txt`, favicons
4. **Identify large `error_logs`** to exclude during migration.
5. **Create a copy of the checklist sheet**, and cross items along the way: [WP Engine Migration Checklist](https://docs.google.com/spreadsheets/d/1mJu9Q8GC0tc43R82tgEgKeV_NR9LI7G_LQoNtvCHZm4/edit?usp=sharing)

---

## Migration

1. **Create a site in [WP Engine](https://my.wpengine.com/sites).**
    - Add Site > Migrate a site > Use our migration plugin.
    - Enter site details and click "Add site"
    - <img width="355" height="378" alt="migration-process" src="https://github.com/user-attachments/assets/434c7d4f-1df1-4896-9bb3-12330e3c0b7e" />    
2. **The process will take a couple of minutes** and then redirect you to the migration page. Once there, follow the instructions shown in the screenshot.
    - <img width="739" height="476" alt="image" src="https://github.com/user-attachments/assets/534688bd-a689-4ade-9aa2-4410994ffdae" />
3. **Copy the "Connection info"** from the WP Engine dashboard and paste it into the origin site plugin.
    - <img width="547" height="550" alt="image" src="https://github.com/user-attachments/assets/49a258cd-88c0-4433-9169-6d1a04863668" />
4. **Select default or custom migration:**
    - ⚠️ **NOTE:** For default migration, the migration tool will exclude all non-wp files from the root directory.
    - For custom migrations, select important files from the Root Files that need to be migrated (e.g., `llms.txt`, subdirectories, or favicons). Exclude large `error_logs` files.
    - Start the migration and wait for the notification.
    - <img width="547" height="693" alt="image" src="https://github.com/user-attachments/assets/40338156-101a-4736-8baa-88890689b9ab" />

---

## Post-Migration, Verification & Testing

1. **Verify** that important root directory files have been copied over.
2. **Ensure crawlers are disallowed** in `robots.txt` for DEV sites.
3. **Move and verify `.htaccess` redirects:**
    - If the site has hardcoded redirects, please import them to the Redirection plugin under the 'htaccess' group.
    - If the site uses Yoast redirects, switch the redirect method to PHP.
    - <img width="498" height="366" alt="image" src="https://github.com/user-attachments/assets/782f9023-aa19-4bcf-97df-e09ef516df71" />
4. **Verify all forms are working:** check Notifications, reCaptcha, and Airtable sync. 
5. **Check that referrer tracking is working** via JS Session Storage.
    - Follow this guideline or reach out to Arjay: [Referrer Tracking: Migration from PHP Cookies to JS Session Storage](https://github.com/c816/tech-team/wiki/Referrer-Tracking:-Migration-from-PHP-Cookies-to-JS-Session-Storage)
6. **Check and resolve** all old URLs.
7. **Check all templates** for style issues and errors (`error_logs` and console logs).

---

## Live Site Verification (Live Domain)

1. **Restore `robots.txt`** to its original state.
2. **Verify forms on the live domain** (Notifications, reCaptcha, and Airtable sync).
3. **Check for any remaining dev URLs** (e.g., `.wpenginepowered.com`).
4. **Run a final crawl** to confirm all URLs are accessible and correct.

---

## Others

1. **Remove the Site Migration plugin** if it is no longer needed.
