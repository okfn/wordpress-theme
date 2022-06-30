# OKFN WordPress Theme

OKFNWP is a WordPress theme built on Bootstrap.

## Getting Started

**You'll need the following installed before continuing:**

- [Node.js](http://nodejs.org): Use the installer provided on the NodeJS website.
- [Grunt](http://gruntjs.com/): Run `[sudo] npm install -g grunt-cli`

To get started run:

`npm install && grunt watch`

## Templates

### **Homepage**

The homepage template is a regular full-width content page. Use the `[latestposts]` shortcode to display the latest blog posts.

## Shortcodes

### **Latest Blog Posts**

To add a 3-column row of the latest blog posts, use:

`[latestposts]`

To change the section heading from the default 'Latest posts from the blog', pass in a title="" parameter:

`[latestposts title="Recent Posts"]`

## Coding Standards

Uses [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/) as the basis, along with [WordPress Coding Standards](https://github.com/WordPress/WordPress-Coding-Standards). [PHPCSUtils](https://github.com/PHPCSStandards/PHPCSUtils) and [PHPCSExtra](https://github.com/PHPCSStandards/PHPCSExtra) are also required.

### Setup

Make sure you are running PHP CodeSniffer 3.7 or above. Clone it from GitHub and add its binaries to the relevant system folders, so you can use `phpcs` or `phpcbf`, without the need to specify the exact path to the binary.

1. Clone https://github.com/squizlabs/PHP_CodeSniffer/ to your home folder.
2. Set symlinks to the binaries of `phpcs` and `phpcbf` container in `~/PHP_CodeSniffer/bin/` with the following commands in any Linux distribution.

```sh
sudo ln -s ~/PHP_CodeSniffer/bin/phpcs /usr/bin
sudo ln -s ~/PHP_CodeSniffer/bin/phpcbf /usr/bin
```

Once symlinks are created, try to execute `phpcs` in the terminal. You should get the following output and it means that you're all set to use PHP CodeSniffer.

```sh
ERROR: You must supply at least one file or directory to process.

Run "phpcs --help" for usage information
```

3. Next, clone https://github.com/WordPress/WordPress-Coding-Standards to your home folder in a subfolder called `wpcs` for your convenience.

4. Clone https://github.com/PHPCSStandards/PHPCSUtils to your home folder

5. Clone https://github.com/PHPCSStandards/PHPCSExtra to your home folder

6. The only thing left to do is to make sure `phpcs` uses these extra sniffs and knows where to find them. We do that by updating it configuration.

```sh
phpcs --config-set installed_paths ~/wpcs,~/PHPCSUtils/PHPCSUtils,~/PHPCSExtra
```

If the configuration is properly updated, you should get the following output when executing `phpcs -i`.

```sh
The installed coding standards are MySource, PEAR, PSR1, PSR2, PSR12, Squiz, Zend, WordPress, WordPress-Core, WordPress-Docs, WordPress-Extra, PHPCSUtils, NormalizedArrays and Universal
```

If something is not right and you can't get it to work, use `phpcs --config-show` to see what you have PHP CodeSniffer configured with.

### Testing

Just run `./run_tests.sh` and follow the output. Test will find all kinds of errors and the simple ones will be corrected automatically. For the other ones you'll need to rerun the tests to confirm they have been resolved.
