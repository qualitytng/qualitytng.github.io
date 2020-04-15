---
layout: default
title: Chuyện nghề nghiệp
permalink: chuyen-nghe-nghiep.html
excerpt: Các bài viết về những buồn vui, khó khăn, trăn trở trong nghề lập trình
---

<div id="index">
  <div class="category_detail">
    <h1>Chuyện nghề nghiệp</h1>
    <p>Chuyện nghề nghiệp - là chuyên mục nơi một thằng coder viết về những buồn vui, khó khăn, trăn trở trong nghề lập trình.</p>
  </div>
    {% for post in site.categories['Chuyện nghề nghiệp'] %}
    <article class="post" itemscope itemtype="http://schema.org/Article">
      <h1 itemprop="name"><a itemprop="url" href="{{ site.site_url }}{{ post.url }}" title="{{ post.title | xml_escape }}" >{{ post.title | xml_escape }}</a></h1>
      {% if post.thumbnail %}
      <a href="{{ post.url }}"><img itemprop="image" src="{{ site.site_url }}/images/{{ post.thumbnail }}" alt="{{ post.title | xml_escape }}" class="post_thumbnail"></a>
      {% else %}
  <a href="{{ post.url }}"><img itemprop="image" src="{{ site.site_url }}/images/thumbnail_default.png" alt="{{ post.title  | xml_escape }}" class="post_thumbnail"></a>
      {% endif %}
      <div class="excerpt" itemprop="description">
        {{ post.excerpt }}
      </div>
      <div class="clear"></div>
    </article>

    {% endfor %}

</div>



