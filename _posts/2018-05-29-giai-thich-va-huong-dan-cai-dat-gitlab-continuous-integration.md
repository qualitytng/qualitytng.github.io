---
layout: post
title: Giải thích và hướng dẫn cài đặt Gitlab Continuous Deployment một cách dễ hiểu nhất
category: Chuyện lập trình
thumbnail: gitlab-ci-thumb.png
tags:
 - tu-hoc-linux
 - hoc-ubuntu
related_posts:
 - title: 
   link: https://laptrinhcuocsong.com/nhung-phan-mem-nen-cai-dat-tren-ubuntu.html
 - title: 
   link: https://laptrinhcuocsong.com/cai-dat-moi-truong-lap-trinh-web-tren-ubuntu-phan-1.html
 - title: 
   link: https://laptrinhcuocsong.com/thay-doi-che-do-io-schedule-de-tang-toc-ubuntu.html
 - title:
   link: https://laptrinhcuocsong.com/tai-sao-dan-lap-trinh-thuong-fa.html
related_videos:
  -
    title: Sự khác nhau giữa lập trình viên miền Bắc và miền Nam
    id: N0K7ZONRs6w
  -
    title: Đang code mà buồn tè thì làm thế nào?
    id: 5lkDOd8PKHc
  -
    title: Lập trình viên và chuyện tình yêu, chia tay, buồn, cắm đầu vào code
    id: Nbu8tBtef3c
  -
    title: Live stream - backend hay frontend dễ kiếm việc làm hơn
    id: VvPv9kiB01A
---

Có lẽ bạn đã từng nghe ở đâu đó về continuous integration (CI - tích hợp liên tục) và continuous deployment (CD - triển khai liên tục). Trong bài viết này mình sẽ cố gằng giải thích và hướng dẫn các bạn cài đặt sử dụng Gitlab CI, CD một cách dễ hiểu nhất.

## CI - Tích hợp liên tục là gì?

Nghe tên thôi là cũng gần gần hiểu rồi, nôm na nó là phương pháp phát triển phần mềm yêu cầu dev nộp code thường xuyên, nộp code hàng ngày. Code được "tích hợp" liên tục lên test server, khi một đoạn code bị lỗi, cả team có thể sớm phát hiện và sửa chữa ngay lập tức.

## CD - Triển khai liên tục là gì?

