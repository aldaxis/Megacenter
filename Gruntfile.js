/**
 * 
 * Define as tarefas que serão executadas pelo grunt
 * 
 */

module.exports = function(grunt) {
	'use strict';
 
	//Configuração do projeto
	var gruntConfig = {
		pkg: grunt.file.readJSON('package.json'),
        
        concat: {
            options: {
                separator: ';'
            },
            libraries: {
                src: [
                    'public/assets/_js/libraries/jquery-1.11.1.min.js', 
                    'public/assets/_js/libraries/bootstrap.min.js',
                    'public/assets/_js/libraries/jquery-ui.min.js'
                ],
                dest: 'public/assets/_js/libraries.js'
            },
            plugins: {
                src: [
                    'public/assets/_js/plugins/jquery.carouFredSel-6.2.1-packed.js', 
                    'public/assets/_js/plugins/jquery.mask.min.js'
                ],
                dest: 'public/assets/_js/plugins.js'
            },
            libraries_admin: {
                src: [
                    'public/assets/admin/_js/libraries/jquery-1.11.1.min.js', 
                    'public/assets/admin/_js/libraries/bootstrap.min.js',
                    'public/assets/admin/_js/libraries/jquery-ui.min.js'
                ],
                dest: 'public/assets/admin/_js/libraries.js'
            },
            plugins_admin: {
                src: [
                    'public/assets/admin/_js/plugins/jquery.carouFredSel-6.2.1-packed.js', 
                    'public/assets/admin/_js/plugins/jquery.mask.min.js'
                ],
                dest: 'public/assets/admin/_js/plugins.js'
            }
        }, //concat
        
        uglify : {
            website : {
                options : {
                    mangle : false,
                    banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
                            '<%= grunt.template.today("dd-mm-yyyy") %> */'
                },
                files : {
                  /*'public/assets/js/scripts.min.js' : [ 'public/assets/_js/scripts.js' ],
                  'public/assets/js/libraries.min.js' : [ 'public/assets/_js/libraries.js' ],
                  'public/assets/js/plugins.min.js' : [ 'public/assets/_js/plugins.js' ],*/
                  'public/assets/js/compiled.js' : [
                      'public/assets/_js/libraries.js',
                      'public/assets/_js/plugins.js',
                      'public/assets/_js/scripts.js'
                  ]
                }
            },
            admin : {
                options : {
                    mangle : false
                },
                files : {
                  'public/assets/admin/js/compiled.js' : [
                      'public/assets/admin/_js/libraries.js',
                      'public/assets/admin/_js/plugins.js',
                      'public/assets/admin/_js/scripts.js'
                  ]
                }
            }    
        }, // uglify
        
        less: {
            website: {
                options: {
                    paths: ["public/assets/css"],
                    compress: true,
                    cleancss: true
                },
                files: {
                    "public/assets/css/layout.min.css": "public/assets/_less/layout.less"
                }
            },
            admin: {
                options: {
                    paths: ["public/assets/admin/css"],
                    compress: true,
                    cleancss: true
                },
                files: {
                    "public/assets/admin/css/layout.min.css": "public/assets/admin/_less/layout.less"
                }
            }
        }, // less
        
        watch : {
            scripts : {
                files : [
                  'public/assets/_js/**/*'
                ],
                tasks : [ 'uglify:website' ],
                options: {
                    spawn: false,
                    event: ['changed']
                }
            },
            scripts_admin: {
               files : [
                  'public/assets/admin/_js/**/*'
                ],
                tasks : [ 'uglify:admin' ],
                options: {
                    spawn: false,
                    event: ['changed']
                } 
            },
            less : {
                files : [
                  'public/assets/_less/**/*'
                ],
                tasks : [ 'less:website' ],
                options: {
                    spawn: false,
                    event: ['changed']
                }
            },
            less_admin : {
                files : [
                  'public/assets/admin/_less/**/*'
                ],
                tasks : [ 'less:admin' ],
                options: {
                    spawn: false,
                    event: ['changed']
                }
            }
        } // watch

    };
 
	grunt.initConfig(gruntConfig);
 
	//Carrega os plugins do grunt
    grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
 
	//Tarefas
	grunt.registerTask('default', ['concat', 'uglify', 'less']);
    
    //Tarefa para Watch
    grunt.registerTask('w', ['watch']);
    
};