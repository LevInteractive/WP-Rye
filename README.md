# Rye.

The objective of Rye is to save you time and effort when creating a WordPress site and dosen't make any assumptions about the technology you want to use. The themes that come with WordPress are a great reference, but not a great starter theme. Rye makes it easy to stub out your entire site using the configuration array inside the functions.php file. Enjoy.

### Getting started.

*Please make sure you have [npm](https://www.npmjs.org/) and [grunt](http://gruntjs.com/) installed globally.*

1. cd to the theme's root directory.
2. `npm install` and the grunt plugins will be installed.
3. Edit the package.json file. The project name will be used to set the name for the compiled asset files.
4. Change the name of one of the Gruntfile examples to `Gruntfile.coffee`.

_Running `grunt` at any time will build your assets. For convience, run `grunt watch` and your files will be compiled automatically as you edit them._

### Globals

`Rye::package()`: The package.json file as a php object.  
`Rye::project_name()`: Returns sanitized name specified in the package.json file.  
`Rye::$enviornment`: A static property which tells Rye which enviornment to run in. This is in the functions.php file for you. It can be assigned to 1 of 4 constants; `Rye::TESTING`, `Rye::DEVELOPMENT`, `Rye::STAGING`, or `Rye::PRODUCTION`.  
`Rye::stylesheet()`: Outputs style tags using the appropriate css file based on the enviornment property.  
`Rye::init()`: This is the bootstrap method for Rye and is already in the functions.php file. It should only be called once.


### Project Structure

`functions.php`: The main rye configuration array lives here. Before doing any front-end work, layout the entire site here.  
`assets/`: Project assets are added here. Once, grunted js and css files will be concatenated and minified into the *dist* directory.  
`rye.php`: This is the Rye core. No need to ever touch this.  


##### Gruntfile.basic

This configuration is for when you are just working with basic css & js files with no pre-processor(s) necessary.

1. No setup needed.

##### Gruntfile.stylus

This configuration is for when you're using stylus for your pre-processor.

1. Create a *app.styl* file in assets/css. All other stylus files can be included here.

##### Gruntfile.less

This configuration is for when you're using less for your pre-processor.

1. Create a *app.less* file in assets/css. All other stylus files can be included here.


# @TODO's

* Add more Gruntfile flavors.
