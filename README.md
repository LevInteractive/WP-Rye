#### Rye.

The objective of Rye is to save you time and effort when creating a WordPress site and dosen't make any assumptions about the technology you want to use. The themes that come with WordPress are a great reference, but not a great starter theme. Rye makes it easy to stub out your entire site using the configuration array inside the functions.php file. Enjoy.

#### Getting started.

*Please make sure you have [npm](https://www.npmjs.org/) and [grunt](http://gruntjs.com/) installed globally.*

1. cd to the theme's root directory.
2. `npm install` and the grunt plugins will be installed.
3. Edit the package.json file. Make it your own. The project name will be used to set the name for the compiled asset files. The json file will also be accessable throughout your project by calling `Rye::package()`, which will return a php object.
4. Add asset files in the assets directory. Add as many as you'd like since they will be concatenated and minified anyways.
5. Change the name of one of the Gruntfile examples to `Gruntfile.coffee`.

_Running `grunt` at any time will build your assets. For convience, run `grunt watch` and your files will be compiled automatically as you edit them._

#### TODO's

* Add more Gruntfile flavors.
