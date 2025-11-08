# 📚 Hướng Dẫn Quản Lý Cài Đặt Website SCF

> **Dành cho:** Quản trị viên / Người quản lý nội dung (không cần kiến thức kỹ thuật)

---

## 🎯 Giới Thiệu

Tất cả **hình ảnh, text, liên lạc** trên website đều được quản lý tự động qua **Settings** (Cài đặt). 
Bạn **không cần sửa code**, chỉ cần vào **Filament Admin Panel** để cập nhật.

---

## 🔐 Truy Cập Admin

1. Truy cập: `https://scf.vn/admin`
2. Đăng nhập bằng tài khoản Admin
3. Tìm mục **"Settings"** hoặc **"Cài đặt"**

---

## 📋 Danh Sách Tất Cả Cài Đặt

### 📌 **CHUNG - GLOBAL SETTINGS**
Áp dụng cho toàn bộ website

| Setting Key | Nơi Sử Dụng | Mô Tả |
|---|---|---|
| `site_domain` | Tất cả trang | Tên miền website (vd: scf.vn) |
| `site_description` | SEO, Meta tags | Mô tả ngắn về công ty |

---

### 🎨 **LOGO & BIỂU TƯỢNG**
Dùng chung trên tất cả các trang

| Setting Key | Nơi Sử Dụng | Mô Tả |
|---|---|---|
| `logo_header` | Header (phía trên) | Logo SCF hiển thị ở đầu trang |
| `logo_footer` | Footer (phía dưới) | Logo SCF ở phần cuối trang |
| `sub_logo` | Các trang | Logo phụ/Icon thương hiệu |
| `placeholder_image` | Tất cả trang | Ảnh mặc định khi hình bị lỗi |

**📸 Format ảnh:** PNG, SVG, WEBP (kích thước được tự động điều chỉnh)

---

