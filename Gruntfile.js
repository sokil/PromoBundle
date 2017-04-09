module.exports = function (grunt) {
  'use strict';

  var env = grunt.option('env') || 'prod';
  grunt.config('env', env);
  console.log('Environment: ' + env);

  grunt.initConfig({
    less: {
      components: {
        files: {
          "Resources/public/css/components.css": [
            "Resources/assets/components/animation/styles.less",
            "Resources/assets/components/slides/styles.less",
            "Resources/assets/components/toolbar/styles.less"
          ]
        }
      }
    },
    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer')({
            browsers: [
              'ios_saf >= 7',
              'Chrome >= 45',
              'Explorer >= 9',
              'Firefox >= 41',
              'Android >= 4',
              'iOS >= 7'
            ]})
        ]
      },
      all: {
        src: 'Resources/public/css/*.css'
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-postcss');

  grunt.registerTask('build', [
    'less',
    'postcss'
  ]);

  grunt.registerTask('default', [
    'build'
  ]);
};