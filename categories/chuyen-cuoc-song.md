---
layout: default
title: Chuyện cuộc sống
permalink: chuyen-cuoc-song.html
excerpt: Các bài viết về những buồn vui trong cuộc sống của lập trình viên và những người làm trong ngành công nghệ
---

<div id="index">
  <div class="category_detail">
    <h1>Chuyện cuộc sống</h1>
    <p>Những buồn vui trong cuộc sống của lập trình viên và những người làm trong ngành công nghệ.</p>
  </div>
    {% for post in site.categories['Chuyện cuộc sống'] %}
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