### 📞 **LIÊN HỆ - CONTACT PAGE**
*(Trang: https://scf.vn/contact)*

#### Thông Tin Liên Hệ
| Setting Key | Nơi Sử Dụng | Mô Tả | Ví Dụ |
|---|---|---|---|
| `contact_email` | Trang Contact, Form | Email để khách hàng liên lạc | `hr03.gr@gmail.com` |
| `contact_phone` | Trang Contact, Footer | Số điện thoại công ty | `0902.381.851` |
| `contact_address` | Trang Contact, Footer | Địa chỉ văn phòng | `Lầu 6, 195-197 Nguyễn Thị Nhung...` |
| `contact_working_hours` | Trang Contact | Giờ làm việc | `Thứ 2 - Thứ 7: 8:00 - 17:00` |
| `contact_map_embed` | Trang Contact | Bản đồ Google Maps | Iframe URL từ Google Maps |

#### Hình Ảnh Trang Contact
| Setting Key | Vị Trí | Mô Tả |
|---|---|---|
| `contact_hero_image` | Banner top | Ảnh chính ở đầu trang Contact |
| `contact_hero_decoration` | Banner top | Hình trang trí bên cạnh banner |
| `contact_section_image_left` | Phần thông tin | Ảnh bên trái (hình gia đình, office...) |
| `contact_section_image_right` | Phần thông tin | Ảnh bên phải (hình sản phẩm, team...) |

**💡 Tip:** Upload ảnh có chiều rộng ≥ 1200px để hiển thị sắc nét

---

### 📰 **TIN TỨC - BLOG PAGE**
*(Trang: https://scf.vn/blog)*

| Setting Key | Nơi Sử Dụng | Mô Tả | Mặc Định |
|---|---|---|---|
| `blog_section_title` | Danh sách bài viết | Tiêu đề mục Blog | "Tin tức & bài viết" |
| `blog_section_subtitle` | Danh sách bài viết | Mô tả ngắn mục Blog | "Tin ngành bán buôn & nguồn hàng" |
| `blog_hero_image` | Banner top | Ảnh chính trang Blog | - |
| `blog_hero_decoration` | Banner top | Hình trang trí Banner | - |

**📝 Chỉnh tiêu đề Blog:**
- Thay đổi `blog_section_title` nếu muốn đổi "Tin tức & bài viết" thành tên khác
- Thay đổi `blog_section_subtitle` để cập nhật dòng mô tả

---

### 💼 **TUYỂN DỤNG - CAREERS PAGE**
*(Trang: https://scf.vn/careers)*

| Setting Key | Vị Trí | Mô Tả |
|---|---|---|
| `careers_hero_image` | Banner top | Ảnh chính trang Tuyển Dụng |
| `careers_hero_decoration` | Banner top | Hình trang trí Banner |

---

### 🛍️ **SẢN PHẨM - PRODUCTS PAGE**
*(Trang: https://scf.vn/products)*

| Setting Key | Vị Trí | Mô Tả |
|---|---|---|
| `products_hero_image` | Banner top | Ảnh chính trang Sản Phẩm |
| `products_hero_decoration` | Banner top | Hình trang trí Banner |

---

### ℹ️ **GIỚI THIỆU - ABOUT PAGE**
*(Trang: https://scf.vn/about)*

| Setting Key | Vị Trí | Mô Tả |
|---|---|---|
| `about_hero_image` | Banner top | Ảnh chính trang Giới Thiệu |
| `about_hero_decoration` | Banner top | Hình trang trí Banner |

---

### 🏠 **TRANG CHỦ - HOME PAGE**
*(Trang: https://scf.vn)*

| Setting Key | Vị Trí | Mô Tả |
|---|---|---|
| `home_hero_background` | Banner hero | Ảnh nền phần hero |
| `home_hero_image` | Banner hero | Ảnh chính phần hero |
| `home_hero_decoration` | Banner hero | Hình trang trí phần hero |

---

### 🦶 **FOOTER - Dùng chung tất cả trang**

| Setting Key | Vị Trí | Mô Tả |
|---|---|---|
| `footer_decoration_image` | Phía dưới footer | Hình trang trí footer |

---

### 🏷️ **NỌI DUNG VĂN BẢN - BUTTONS/LABELS**
Các nhãn nút bấm trên website

| Setting Key | Nơi Sử Dụng | Mô Tả | Mặc Định |
|---|---|---|---|
| `button_contact_label` | Tất cả trang | Text nút "Liên hệ" | "Liên hệ" |
| `button_read_more_label` | Blog, Products | Text nút "Đọc thêm" | "Tìm hiểu thêm" |
| `button_learn_more_label` | Các mục khác | Text nút "Tìm hiểu thêm" | "Đọc thêm" |

---

## 🚀 Hướng Dẫn Cập Nhật

### **Cách 1: Cập Nhật Hình Ảnh**

1. Vào **Filament Admin** > **Settings**
2. Tìm Setting cần thay đổi (vd: `contact_hero_image`)
3. Click **Choose Image** (hoặc **Upload**)
4. Chọn hình từ máy tính
5. Click **Save**

✅ **Hình ảnh sẽ cập nhật tức thì trên website**

---

### **Cách 2: Cập Nhật Text/Thông Tin**

1. Vào **Filament Admin** > **Settings**
2. Tìm Setting cần thay đổi (vd: `contact_email`)
3. Xóa nội dung cũ, nhập nội dung mới
4. Click **Save**

✅ **Text sẽ cập nhật tức thì trên website**

---

### **Cách 3: Cập Nhật Bản Đồ Google Maps**

1. Vào Google Maps: https://maps.google.com
2. Tìm địa chỉ công ty
3. Click **Share** → **Embed a map**
4. Copy **Iframe** code
5. Vào **Settings** > `contact_map_embed`
6. Paste code vào
7. Click **Save**

✅ **Bản đồ trên trang Contact sẽ cập nhật**

---

## 📊 Ví Dụ Thực Tế

### ❌ **Sai:**
- Thay đổi tệp ảnh trong thư mục `public/images/` trực tiếp
- Sửa code file `.blade.php`
- Tải ảnh lên mà không qua Settings

### ✅ **Đúng:**
- Vào **Filament Admin** > **Settings**
- Tìm key tương ứng
- Upload ảnh hoặc nhập text mới
- Click **Save**

---

## 🔧 Danh Sách Tất Cả Settings (Để In Tham Khảo)

```
📋 CHUNG
- site_domain
- site_description

🎨 LOGO
- logo_header
- logo_footer
- sub_logo
- placeholder_image

📞 LIÊN HỆ
- contact_email
- contact_phone
- contact_address
- contact_working_hours
- contact_map_embed
- contact_hero_image
- contact_hero_decoration
- contact_section_image_left
- contact_section_image_right

📰 TIN TỨC
- blog_section_title
- blog_section_subtitle
- blog_hero_image
- blog_hero_decoration

💼 TUYỂN DỤNG
- careers_hero_image
- careers_hero_decoration

🛍️ SẢN PHẨM
- products_hero_image
- products_hero_decoration

ℹ️ GIỚI THIỆU
- about_hero_image
- about_hero_decoration

🏠 TRANG CHỦ
- home_hero_background
- home_hero_image
- home_hero_decoration

🦶 FOOTER
- footer_decoration_image

🏷️ NỘI DUNG VĂN BẢN
- button_contact_label
- button_read_more_label
- button_learn_more_label
```

---

## ❓ Câu Hỏi Thường Gặp (FAQ)

**Q: Tôi thay đổi cài đặt nhưng website không cập nhật?**
> A: Thử Clear Cache (F5 hoặc Ctrl+Shift+R). Nếu vẫn không được, liên hệ kỹ thuật viên.

**Q: Ảnh tôi upload bị mờ/không sắc nét?**
> A: Ảnh cần có chiều rộng ≥ 1200px. Upload lại ảnh chất lượng cao hơn.

**Q: Tôi muốn thêm setting mới, làm sao?**
> A: Liên hệ kỹ thuật viên, họ sẽ thêm key mới vào cơ sở dữ liệu.

**Q: Có thể phục hồi cài đặt cũ không?**
> A: Có, liên hệ admin để backup/restore. Tuyệt đối không tự xóa Settings.

**Q: Hình ảnh có tối ưu được không?**
> A: Ảnh sẽ tự động được cache và nén theo kích thước. Không cần lo.

---

## 🆘 Liên Hệ Hỗ Trợ

- 📧 Email: `hr03.gr@gmail.com`
- 📱 Điện thoại: `0902.381.851`
- ⏰ Giờ làm việc: Thứ 2 - Thứ 7, 8:00 - 17:00

---

**Cập nhật lần cuối:** 2025
**Phiên bản:** 1.0
