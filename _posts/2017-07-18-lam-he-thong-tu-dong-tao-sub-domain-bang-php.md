---
layout: post
title: Làm hệ thống tạo sub-domain tự động theo username bằng php
thumbnail: sub-domain.png
category: Chuyện lập trình
tags:
 - lap-trinh-php
 - hoc-lap-trinh-nhu-the-nao
related_posts:
 - title: Viết tính năng tự động nâng cấp phiên bản cho code PHP (PHP auto-upgrade system)
   link: https://laptrinhcuocsong.com/viet-tinh-nang-tu-dong-cap-nhat-phien-ban-code-php.html
 - title: Test website trên thiết bị di động như thế nào?
   link: https://laptrinhcuocsong.com/test-website-tren-thiet-bi-di-dong-nhu-the-nao.html
 - title: Tổng hợp tất tần tật những công cụ cần thiết cho web developer
   link: https://laptrinhcuocsong.com/tong-hop-nhung-cong-cu-can-thiet-cho-web-developer.html
 - title:
   link: https://laptrinhcuocsong.com/tao-va-xuat-ban-jquery-plugin-trong-30-phut.html
related_videos:
  -
    title: Đi thực tập IT bị cho nghỉ việc và nói rằng không có thời gian đào tạo 
    id: Zo8pGBDi6SA
  -
    title: Python làm được gì? Có nên học ngôn ngữ lập trình Python không? 
    id: 278ig6WPjiI
  -
    title: Phỏng vấn php người ta thường hỏi những câu hỏi gì?
    id: oHPvmdny9QM
  -
    title: Khi đi làm php người ta dùng những công cụ gì? 
    id: fOFKwV7OW7U
---

Chắc hẳn bạn thấy rất nhiều trang web cung cấp cho người dùng những url như thế này: `username.tenmien.com` trong đó username là do người dùng tự chọn. Những sub-domain kiểu này trông rất thân thiện và chuyên nghiệp, rất tuyệt vời phải không? Mình rất thích những trang web như thế, và trong bài viết này, chúng ta sẽ làm tính năng tương tự.

Nghe thì có vẻ phức tạp thế thôi chứ nguyên tắc thì đơn giản cực kỳ, chúng ta sẽ cấu hình để tất cả sub-domain sẽ chạy qua một wildcard DNS record. Cụ thể là trong trang quản trị domain, mình sẽ tạo một DNS record như sau:

```javascript
*.tenmien.com
```

Dấu sao \(\*\) chỉ định cho DNS server biết rằng mọi truy vấn bắt đầu bằng ký tự bất kỳ, sẽ cùng trỏ về webserver của chúng ta. Khi đã cấu hình xong, thì tất cả sub-domain sẽ đều trỏ về root của webserver, mở trình duyệt web lên, gõ thử vài sub linh tinh:

```javascript
abc.tenmien.com
xyz.tenmien.com
nguyendepzai.domain.com 
...
```

Bạn sẽ thấy tất cả đều hiện trang index.php

Đến đây thì nhiệm vụ cực kỳ đơn giản là tách cái sub kia ra để lấy username của người dùng, chúng ta có thể dùng htaccess như sau:

```javascript
RewriteCond %{HTTP_HOST} ^(^.*)\.tenmien.com
RewriteRule (.*)  index.php?username=%1
```

Sau đó lấy `$username = $_GET['username']` có username rồi thì truy vấn vào database để hiển thị nội dung tương ứng cho người dùng đó, hoặc có một cách khác để lấy chuỗi username này đó là lấy trực tiếp từ `$_SERVER["REQUEST_URI"]` như sau:

```javascript
$url = $_SERVER["REQUEST_URI"];
$username = str_replace(".tenmien.com","",$url);
```

Với thủ thuật rất đơn giản này, bạn đã có thể cho người dùng đăng ký sub-domain của riêng họ một cách rất chuyên nghiệp và mang lại sự tin tưởng cho website của bạn. Chúc các bạn thành công.
