# This configuration is for when you are just working with basic css & js files with
# no pre-processor(s) necessary.

module.exports = (grunt) ->
  grunt.initConfig
    # Import the package.json file for name ref.
    pkg: grunt.file.readJSON('package.json')

    # Create a name for files from the package name.
    fileName: '<%= grunt.config.get("pkg").name.toLowerCase().replace(/ /g, "-") %>'

    # Configure properties to match your project's structure.
    cssFiles: ['assets/css/*.css']
    jsFiles: ['assets/js/*.js']
    distDir: 'assets/dist/'

    # Tasks. Feel free to customize.
    concat:
      options:
        banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
        stripBanners: true
      js:
        src: '<%= jsFiles %>'
        dest: '<%= distDir %><%= fileName %>.all.js'
      css:
        src: '<%= cssFiles %>'
        dest: '<%= distDir %><%= fileName %>.all.css'
    uglify:
      options:
        banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      build:
        src: '<%= distDir %><%= fileName %>.all.js'
        dest: '<%= distDir %><%= fileName %>.all.min.js'
    cssmin:
      build:
        src: '<%= distDir %><%= fileName %>.all.css'
        dest: '<%= distDir %><%= fileName %>.all.min.css'
    watch:
      js:
        files: '<%= jsFiles %>'
        tasks: ['concat:js', 'uglify']
      css:
        files: '<%= cssFiles %>'
        tasks: ['concat:css', 'cssmin']

  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-cssmin')
  grunt.loadNpmTasks('grunt-contrib-concat')
  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.registerTask('default', ['concat', 'uglify', 'cssmin'])
