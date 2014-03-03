module.exports = (grunt) ->
  grunt.initConfig
    # Import the package.json file for name ref.
    pkg: grunt.file.readJSON('package.json')

    # Create a name for files from the package name.
    fileName: '<%= grunt.config.get("pkg").name.toLowerCase().replace(" ", "-") %>'

    # Configure properties to match your project's structure.
    cssFiles: ['assets/css/**.styl']
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
    stylus:
      compressed:
        compile:
          options:
            banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            paths: ['assets/css/']
            "include css": true
          build:
            src: '<%= cssFiles %>'
            dest: '<%= distDir %><%= fileName %>.all.min.css'
      uncompressed:
        compile:
          options:
            compress: false
            banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            paths: ['assets/css/']
            "include css": true
          build:
            src: '<%= cssFiles %>'
            dest: '<%= distDir %><%= fileName %>.all.css'
    uglify:
      options:
        banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      build:
        src: '<%= distDir %><%= fileName  %>.all.js'
        dest: '<%= distDir %><%= fileName %>.all.min.js'
    watch:
      js:
        files: '<%= jsFiles %>'
        tasks: ['concat:js', 'uglify']
      css:
        files: '<%= cssFiles %>'
        tasks: ['stylus']

  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-concat')
  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-stylus');
  grunt.registerTask('default', ['concat', 'uglify', 'stylus'])

