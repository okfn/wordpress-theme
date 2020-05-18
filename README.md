OKFN WordPress Theme
=================

OKFNWP is a WordPress theme built on Bootstrap.

Getting Started
---------------
**You'll need the following installed before continuing:**
  * [Node.js](http://nodejs.org): Use the installer provided on the NodeJS website.
  * [Grunt](http://gruntjs.com/): Run `[sudo] npm install -g grunt-cli`

To get started run:

`npm install && grunt watch`


Templates
---------

**Homepage**

The homepage template is a regular full-width content page. Use the `[latestposts]` shortcode to display the latest blog posts.


Shortcodes
----------

**Latest Blog Posts**

To add a 3-column row of the latest blog posts, use:

  `[latestposts]`

To change the section heading from the default 'Latest posts from the blog', pass in a title="" parameter:

`[latestposts title="Recent Posts"]`
