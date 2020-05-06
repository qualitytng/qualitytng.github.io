---
layout: post
title: Series nghịch ngợm - Điều gì sẽ sảy ra nếu ta vẽ 1 triệu thẻ div lên màn hình
thumbnail: benchmark.png
category: Chuyện lập trình
related_posts:
 - title: Series nghịch ngợm - Lập trình phần mềm paint, vẽ trên web với html5 và javascript
   link: https://laptrinhcuocsong.com/series-nghich-ngom-lap-trinh-phan-mem-paint-ve-tren-web-html5-javascript.html
 - title: Nếu một ngày những đoạn mã lập trình biến mất
   link: https://laptrinhcuocsong.com/neu-mot-ngay-nhung-doan-ma-lap-trinh-bien-mat.html
 - title: Tổng hợp tất tần tật những công cụ cần thiết cho web developer
   link: https://laptrinhcuocsong.com/tong-hop-nhung-cong-cu-can-thiet-cho-web-developer.html
 - title:
   link: https://laptrinhcuocsong.com/series-nghich-ngom-lam-game-hung-trung.html
related_videos:
  -
    title: Thiết kế website cá nhân trên photoshop
    id: 9RQkB365RwQ
  -
    title: Sinh viên IT ngày xưa như thế nào? Dùng máy tính mạnh không?
    id: ClsOD7jAsQ4
  -
    title: Cảm giác khi thử lập trình pascal, trở về tuổi thơ dữ dội sau 10 năm 
    id: 0UO9UKjVQ68
  -
    title: Troll zero9 - Lập trình viên nghĩ gì khi xem clip của zero9 
    id: xsI6r6zYTp0
---

Khi cắt giao diện html/css chúng ta luôn được dạy rằng phải sử dụng ít thẻ html nhất có thể nhằm tăng tốc độ khi trình duyệt render mã html, số lượng thẻ html ít hơn thì trình duyệt sẽ không phải tính toán chiều rộng, chiều cao, màu sắc... của các element không cần thiết, từ đó tăng tốc độ hiển thị trang web. Trong series nghịch ngợm (nghịch dại) lần này, chúng ta sẽ cùng thử nghiệm khả năng xử lý của trình duyệt chrome bằng cách vẽ 1 triệu thẻ div lên màn hình.

Mình sẽ dùng PHP đọc từng điểm ảnh của một file ảnh có kích thước 1000x1000 pixcel, lấy các thông số màu sắc RGB, sau đó vẽ lên màn hình các thẻ div có kích thước 1x1 pixcel. Chúng ta sẽ được một hình ảnh được tạo từ 1 triệu thẻ div.

```javascript
<div id="image">
<?php
set_time_limit(1000000);
$image = imagecreatefromjpeg('image.jpg');

$image_width = imagesx($image);
$image_height = imagesy($image);

for($y = 0; $y < $image_height; $y++){
	for($x = 0; $x < $image_width; $x++){
		$rgb = imagecolorat($image, $x, $y);
		$color = imagecolorsforindex($image, $rgb);
		echo '<div style="background-color: rgb('.$color['red'].','.$color['green'].','.$color['blue'].')"></div>';
	}
}
?>
</div>
```

Thẻ div#image dùng để bao toàn bộ các div nhỏ 1x1 mà ta đã nói ở trên, mình đặt kích thước của nó bằng kích thước ảnh, các div nhỏ ở trong mình để float left.

```javascript
#image div {
  width: 1px;
  height: 1px;
  float: left;
}
```

Trong khoảng 100k thẻ div đầu tiên, chrome hiển thị rất nhanh

![thử nhiệm vẽ 1 triệu thẻ div](images/chrome-test-start.gif)

Trong thời gian 5 phút, chrome vẫn load, được khoảng 350k thẻ div

![thử nhiệm vẽ 1 triệu thẻ div](images/chrome-test-5.png)

Sau 10 phút, vẫn không thêm được bao nhiêu, nhưng chrome vẫn tiếp tục, kiên trì bền bỉ.

![thử nhiệm vẽ 1 triệu thẻ div](images/chrome-test-10.png)

Sau 15 phút

![thử nhiệm vẽ 1 triệu thẻ div](images/chrome-test-15.png)

Sau 20 phút, tốc độ render đã chậm đi khá nhiều.

![thử nhiệm vẽ 1 triệu thẻ div](images/chrome-test-20.png)

Sau 35 phút, cảm thấy hối hận vì đã làm bài test ngu xuẩn này :)

![thử nhiệm vẽ 1 triệu thẻ div](images/chrome-test-35.png)

Và cuối cùng, điều anh không muốn cứ vẫn luôn xảy ra, chrome đã crash, tuy nhiên, con số 900k thẻ div là khá ấn tượng.

![thử nhiệm vẽ 1 triệu thẻ div](images/chrome-test-crash.png)

Kết luận: Trong điều kiện thử nghiệm, Google Chrome đã hiển thị được khoảng 900k thẻ div trong vòng 43 phút.  Vì chrome hiển thị 100k thẻ div đầu tiên rất nhanh nên chả việc gì phải tiết kiệm vài cái thẻ div trong code html làm gì cho mệt mỏi cả.
