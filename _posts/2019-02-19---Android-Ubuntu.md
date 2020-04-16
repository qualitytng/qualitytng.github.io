---
title: "Android với Ubuntu"
excerpt: " "
toc: true


header:
  teaser: https://www.omgubuntu.co.uk/wp-content/uploads/2018/03/connect-android-to-ubuntu.jpg
  overlay_image: https://www.omgubuntu.co.uk/wp-content/uploads/2018/03/connect-android-to-ubuntu.jpg
  overlay_color: "#000"
  overlay_filter: 0.6

sidebar:
  - title: "các loại mẹo Android với Ubuntu "
    image: https://www.omgubuntu.co.uk/wp-content/uploads/2018/03/connect-android-to-ubuntu.jpg
    image_alt: "logo"
    text: ""
  - title: ""
    text: ""

categories:
  - Phone
  - ubuntu
  - Android

tags:
  - Phone
  - Android
  - Ubuntu-Android

public: false   
---

# Copy Ubuntu - Android:
- Khi đang copy mà bị lỗi => rút ra hoặc ép tắt file manager sẽ dẫn đến chết file: libmtp => lần sau cắm vào, không copy vào phone được nữa.

    Sửa: ép cài lại libmtp:

    ```bash
    sudo apt install libmtp-common mtp-tools libmtp-dev libmtp-runtime libmtp9 --reinstall
    ```




# Ubuntu:

## Remove write protected folders

remove folder name: anaconda3

```
sudo find anaconda3/ -perm /0222 -delete
```

## Copy folders/files 2 users

Đứng từ user `u`, copy anaconda3 sang user `am`
copy then transfer owner:

    -r: copy all folders
    -q: silent copy

```
scp -r -q anaconda3/ am@localhost:/home/am
```












.
