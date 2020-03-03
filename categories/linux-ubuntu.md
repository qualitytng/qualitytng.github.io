---
layout: default
title: Linux - ubuntu
permalink: linux-ubuntu.html
excerpt: Các bài viết về học ubuntu, linux, hướng dẫn cài đặt và sử dụng ubuntu vào công việc
---
<div id="index">
	<div class="category_detail">
	<h1>Linux - ubuntu</h1>
	<p>Linux - ubuntu là chuyên mục mà một thằng coder viết về hệ điều hành hắn yêu thích, chia sẻ mọi thứ hắn biết về ubuntu và linux.</p>
	</div>
    {% for post in site.categories['Linux - ubuntu'] %}

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


