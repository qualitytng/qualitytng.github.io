---
title: "Thêm Facebook comments vào trang web"
excerpt: "Cách thêm FB comments, nhiều chỗ chỉ cách quá, không nhớ nổi!"
toc: true

header:
  #teaser: /assets/images/blog/fb.jpeg
  overlay_image: /assets/images/blog/fb.jpeg #/assets/images/blog/staticman.jpg
  overlay_color: "#030"
  overlay_filter: 0.2

categories:
  - WEB
comments: True
tags:
  - jekyll
  - github pages
  - facebook
---

# Thêm Facebook comments vào trang web

- Hãy bắt đầu [từ đây](https://developers.facebook.com/apps), và [từ đây](https://developers.facebook.com/docs/javascript/quickstart)
- Thêm comments vào pages, `% include comments.html %` thay vào chỗ  `\_layouts\\single.html`, như sau:

```markdown
{ % if jekyll.environment == 'production' and site.comments.provider and page.comments % }
  { % include comments.html % }
{ % endif % }
đổi thành:
{ % include comments.html % }
```
nhớ bỏ dấu cách giữa { và % (ở đây code vào nó lỗi nên đêt thêm dấu cách)

## Tham khảo thêm:

Facebook comment code

Step 1: Include the facebook comment plugin code on your page once, ideally right after the opening <body> tag.

```javascript
<div id="fb-root"></div>

<script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
```

Step 2: Place the facebook comment plugin html code inside data-sub-html attribute of each lightgallery item.

```html
<!-- data-href should be the unique image url -->
<div class="fb-comments" data-href="{{ page.url | absolute_url }}" data-width="400" data-numposts="5"></div>
```

<!-- <div class="fb-comments" data-href="{{ page.url | absolute_url }}" data-width="400" data-numposts="5"></div> -->
