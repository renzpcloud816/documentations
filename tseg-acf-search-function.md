
# ACF URL Search & Command Utility

Search, add, or remove posts in **ACF Relationship** and **Post Object** fields using URLs instead of titles.

## 🛠 Installation

1.  **Folder Setup:**
    
    -   Go to your theme folder.
        
    -   Find or create an `inc` folder (or any folder designated for utility functions).
        
2.  **Create File:**
    
    -   Create a file named `tseg-functions.php` inside that folder.
        
    -   Paste this code [https://github.com/renzpcloud816/documentations/blob/main/tseg-functions.php](https://github.com/renzpcloud816/documentations/blob/main/tseg-functions.php)
        
3.  **Register in Functions.php:**
    
    -   Add the following line to your theme's `functions.php`:
        
    
    PHP
    
    ```
    require_once get_stylesheet_directory() . '/inc/tseg-functions.php';
    
    ```
    

----------

## 🚀 How to Use

See this documentation for detailed usage and command examples: [https://github.com/c816/tseg-plugin-2025/wiki/Sitemap-&-LLMs](https://github.com/c816/tseg-plugin-2025/wiki/Sitemap-&-LLMs)
    

----------

## 🧪 Testing Checklist

### Target Fields

Test the function on these specific areas:

-   **TSEG > Schema** (Post Object field)
    
-   **Related Translations** (Relationship field)
    

### Steps to Test

1.  **Source Link:** Copy a URL from any Page, Post, or CPT on your site.
    
2.  **Execute:** Paste the link into the ACF search box.
    
3.  **Save:** Click **Update** on the WordPress post to confirm it saves correctly.
    
4.  **Revert:** Delete the test entries from the ACF field and save again to clean up.

<img width="343" height="224" alt="image" src="https://github.com/user-attachments/assets/c83d646d-2c44-49ed-892b-10a4ab2f5665" />
<img width="585" height="232" alt="image" src="https://github.com/user-attachments/assets/90bb52b2-4a2e-450b-9332-5cf6c083527c" />
<img width="461" height="99" alt="image" src="https://github.com/user-attachments/assets/b64923e8-3635-4b96-9a2a-95749c533165" />


    

### Error Check

-   **Verification:** Check the **WP Admin** or the **Frontend** to ensure the site remains unaffected. This code only triggers in the admin dashboard.
