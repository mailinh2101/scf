# 🎯 SiteSetting Quick Reference Card

**In ra và dán trên bàn của người quản lý!**

---

## 🚀 3 Bước Update Website

### **Bước 1: Login**
→ `https://scf.vn/admin` → Nhập username/password

### **Bước 2: Tìm Settings**
→ **Filament > Settings** → Tìm setting cần update

### **Bước 3: Lưu**
→ Nhập/chọn giá trị mới → Click **Save** → ✅ Xong!

---

## 📍 Settings Theo Trang

### 📞 **TRANG LIÊN HỆ** (https://scf.vn/contact)
| Setting | Ví Dụ |
|---|---|
| `contact_email` | `hr03.gr@gmail.com` |
| `contact_phone` | `0902.381.851` |
| `contact_address` | `Lầu 6, 195-197... HCM` |
| `contact_working_hours` | `Thứ 2 - Thứ 7: 8:00-17:00` |
| `contact_hero_image` | *Upload ảnh banner* |
| `contact_section_image_left` | *Upload ảnh bên trái* |
| `contact_section_image_right` | *Upload ảnh bên phải* |

### 📰 **TRANG TIN TỨC** (https://scf.vn/blog)
| Setting | Ví Dụ |
|---|---|
| `blog_section_title` | `Tin tức & bài viết` |
| `blog_section_subtitle` | `Tin ngành bán buôn & nguồn hàng` |
| `blog_hero_image` | *Upload ảnh banner* |

### 💼 **TRANG TUYỂN DỤNG** (https://scf.vn/careers)
| Setting | Ví Dụ |
|---|---|
| `careers_hero_image` | *Upload ảnh banner* |

### 🏠 **TRANG CHỦ** (https://scf.vn)
| Setting | Ví Dụ |
|---|---|
| `home_hero_image` | *Upload ảnh banner* |

### 🎨 **LOGO & ICONS** (Dùng chung)
| Setting | Ví Dụ |
|---|---|
| `logo_header` | *Logo phía trên* |
| `logo_footer` | *Logo phía dưới* |

---

## 🖼️ Cách Upload Ảnh

1. Click vào field có icon 📁
2. Chọn **"Choose Image"**
3. Chọn file từ máy tính
4. Click **"Save"**
5. ✅ Ảnh sẽ cập nhật trên website

**💡 Tip:** Ảnh tốt nhất nên ≥ 1200px chiều rộng

---

## ✏️ Cách Update Text

1. Tìm field text
2. Xóa nội dung cũ
3. Gõ nội dung mới
4. Click **"Save"**
5. ✅ Text sẽ cập nhật tức thì

---

## 🗺️ Cách Update Bản Đồ

1. Vào **Google Maps** → Tìm địa chỉ công ty
2. Click **"Share"** → **"Embed a map"**
3. Copy code **Iframe**
4. Vào Settings → `contact_map_embed`
5. Paste code vào
6. Click **"Save"**
7. ✅ Bản đồ cập nhật

---

## ❓ Câu Hỏi Nhanh

**Q: Tôi update xong nhưng website không đổi?**
→ A: F5 browser, hoặc Ctrl+Shift+R để xóa cache

**Q: Ảnh upload bị mờ?**
→ A: Upload ảnh chất lượng cao hơn (≥1200px)

**Q: Tôi muốn thêm setting mới?**
→ A: Liên hệ kỹ thuật viên

**Q: Có khôi phục được giá trị cũ không?**
→ A: Liên hệ IT để backup/restore

---

## 📞 Cần Giúp?

📧 **Email:** hr03.gr@gmail.com
📱 **Điện thoại:** 0902.381.851
⏰ **Thời gian:** Thứ 2-7, 8:00-17:00

---

## ✅ Danh Sách 42+ Settings

```
🌍 GLOBAL:              site_domain, site_description

🎨 LOGOS:               logo_header, logo_footer, sub_logo, placeholder_image

📞 CONTACT (9):
   - contact_email, contact_phone, contact_address, contact_working_hours, contact_map_embed
   - contact_hero_image, contact_hero_decoration
   - contact_section_image_left, contact_section_image_right

📰 BLOG:                blog_section_title, blog_section_subtitle, blog_hero_image, blog_hero_decoration

💼 CAREERS:             careers_hero_image, careers_hero_decoration

🛍️ PRODUCTS:           products_hero_image, products_hero_decoration

ℹ️ ABOUT:               about_hero_image, about_hero_decoration

🏠 HOME:                home_hero_background, home_hero_image, home_hero_decoration

🦶 FOOTER:              footer_decoration_image

🏷️ LABELS:             button_contact_label, button_read_more_label, button_learn_more_label
```

---

**Version:** 1.0 | **Updated:** 2025
