---
title: "Adding comments system in your jekyll and github pages"
excerpt: "Adding comment system like facebook, disqus or staticman"

toc: true
header:
  teaser: /assets/images/blog/staticman-th.jpg
  overlay_image: /assets/images/blog/staticman.jpg
  overlay_color: "#000"
  overlay_filter: 0.6

categories:
  - Technology

tags:
  - jekyll
  - github pages
  - staticman
---

There are many options available with us for adding a commenting system in our jekyll website, These are-
 * disqus
 * discourse
 * facebook
 * google-plus
 * [staticman](https://staticman.net/)
 * custom

I chose staticman as my commenting system because it allows posting comments without any log-in required as in facebook and others.

Also it will then push the comment to website repository and save it in `_data` files.

## Steps for integrating Staticman comments in jekyll
 1. Allow Staticman push access to your GitHub repository by clicking on **Settings**, then the **Collaborators** tab and adding `staticmanapp` as a collaborator.
 2. To accept the pending invitation visit: `https://api.staticman.net/v1/connect/{your GitHub username}/{your repository name}`. Example `https://api.staticman.net/v1/connect/holianh/holianh.github.io`
 3. Some changes to `_config.yml` file-
   * add comments provider as staticman
   ```yaml
   comments:
     provider: "staticman"
   staticman:
     allowedFields          : ['name', 'email', 'url', 'message']
     branch                 : # "master", "gh-pages"
     commitMessage          : "New comment."
     filename               : comment-{@timestamp}
     format                 : "yml"
     moderation             : false
     path                   : "_data/comments/{options.slug}"
     requiredFields         : ['name', 'email', 'message']
     transforms:
       email                : "md5"
     generatedFields:
       date:
         type               : "date"
         options:
           format           : "iso8601"
   ```
 4. You can turn on or off moderation, if on then you have to accept the pull request, close the issue and then your comment will be posted, if off then comment will be posted directly.

 Tip : Enable comments in every post you want it enabled on by adding `comment: true` or add the default value in `_config.yml`
 Tip: Remember to give correct path for your comments storage.

## Steps to add facebook comments to jekyll-
1. Change comments provider to `facebook` and you are done.

After using facebook comment system, I replaced my provider from staticman to facebook. Facebook comment system is far better than staticman for now. It is clean, fast and easy. Built in moderation system.

## Adding App Id (optional)
Create your app in facebook developer console. You will get app id for your account add that app id to `config.yml`

## Giving sorting order for facebook comments
  1. Add a new key value pair in `comments > facebook` by key as `order_by` and value as `reverse_time` or `time` (default is `social`). [Read here more on fb sorting](https://developers.facebook.com/docs/plugins/comments#sorting)

  ```yaml
  comments:
    facebook:
      appid :
      num_posts : 10
      colorscheme: "light"
      order_by : "reverse_time"
   ```

   2. Now get this field and add to your `comments.html` file inside _includes, add the following liquid

```html
    <section class="fb-comments" data-href="{{ page.url | absolute_url }}" data-mobile="true" data-num-posts="{{ site.comments.facebook.num_posts | default: 5 }}" data-width="100%" data-colorscheme="{{ site.comments.facebook.colorscheme | default: 'light' }}" data-order-by="{{ site.comments.facebook.order_by | default: 'social' }}"></section>
```

## Adding disqus to your jekyll website
Disqus is a great commenting system as it provides you with a dashboard for all the comments posted and many other analytics beside that.

Adding disqus as your commenting system is fairly straightforward, sign up for disqus, register your website, get your shortname in admin panel > site settings.

Change provider in `_config.yml` to disqus and paste the shortname for your website. And you are done!


### Reference -
 * [Minimal Mistakes](https://mmistakes.github.io/minimal-mistakes/docs/configuration/)
