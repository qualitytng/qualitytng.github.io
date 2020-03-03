---
layout: default
title: Chuyện bên lề
permalink: chuyen-ben-le.html
excerpt: Các bài viết về mọi thứ liên quan đến cuộc sống của một lập trình viên
---
<div id="index">
  <div class="category_detail">
    <h1>Chuyện bên lề</h1>
    <p>Chuyện bên lề - là chuyên mục viết về mọi thứ liên quan đến cuộc sống của một thằng coder.</p>
  </div>
    {% for post in site.categories['Chuyện bên lề'] %}

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


