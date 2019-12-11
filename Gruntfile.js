module.exports = function(grunt) {

  const sass = require('node-sass');

  grunt.initConfig({
    copy: {
      js: {
        files: [{
          expand: true,
          cwd: 'node_modules',
          src: [
            'bootstrap/dist/js/bootstrap.min.js',
            'jquery/dist/jquery.min.js',
            'jquery.mmenu/dist/jquery.mmenu.all.js'
          ],
          dest: 'assets/js',
          flatten: true
        }]
      }
    },

    uglify: {
      options: {
        mangle: false
      },
      main: {
        files: {
          'assets/js/main.min.js': ['src/js/main.js']
        }
      },
      recaptcha: {
        files: {
          'assets/js/okfn-recaptcha-validator.min.js': ['src/js/okfn-recaptcha-validator.js']
        }
      }
    },

    shell: {
      tokens: {
        command: 'npx style-dictionary build',
          options: {
          execOptions: {
            cwd: 'design-tokens'
          }
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
      tokens: {
        files: 'design-tokens/properties/**/*.json',
        tasks: ['shell:tokens']
      },
      scss: {
        files: ['design-tokens/build/scss/*.scss', 'src/scss/**/*.scss'],
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
  grunt.loadNpmTasks('grunt-shell');
  return grunt.loadNpmTasks('grunt-contrib-watch');
};
