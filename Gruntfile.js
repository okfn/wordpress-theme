module.exports = function(grunt) {

  const sass = require('node-sass');

  grunt.initConfig({
    copy: {
      js: {
        files: [{
          expand: true,
          cwd: 'node_modules',
          src: ['bootstrap/dist/js/bootstrap.min.js', 'jquery/dist/jquery.min.js'],
          dest: 'assets/js',
          flatten: true
        }]
      }
    },

    uglify: {
      options: {
        mangle: false
      },
      recaptcha: {
        files: {
          'assets/js/okfn-recaptcha-validator.min.js': ['src/js/okfn-recaptcha-validator.js']
        }
      }
    },

    sass: {
      options: {
        implementation: sass,
        sourceMap: true
      },
      dist: {
        files: {
          'style.css': 'src/scss/style.scss'
        }
      }
    },

    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer'),
          require('cssnano')
        ]
      },
      dist: {
        src: 'style.css'
      }
    },

    watch: {
      js: {
        files: ['src/js/**/*.js'],
        tasks: ['uglify']
      },
      scss: {
        files: ['src/scss/**/*.scss'],
        tasks: ['sass', 'postcss:dist']
      }
    }
  });
  grunt.registerTask('build', ['copy', 'uglify']);
  grunt.registerTask('dev', ['build', 'watch']);
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-postcss');
  return grunt.loadNpmTasks('grunt-contrib-watch');
};
