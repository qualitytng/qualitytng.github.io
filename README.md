# holianh.gihub.io
My Personal Website

[Blog Post on how I built this website](https://holianh.github.io/technology/how-i-created-this-website/)

### How to build and run

1. follow [this instruction](https://help.github.com/articles/setting-up-your-github-pages-site-locally-with-jekyll/)

```bash
cd
cd www/holianh.github.io

Make new `Gemfile` with this content:
source 'https://rubygems.org'
gem 'github-pages', group: :jekyll_plugins


sudo gem install bundler
bundle update
sudo apt-get install ruby`ruby -e 'puts RUBY_VERSION[/\d+\.\d+/]'`-dev
bundle install
bundle exec jekyll serve
```

Go to http://localhost:4000/


Ref:
- [Install Ruby](https://stackoverflow.com/questions/20559255/error-while-installing-json-gem-mkmf-rb-cant-find-header-files-for-ruby)
