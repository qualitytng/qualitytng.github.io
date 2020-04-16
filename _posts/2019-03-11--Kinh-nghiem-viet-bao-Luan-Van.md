---
title: "Kinh nghiệm viết báo - Luận văn = Latex"
excerpt: " "
toc: true

header:
  teaser: assets/images/blog/writethesis.jpeg
  overlay_image: /assets/images/blog/writepaper.jpeg
  overlay_color: "#000"
  overlay_filter: 0.6

sidebar:
  - title: "Viết chuẩn"
    image: /assets/images/blog/writepaper.jpeg
    image_alt: "logo"
    text: "Để viết chuẩn một bài báo"
  - title: ""
    text: ""

categories:
  - paper
  - thesis

tags:
    - paper
    - thesis
    - Cách viết 1 bài báo


public: True   
---

# Công cụ:
Các công cụ đang dùng:

- Latex ubuntu
-

# Tài nguyên

- JMLR template + hướng dẫn trình bày: [Tải về](http://www.jmlr.org/format/format.html)

# Trang web rất cần thiết
các trang hỗ trợ khi viết báo

## Convert:
- Chuyển đổi [References từ word sang bibtex cho Latex](https://rintze.zelle.me/ref-extractor/)

# Lệnh Latex hữu ích

## Hình Ảnh
- Chèn hình ở PDF và tex:
    ```
    \begin{figure}
      \centering
      \includegraphics[scale=1,trim=4 4 4 4,clip]{Figures/Bai1-Hinh3-resnet.pdf}
      \caption{Residual network block}
      \label{fig:Fig_reset}
    \end{figure}
    ```

- Chèn nguyên cả trang PDF và tex:
`\includepdf[pages=61,width=\paperwidth,height=\paperheight]{yourfile.pdf}`

- How to include PDF pages without a newpage before the first page?

    ```
    \includepdf[pages=1,pagecommand=\section{Section Heading}]{testpdf}
    \includepdf[pages=2-,pagecommand={}]{testpdf}
    ```

























-
