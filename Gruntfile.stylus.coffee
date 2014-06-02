# Use this configuration when working with stylus.
#
# Setup:
# Add app.styl to assets/css.

module.exports = (grunt) ->
  grunt.initConfig
    # Import the package.json file for name ref.
    pkg: grunt.file.readJSON('package.json')

    # Create a name for files from the package name.
    fileName: '<%= grunt.config.get("pkg").name.toLowerCase().replace(/ /g, "-") %>'

    # Import all app specific javascripts.
    jsFiles: ['assets/js/*.js']

    # This file will contain includes, so this is the only file needed.
    cssFiles: ['assets/css/app.styl']

    # Where the compiled assets will live.
    distDir: 'assets/dist/'

    # Tasks. Feel free to customize.
    concat:
      options:
        banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
        stripBanners: true
      js:
        src: '<%= jsFiles %>'
        dest: '<%= distDir %><%= fileName %>.all.js'
    uglify:
      options:
        banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      build:
        src: '<%= distDir %><%= fileName  %>.all.js'
        dest: '<%= distDir %><%= fileName %>.all.min.js'
    stylus:
      compressed:
        options:
          banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
          paths: ['assets/css/']
          "include css": true
        files:
          '<%= distDir %><%= fileName %>.all.min.css': ['<%= cssFiles %>']
      uncompressed:
        options:
          compress: false
          banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
          paths: ['assets/css/']
          "include css": true
        files:
          '<%= distDir %><%= fileName %>.all.css': ['<%= cssFiles %>']
    watch:
      js:
        files: '<%= jsFiles %>'
        tasks: ['concat:js', 'uglify']
      css:
        files: '<%= cssFiles %>'
        tasks: ['stylus']

  grunt.loadNpmTasks('grunt-contrib-concat')
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-stylus');
  grunt.registerTask('default', ['concat', 'uglify', 'stylus'])
    

