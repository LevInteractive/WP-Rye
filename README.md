# You can put lipstick on a pig, but it's still a pig.

(_pig:_ WordPress, _lipstick:_ Starter themes)

We created Rye because there are times when we need to build high performing
applications with a WordPress backend. When we do this, we don't want several
layers of abstraction existing simply to help the majority of developers. Rye
does two things:

1. Isolates the boilerplate code you need to write to [one place](lib/init.php).
2. Gives you a simple and modern/psr-4-ready file architecture to start with.

What Rye does not do:

* Try to make you buy stuff.
* Add too many layers of abstraction.
* Add dependencies (except for composer - which you can strip if you want).

### Getting started.

*Please make sure you have [npm](https://www.npmjs.org/) and [gulp](http://gulpjs.com/) installed globally.*

1. cd to the theme's root directory.
2. `npm install` and the gulp plugins will be installed.
3. Edit the package.json file. The project name will be used to set the name for the compiled asset files.
4. Configure the configuration array in [init.php](lib/init.php).
5. Add custom theme-specifc logic to [lib/Rye/Grain.php](lib/Rye/Grain.php).
6. Add any other classes and namespaces to this directory.

_Running `gulp` at any time will build your assets. For convience, run `gulp watch` and your files will be compiled automatically as you edit them._

### Rye globals.

* [Rye](lib/Rye/Rye.php) The Rye class. Not much to do here. It's the "core".
* [Grain](lib/Rye/Grain.php) A good place to add helper/utility methods. Can be later accessed like `Rye::$grain->myMethod()`.
* [Rye::$grain](lib/grain.php) The Grain singleton reference. This gets instantiated in Rye's init.
* [Rye::package()](rye.php#L24) The package.json file as a php object.
* [Rye::projectName()](rye.php#L32) Returns sanitized name specified in the package.json file.
* [Rye::$enviornment](rye.php#L13) A static property which tells Rye which enviornment to run in. This is in the functions.php file for you. It can be assigned to 1 of 4 constants; `Rye::TESTING`, `Rye::DEVELOPMENT`, `Rye::STAGING`, or `Rye::PRODUCTION`.
* [Rye::stylesheet()](rye.php#L41) Outputs style tags using the appropriate css file based on the enviornment property.

### Project architecture.

* [lib/](lib/) Put any other custom classes you may need and configure the init.php file.
* [style.css](style.css) This shouldn't be used. It's only required to specify information about the theme for WordPress.
* [assets/css](assets/css) Any css or pre-processor css file such as .styl or .less files should be included here. The main entry file should be called *app.(type)*.
* [assets/js](assets/js) App specific JavaScripts should be added here. After Grunting thing will compiled into `assets/dist`.
* [assets/js/vendor](assets/js/vendor) These files don't get compiled/minified after gulping. They should be specified in the functions.php file (in the Rye config array) so WordPress is aware of them. This will eliminate any chance of duplicate libraries being added after installing plugins.

### Plugin recommendations for doing things.

* [WP Mail SMTP](https://wordpress.org/plugins/wp-mail-smtp/) Allows you to specify a SMTP server to use for WP's mail function.
* [Advanced Custom Fields](http://www.advancedcustomfields.com/) Great for making the CMS user-friendly for data driven websites.
* [Contact Form 7](http://wordpress.org/plugins/contact-form-7/) Great for creating forms using the CMS.
* [Yoast SEO Plugin](https://yoast.com/wordpress/plugins/seo/) Gives you total control over meta tagging and dynamic page titles.
* [W3 Total Cache](https://wordpress.org/plugins/w3-total-cache/) Makes using CDN's very easy, amongst other techniques.
