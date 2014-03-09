module.exports = (grunt) ->
  grunt.initConfig
    # Import the package.json file for name ref.
    pkg: grunt.file.readJSON('package.json')

    # Create a name for files from the package name.
    fileName: '<%= grunt.config.get("pkg").name.toLowerCase().replace(/ /g, "-") %>'

    # Configure properties to match your project's structure.
    jsFiles: ['assets/js/*.coffee']
    cssFiles: ['assets/css/*.styl']
    distDir: 'assets/dist/'

    # Tasks. Feel free to customize.
    coffee:
      compressed:
        options:
          sourceMap: true
        files:
          '<%= distDir %><%= fileName %>.all.min.js': '<%= jsFiles %>'
      uncompressed: 
        options:
          sourceMap: true
        files:
          '<%= distDir %><%= fileName %>.all.js': '<%= jsFiles %>'
    stylus:
      compressed:
        options:
          banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
          paths: ['assets/css/']
          "include css": true
        files:
          '<%= distDir %><%= fileName %>.all.min.css': ['assets/css/*.styl']
      uncompressed:
        options:
          compress: false
          banner: '/*! <%= fileName %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
          paths: ['assets/css/']
          "include css": true
        files:
          '<%= distDir %><%= fileName %>.all.css': ['assets/css/*.styl']
    watch:
      coffee:
        files: '<%= jsFiles %>'
        tasks: ['coffee']
      css:
        files: '<%= cssFiles %>'
        tasks: ['stylus']

  grunt.loadNpmTasks('grunt-contrib-coffee')
  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-stylus');
  grunt.registerTask('default', ['concat', 'uglify', 'stylus'])
