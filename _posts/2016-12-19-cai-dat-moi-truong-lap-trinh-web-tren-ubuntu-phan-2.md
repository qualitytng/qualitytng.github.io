---
layout: post
title: Cài đặt môi trường lập trình web trên ubuntu - Phần 2
category: Linux - ubuntu
thumbnail: ubuntu-php.jpg
tags:
 - tu-hoc-linux
 - hoc-ubuntu
related_posts:
 - title: 
   link: https://laptrinhcuocsong.com/cai-dat-moi-truong-lap-trinh-web-tren-ubuntu-phan-1.html
 - title: 
   link: https://laptrinhcuocsong.com/lap-trinh-tren-ubuntu-cac-phan-mem-web-developer-can-cai-dat.html
 - title: 
   link: https://laptrinhcuocsong.com/thay-doi-che-do-io-schedule-de-tang-toc-ubuntu.html
 - title: 
   link: https://laptrinhcuocsong.com/nhung-phan-mem-nen-cai-dat-tren-ubuntu.html
related_videos:
  -
    title: Học linux để làm gì? Học linux như thế nào cho hiệu quả?
    id: ypY1YU_zJAM
  -
    title: Mới học lập trình thì làm phần mềm gì để khỏi nhàm chán?
    id: XCgmcG2lfnw
  -
    title: Nghề lập trình, khó có vợ, khó giàu, có bao giờ bạn cảm thấy chán nản
    id: eZKyRRw3Hcs
  -
    title: Công nghệ thông tin theo khối nào? khối D là câu trả lời
    id: aYA_Jsoe-jM
---
Trong [phần 1](https://laptrinhcuocsong.com/cai-dat-moi-truong-lap-trinh-web-tren-ubuntu-phan-1.html), mình đã hướng dẫn các bạn cài đặt apache, php, mysql trên ubuntu, hôm nay chúng ta sẽ tiếp tục cài đặt các phần mềm liên quan để ubuntu để phục vụ công việc lập trình web.

## Cài đặt và cấu hình sublime text

Sublime text là một text editor rất mạnh, hỗ trợ nhiều plugin hay và được nhiều lập trình viên yêu thích. Đặc biệt, sublime text là một phần mềm đa nền tảng (multi-platform) hỗ trợ cả linux.

<p><a href="https://www.sublimetext.com/3" class="download">Tải sublime text</a></p>

Tuy nhiên phiên bản trên linux lại không hỗ trợ gõ tiếng Việt, do vậy chúng ta phải cài một plugin có tên là VN IME.

Nhấn Ctrl + Shift + P chọn Install package và gõ "VN IME" để cài đặt

![VN IME](images/vn-ime.png)

Sau khi cài đặt xong, vào menu Preference - Settings và thiết lập bật gõ telex lên như thế này:

```
telex: true
```

Khởi động lại sublime và chúng ta đã có thể gõ tiếng Việt, tuy nhiên, font chữ của sublime quá xấu, khi nhấn tab thì dù có chỉnh tab size là 4 thì nó vẫn không thụt vào đúng 4 chữ cái. Chúng ta phải sử dụng font monospace để chiều rộng của tất cả các chữ cái bằng nhau, kể cả dấu cách.

<p><a href="https://drive.google.com/file/d/0B2-NdjFXI2hOeVhEX1pSdFg1YjA/view?usp=sharing" class="download">Download font cho ubuntu</a></p>

Sau đó copy vào thư mục /usr/share/fonts . Quay trở lại sublime text rồi chỉnh setting như sau:

```
"font_face": "Roboto Mono",
"font_size": 11,
```

Phím tắt để bật/tắt gõ tiếng Việt là phím F2

## Quản lý Mysql với Mysql workbench

Mysql workbench là một công cụ quản trị cơ sở dữ liệu một cách dễ dàng. Có rất nhiều các phần mềm khác có tính năng tương tự, nhưng Mysql workbench là một sản phẩm chính thống, được giới thiệu chính thức trên trang chủ mysql.com và có sẵn trên Ubuntu software center.

![Mysql workbench](images/mysql-workbench.png)

## Cài đặt Svn client

SVN client là công cụ đắc lực để quản lý mã nguồn, bao gồm các thao tác chính là thêm, bớt, sửa, xóa, checkin, checkout, so sánh phiên bản. Cực kỳ cần thiết khi phát triển phần mềm theo nhóm.

Trên ubuntu cũng có rất nhiều svn client khác nhau, tuy nhiên mình giới thiệu RabbitVCS vì nó rất dễ sử dụng và giống hệt với TortoiseSVN nổi tiếng trên windows.

![RabbitVCS](images/rabbitvcs.png)

Cài đặt RabbitVCS Svn:

```
sudo add-apt-repository ppa:rabbitvcs/ppa
sudo apt-get update
sudo apt-get install rabbitvcs-nautilus3
```

Hoặc bạn có thể sử dụng một phần mềm svn client khác cũng khá nổi tiếng, dễ sử dụng và có sẵn trên Ubuntu software center là RapidSVN, mình cũng rất thích phần mềm này. 

![RapidSVN](images/rapidsvn.png)

## Cài đặt Gimp và Photoshop

GIMP (viết tắt của GNU Image Manipulation Program) là chương trình xử lý hình ảnh được phát triển bởi GNU. Sau khi học gimp một thời gian, mình có thể khẳng định rằng gimp hoàn toàn đủ khả năng để sử dụng trong việc thiết kế và cắt layout web. Hoàn toàn miễn phí và dễ sử dụng. Gimp có sẵn trên Ubuntu software center.

![gimp](images/gimp.png)

Tuy nhiên, nếu bạn đã quen với việc cắt giao diện bằng photoshop, chúng ta vẫn có thể cài đặt photoshop trên ubuntu thông qua wine.

Để cài đặt, bạn vào Ubuntu software center tìm wine program loader, cài đặt nó.

<p><a href="https://drive.google.com/file/d/0B2-NdjFXI2hOSUl2QmNSLU91OTg/view?usp=sharing" class="download">Download Adobe Photoshop CS6 Extended for ubuntu</a></p>

Tải xong các bạn giải nén và click chuột phải vào Adobe Photoshop CS6 Extended.exe và chọn open with => wine windows programs loader và cài đặt như bình thường.

Chúc các bạn thành công!
