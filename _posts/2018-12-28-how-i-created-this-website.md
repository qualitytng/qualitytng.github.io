---
title: "How I Created this Awesome Website"
excerpt: "Using Jekyll & Github Pages"
toc: true

header:
  teaser: /assets/images/my-personal-website-th.jpg

categories:
  - Technology
  - Markdown
  - Github Pages

tags:
  - Jekyll
  - Github Pages
  - Tutorial
  - Markdown
---

# Kinh nghiệm cấu hình Github pages với Markdown

Tùy chỉnh page của mình:
- Trang layout chứa code trong blog là `single.html`.

- Code trong Github pages hiển thị ScrollBar ([Tham khảo](https://stackoverflow.com/questions/11093233/how-to-support-scrolling-when-using-pygments-with-jekyll))

    Trong file: `_sass\minimal-mistakes\_syntax.scss` tìm đến thẻ `highlight` dòng 55 và thêm 1 dòng:

    ```css
    .highlight pre {
      width: 100%;
    }
    Thay thế thành: ------------------
    .highlight pre {
      width: 100%;
      max-height: 600px;
    }
    ```
Code sẽ có thể Scroll

- Trong site, muốn có TOC thì chỉ cần trên đầu trang add thêm `toc:true` là được, kinh ngiệm cho thấy, muốn tìm gì, cứ tìm theo kiểu: `page.` trong toàn bộ project, thì nó sẽ ra, xong mò xem nó hiển thị cái gì.



## Prerequisites

  1. Passion
  2. Time
  3. Focus
  4. and ya github account too.

Why I chose Jekyll & Github pages. Its a preety long awesome story. Find it here - [Why I chose jekyll & Github pages](https://holianh.github.io/technology/website-using-jekyll-github-pages/)

Read more about [Jekyll](https://jekyllrb.com/) & [Github pages](https://pages.github.com/)

I am going to give you all resources that I used and followed for creating this website. There documentations are great and simple with examples and code snippets.

1. The theme I used is [Minimal Mistakes](https://mmistakes.github.io/minimal-mistakes/). I chose this theme because it is highly configurable. You can edit a lot of things in this theme. Documentation is preety good and also it's supported by github pages. Some themes should be compiled into  static pages first and then pushed to the respository. But this theme is compiled by github pages using there own jekyll and directly render the static pages.

2. [This quick start guide](https://mmistakes.github.io/minimal-mistakes/docs/quick-start-guide/) will set you up with basic site very quickly.

3. Now you can change most of the things using `_config.yml` file.

4. Writing posts is very easy, as easy as creating a file in `_posts` folder with post date and name. All the configuration like generating html from markdown, creating links to the posts, etc. is handled very cleanly by jekyll.

5. Creating navigation pages is also very easy, changing `_data/navigation.yml` adds new navigation link to your navigation header.

6. Also CONTACT page I used html file instead of markdown, to add div and custom style classes for form.

## Technologies used -

  * [Jekyll](https://jekyllrb.com/)
  * [Github Pages](https://pages.github.com/)
  * [Markdown](https://en.wikipedia.org/wiki/Markdown)
  * [Ruby](https://www.ruby-lang.org/en/)
  * [Liquid Template Language](https://shopify.github.io/liquid/)
  * [FormSpree](https://formspree.io/)

### Time Required - 5 days (At max, given 5 hours daily) i.e. 25 hours

Feel free to contact me, if you are stuck anywhere, Will be happy to help. BTW everything is available online. If you don't get online then probably I would also be not able to help.

Look at github issues in Minimal Mistakes respository for some tricky parts.
