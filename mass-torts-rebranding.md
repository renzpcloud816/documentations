# Mass Torts Site Rebranding Guide

This guide outlines the steps to rebrand a duplicated "Mass Torts" site for a new client.

---

## 1. Update Theme Folder
- Rename the theme folder to the client’s slug:  
  `wp-content/themes/firm-name-etc`
- Update the `style.css` header info (Theme Name, Author, etc.)
<img width="304.5" height="361" alt="image" src="https://github.com/user-attachments/assets/512f179c-62f9-4592-bef8-103c393da0ff" />

---

## 2. Update Theme Styles
- Edit `css/global.css`
- Change root CSS variables for colors, fonts, etc.
- Check the site visually for layout or style issues and fix as needed.
<img width="268" height="168.5" alt="image" src="https://github.com/user-attachments/assets/2f12665e-8bf6-477d-91a3-64140224a8fd" />

---

## 3. Update Branding
- Replace **logos** in assets or customizer.
- Update **favicons** under Site Identity or assets.
- Update **Yoast**:
  - `SEO > Settings > Site Basics & Site Representation`
- Update **Gravity Forms** branding and confirmation messages.
- Replace **default thumbnail images** (e.g., blog cards, post defaults).
<img width="474.75" height="256.5" alt="image" src="https://github.com/user-attachments/assets/43162287-dc24-4d73-85b9-45d515797ba9" />

---

## 4. Clean Up Old Scripts
- Remove or replace any tracking or meta scripts from the old site:
  - GTAG, CallRail, meta tags, pixels, etc.
- Check and update **Schemas**:
  - `TSEG > Schema`

---

## 5. Update Gravity Forms Notifications
- Update all form notifications (To, From, Subject, message body) with the new client’s info.

---

## 6. Search for Old Firm References
Search and replace any old details in theme files or the database:
- Old firm name  
- Address  
- Phone number  

---

## 7. Review Templates
Check for hardcoded content or brand-specific elements in:
- `/templates/`
  - `mass-torts` & `mass-torts-home`
  - `home-flex`
  - `contact-us`
  - `practice-areas`
  - `results`
  - `testimonials`
- Core templates:
  - `page.php`
  - `home.php`
  - `archive.php`
  - `404.php`
<img width="475.5" height="235.75" alt="image" src="https://github.com/user-attachments/assets/1c4da337-2fd1-4942-a94e-09add3c26a99" />

---

## 8. Note
The Griffin site includes inactive post types (disabled per client request).  
You can re-enable these anytime in ACF.

<img width="274.5" height="184" alt="image" src="https://github.com/user-attachments/assets/1cf16320-ae66-4783-8ac2-85410145ce1d" />

---

### ✅ Final Checklist
- [ ] Theme folder renamed  
- [ ] Global CSS variables updated  
- [ ] Logos and branding replaced  
- [ ] Yoast and favicon settings updated  
- [ ] Old scripts and schemas cleaned  
- [ ] Gravity Forms notifications updated  
- [ ] Old text references removed  
- [ ] Templates reviewed (UI)

---
