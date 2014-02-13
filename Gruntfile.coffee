module.exports = (grunt) ->
  grunt.initConfig
    
    # Import the package.json file for name ref.
    pkg: grunt.file.readJSON('package.json')

    # Configure properties to match your project's structure.
    cssFiles: ['assets/css/*.css']
    jsFiles: ['assets/js/*.js']
    distDir: 'assets/dist/'

    # Tasks. Feel free to customize.
    concat:
      options:
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
        stripBanners: true
      js:
        src: '<%= jsFiles %>'
        dest: '<%= distDir %><%= pkg.name %>.all.js'
      css:
        src: '<%= cssFiles %>'
        dest: '<%= distDir %><%= pkg.name %>.all.css'
    uglify:
      options:
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      build:
        src: '<%= distDir %><%= pkg.name %>.all.js'
        dest: '<%= distDir %><%= pkg.name %>.all.min.js'
    cssmin:
      build:
        src: '<%= distDir %><%= pkg.name %>.all.css'
        dest: '<%= distDir %><%= pkg.name %>.all.min.css'
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
