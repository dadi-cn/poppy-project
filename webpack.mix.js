/*
 * Copyright (C) 2013-2017 Shandong Liexiang Tec, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

var mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix
	.browserSync({
		proxy : 'http://{dev.project.domain}/',
		files : [
			"public/resources/js/**/*.js",
			"public/resources/css/*.css",
			"modules/**/src/request/**/*.php",
			"modules/**/resources/views/**/*.blade.php",
			"modules/**/resources/mixes/**/*.js",
			"modules/**/resources/js/**/*.js"
		]
	})
	.disableNotifications()
	.version()
/*
|--------------------------------------------------------------------------
| develop & backend
|--------------------------------------------------------------------------
*/
/* system js
 * ---------------------------------------- */
	.combine([
			'modules/system/resources/libs/jquery/2.2.4/jquery.min.js',
			'modules/system/resources/libs/jquery/form/jquery.form.js',
			'modules/system/resources/libs/jquery/toastr/jquery.toastr.js',
			'modules/system/resources/libs/jquery/pjax/jquery.pjax.js',
			'modules/system/resources/libs/jquery/poshytip/jquery.poshytip.js',
			'modules/system/resources/libs/jquery/validation/jquery.validation.js',
			'modules/system/resources/libs/jquery/data-tables/jquery.data-tables.js',
			'modules/system/resources/libs/jquery/tokenize2/jquery.tokenize2.js',
			'modules/system/resources/libs/jquery/spinner/jquery.spinner.js',
			'modules/system/resources/libs/waves/waves.min.js',
			'modules/system/resources/libs/vue/vue.min.js',
			'modules/system/resources/libs/underscore/underscore.js',
			'modules/system/resources/libs/jshash/md5.min.js',
			'modules/system/resources/libs/jshash/sha1.min.js',
			'modules/system/resources/libs/clipboard/clipboard.min.js',
			'modules/system/resources/libs/wang-editor/wangEditor.js',
			'modules/system/resources/libs/simditor/module.js',
			'modules/system/resources/libs/simditor/hotkeys.js',
			'modules/system/resources/libs/simditor/uploader.js',
			'modules/system/resources/libs/simditor/simditor.js',
			'modules/system/resources/libs/bt3/js/tooltip.js',
			'modules/system/resources/libs/jquery/fancybox/jquery.fancybox.min.js',
		],
		'public/assets/js/system_vendor.js'
	)
	.combine([
			'modules/system/resources/libs/poppy/util.js',
			'modules/system/resources/libs/poppy/cp.js',
			'modules/system/resources/libs/poppy/system/cp.js'
		],
		'public/assets/js/system_cp.js'
	)
	/* system css
	 * ---------------------------------------- */
	.sass(
		'modules/system/resources/scss/system.scss',
		'public/assets/css/system.css'
	)
	.copyDirectory('modules/system/resources/libs/layui', 'public/assets/layui')
	.copyDirectory('modules/system/resources/images/libs', 'public/assets/images/libs')
	.copyDirectory('modules/system/resources/fonts/roboto', 'public/assets/font/roboto')
	.copyDirectory('modules/system/resources/fonts/fontawesome', 'public/assets/font/fontawesome');
