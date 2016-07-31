module.exports = function (grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

/*Sass task*/

    sass: {
      dev: {
        options: {
            style: 'expanded',
            sourcemap: 'none',
        },
        files: {
            'style.css': 'sass/style.scss'
        }
      }
    },

/*
Watch task
*/

    watch: {
        css: {
          files: '**/*.scss',
          tasks: ['sass'],
          options: {
          livereload: true,
        }
    }



  });

grunt.loadNpmTasks('grunt-contrib-sass');
grunt.loadNpmTasks('grunt-contrib-watch');


grunt.registerTask('default', ['watch']);
}
