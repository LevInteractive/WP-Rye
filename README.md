# Rye.

The objective of Rye is to save you time and effort when creating a WordPress site and dosen't make any assumptions about the technology you want to use. The themes that come with WordPress are a great reference, but not a great starter theme. Rye makes it easy to stub out your entire site using the configuration array inside the functions.php file. Enjoy.

### Getting started.

*Please make sure you have [npm](https://www.npmjs.org/) and [grunt](http://gruntjs.com/) installed globally.*

1. cd to the theme's root directory.
2. `npm install` and the grunt plugins will be installed.
3. Edit the package.json file. The project name will be used to set the name for the compiled asset files.
4. Change the name of one of the Gruntfile examples to `Gruntfile.coffee`.

_Running `grunt` at any time will build your assets. For convience, run `grunt watch` and your files will be compiled automatically as you edit them._

### Rye globals.

* [Rye::package()](rye.php#L24) The package.json file as a php object.
* [Rye::project_name()](rye.php#L32) Returns sanitized name specified in the package.json file.
* [Rye::$enviornment](rye.php#L13) A static property which tells Rye which enviornment to run in. This is in the functions.php file for you. It can be assigned to 1 of 4 constants; `Rye::TESTING`, `Rye::DEVELOPMENT`, `Rye::STAGING`, or `Rye::PRODUCTION`.
* [Rye::stylesheet()](rye.php#L41) Outputs style tags using the appropriate css file based on the enviornment property.
* [Rye::init()](rye.php#L143) This is the bootstrap method for Rye and is already in the functions.php file. It should only be called once.

### Project architecture.


* [rye.php](rye.php) This is the Rye core. No need to ever touch this.
* [functions.php](functions.php) The main rye configuration array lives here. Before doing any front-end work, layout the entire site here.
* [style.css](style.css) This shouldn't be used. It's only required to specify information about the theme for WordPress.
* [assets/css](assets/css) Any css or pre-processor css file such as .styl or .less files should be included here. The main entry file should be called *app.(type)*.
* [assets/js](assets/js) App specific JavaScripts should be added here. After Grunting thing will compiled into `assets/dist`.
* [assets/js/vendor](assets/js/vendor) These files don't get compiled after grunting. They should be specified in the functions.php file (in the Rye config array) so WordPress is aware of them. This will eliminate any chance of duplicate libraries being added after installing plugins.

### Gruntfiles.

You should rename one of these to Gruntfile.coffee or roll out your own.

* [Gruntfile.basic.coffee](Gruntfile.basic.coffee) This configuration is for when you are just working with basic css & js files with no pre-processor(s) necessary. No setup needed.
* [Gruntfile.stylus.coffee](Gruntfile.stylus.coffee) This configuration is for when you're using stylus for your pre-processor. Create a *app.styl* file in assets/css. All other stylus files can be included here.
* [Gruntfile.less.coffee](Gruntfile.less.coffee) This configuration is for when you're using less for your pre-processor. Create a *app.less* file in assets/css. All other stylus files can be included here.

### Plugin recommendations.

* [Advanced Custom Fields](http://www.advancedcustomfields.com/) Great for making the CMS user-friendly for data driven websites.
* [W3 Total Cache](https://wordpress.org/plugins/w3-total-cache/) Makes using CDN's very easy, amongst other techniques.
* [Contact Form 7](http://wordpress.org/plugins/contact-form-7/) Great for creating forms using the CMS.
* [Yoast SEO Plugin](https://yoast.com/wordpress/plugins/seo/) Gives you total control over meta tagging and dynamic page titles.

# @TODO's

* Add more Gruntfile flavors.