Đồng hành cùng tích hợp liên tục, triển khai liên tục là thường xuyên release phiên bản mới lên môi trường test, việc này được diễn ra tự động, giảm gánh nặng cho [lập trình viên](https://laptrinhcuocsong.com/tags/lap-trinh-vien) để lập trình viên tập trung vào việc code mà thôi.

Ví dụ bình thường, để xuất bản website, bạn phải làm rất nhiều thứ, từ upload code lên server, chạy migrate dữ liệu, cấu hình file config các kiểu, rất tốn thời gian và dễ sai sót. Thì với triển khai liên tục, bạn chỉ cần push code lên git là mọi thứ được tự động deploy lên server test mà bạn không cần phải đụng chân đụng tay gì.

Nội dung chính của bài viết này sẽ hướng dẫn bạn cài đặt làm sao để nó "tự động" được.

## Continuous Deployment với Gitlab CI - CD

Gitlab là mã nguồn mở để tạo git server, nôm na là để tạo hệ thống giống github. Gitlab CI - CD là một tool tự động deploy ứng dụng, thật ra thì có rất nhiều tool tương tự (ví dụ Jenkins, Travis CI) nhưng trong khuôn khổ bài viết này, mình sẽ hướng dẫn bạn sử dụng Gitlab CI - CD để tự động deploy ứng dụng.

Thêm cái hình sơ đồ cho nó nguy hiểm:

![gitlab](images/gitlab-ci-flow.png)

Theo sơ đồ trên, đầu tiên, một thằng dev nào đó push code lên gitlab.

Khi code trên gitlab thay đổi, Gitlab sẽ gọi thằng Gitlab runner đã được cài sẵn trên server của mình.

Gitlab runner nghe thấy, nó sẽ làm tất cả các công việc còn lại, lấy code về, cài các packages, copy file, sửa file config... vân vân và vân vân, nó làm tất cả những gì chúng ta chỉ định cho nó.

Đến đây thì có lẽ các bạn đã thấy sướng rồi, việc của dev chỉ là push code lên và đi uống cafe, tất cả các việc còn lại là tự động.

## Cài đặt như thế nào?

## Phần 1: Cấu hình gitlab CI

Để gitlab hiểu được rằng repo của chúng ta có sử dụng tính năng tự động deploy, chúng ta cần tạo file `.gitlab-ci.yml` đặt ở thư mục gốc của project. Đây là file .gitlab-ci.yml của mình:

```javascript
deploy-test:
  before_script:
    - 'which ssh-agent || ( yum update -y && yum install openssh-client -y )'
    - eval $(ssh-agent -s)
    - echo "$SSH_PRIVATE_KEY" | tr -d '\r' | ssh-add - > /dev/null
    - mkdir -p ~/.ssh
    - chmod 700 ~/.ssh
    - whoami
    - cd /var/www/html/project_folder
  script:
    - git pull
    - cp app/install/.server_test_db.php app/config/database.php 
    - php index.php migrate
  only:
    - test-server
```

Giải thích:

Chúng ta đã đặt một job tên là `deploy-test`, bạn có thể thêm nhiều job khác tương tự tùy theo mong muốn.

`before_script`: là đoạn script mặc đinh, nó sẽ chạy trước tiên, ở đây nó sẽ xác nhận private key (tí mình sẽ nói ở phần dưới), làm vài thứ linh tinh và cd vào thư mục dự án.

`script`: là tất cả những lệnh mà bạn muốn gitlab runner sẽ chạy, cụ thể ở ví dụ này, mình sửa file .htaccess để đưa website về chế độ bảo dưỡng, lấy code về, copy file cấu hình database vào đúng vị trí, chạy migrate dữ liệu và mở lại website. Tóm lại là bạn muốn nó làm gì thì cứ điền câu lệnh cần làm vào đây.

`only`: là nhánh bạn cần deploy, ở đây mình tạo luôn một nhánh tên là `test-server` rồi, cứ cái nhánh này có thay đổi code thì job sẽ chạy.

## Phần 2: Cài đặt gitlab runner:

Như giải thích ở hình trên, gitlab runner là một tool được cài trên server, chăm chú lắng nghe, khi nào được bảo làm gì thì làm đó.

Cách cài thì trên document của nó có rồi, nhưng theo kinh nghiệm của mình, bạn đừng cài bản 10, lỗi mình không chịu trách nhiệm :)

Trên centos mình cài bản 9 như sau:

```javascript
curl -L https://packages.gitlab.com/install/repositories/runner/gitlab-ci-multi-runner/script.rpm.sh | sudo bash

sudo yum install gitlab-ci-multi-runner
```

Cài đặt xong, bước tiếp theo bạn phải đăng ký một runner, trước hết bạn vào `Settings` - `CI - CD` mở phần `Runners settings` để lấy token.

![gitlab](images/gitlab-runner-token.png)

Giờ thì bạn đăng ký runner mới bằng lệnh này:

```javascript
sudo gitlab-ci-multi-runner register
```

Quá trình đăng ký runner khá đơn giản, nó sẽ hỏi đủ các kiểu, việc của bạn là cứ trả lời theo nó thôi, khi nó hỏi token thì paste token ở bước trước vào.

## Phần 3: Kết nối gitlab runner với repo của mình:

Bây giờ gitlab và gitlab runner vẫn chưa nhìn thấy nhau, ta phải kết nối thằng gitlab runner này với repo của mình. Muốn kết nối được chúng ta cần add key vào gitlab, để gitlab có thể gọi đến server của chúng ta. Bạn chạy `ssh-keygen` để tạo ssh key như bình thường, nếu có key rồi thì thôi.

Mở nó ra bằng trình soạn thảo yêu thích của bạn:

```javascript
vi ~/.ssh/id_rsa
```

Bạn hãy copy nội dung private key, quay trở lại gitlab, dán toàn bộ nội dung đã copy dán vào, tên variable key bắt buộc phải là `SSH_PRIVATE_KEY`

![gitlab](images/gitlab-ci-secret-variable.png)

Đến đây thì bạn đã hoàn thành cài đặt đã hoàn tất, chúng ta có thể xem danh sách các task, trạng thái task được run thành công hay không, pass hay fail.

![gitlab](images/gitlab-ci-pipelines.png)

Kể từ đây cứ mỗi lần chúng ta push code lên, nó sẽ tự động làm mọi thứ, quá nhàn hạ, cuộc đời thật là tươi đẹp.
