# Use this configuration when working with LESS.
#
# Setup:
# Add app.less to assets/css.

module.exports = (grunt) ->
  grunt.initConfig
    # Import the package.json file for name ref.
    pkg: grunt.file.readJSON('package.json')

    # Create a name for files from the package name.
    fileName: '<%= grunt.config.get("pkg").name.toLowerCase().replace(/ /g, "-") %>'

    # Import all vendor and app specific javascripts.
    jsFiles: ['assets/js/*js']

    # This file will contain includes, so this is the only file needed.
    cssFiles: ['assets/css/app.less']

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
    less:
      compressed:
        options:
          compress: true,
        files: {
          '<%= distDir %><%= fileName %>.all.min.css': '<%= cssFiles %>'
        }
      uncompressed:
        options:
          compress: false
        files:
          '<%= distDir %><%= fileName %>.all.css': '<%= cssFiles %>'
    watch:
      js:
        files: '<%= jsFiles %>'
        tasks: ['concat:js', 'uglify']
      less:
        files: '<%= cssFiles %>'
        tasks: ['less']

  grunt.loadNpmTasks('grunt-contrib-concat')
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.registerTask('default', ['concat', 'uglify', 'less'])
    

