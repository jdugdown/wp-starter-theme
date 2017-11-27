/**
 * Gulpfile.
 *
 * Configuration for our Gulp tasks, which watch files for changes, compile
 * Sass into minified CSS, minify JS, and reload the browser after injecting
 * changes.
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

/**
 * Configuration.
 *
 * Variables and setup for gulp tasks.
 */

// Project variables and paths.
var localURL        = 'wp-starter-theme.dev'; // Local site URL.
var devIP           = '10.0.0.180'; // Local development IP.

// CSS.
var styleSrc        = './assets/scss/main.scss'; // The main Sass file.
var styleDest       = './assets/css/'; // Where to place the compiled styles go.

// JS.
var jsSrc           = './assets/js/main.js'; // The main JS file.
var jsDest          = './assets/js/'; // Where to place the compiled JS file.

// Images.
var imgSrc          = './assets/img/raw/**/*.{png,jpg,gif,svg}'; // Images which should be optimized.
var imgDest         = './assets/img/'; // Where to place the optimized images.

// Files to watch for changes.
var styleWatchFiles = './assets/scss/**/*.scss'; // Path to all *.scss files.
var jsWatchFiles    = './assets/js/*.js'; // Path to custom JS files.
var phpWatchFiles   = './**/*.php'; // Path to PHP files.

// FTP info stored in separate, local file.
var gulpftp         = require('./gulpconfig.js');

// Browsers to support when prefixing CSS.
const AUTOPREFIXER_BROWSERS = [
    'last 2 versions',
];

/**
 * Plugins.
 *
 * Load gulp plugins and assign them semantic names.
 */
var gulp        = require('gulp'); // Probably need this one.

// CSS plugins.
var sass        = require('gulp-sass'); // Sass compilation.
var prefix      = require('gulp-autoprefixer'); // Automatically prefix styles.
var cleancss    = require('gulp-clean-css'); // Cleans up and minifies CSS.

// JS plugins.
var uglify      = require('gulp-uglify'); // Minifies JS files.

// Image plugins.
var imagemin    = require('gulp-imagemin'); // Optimizes images.

// Utility plugins.
var rename      = require('gulp-rename'); // Renames files.
var plumber     = require('gulp-plumber'); // Prevents pipe breaking caused by errors.
var filter      = require('gulp-filter'); // Filters stream using a glob of files.
var gutil       = require('gulp-util'); // Utility functions.
var notify      = require('gulp-notify'); // Desktop notifications.
var sourcemaps  = require('gulp-sourcemaps'); // Write sourcemaps for our compiled and minified code.
var browserSync = require('browser-sync'); // Injects changes and refreshes the browser.
var reload      = browserSync.reload; // For manual browser reload.
var ftp         = require('vinyl-ftp'); // Deploys files to remote server via FTP.

/**
 * Browser Sync task.
 *
 * Live Reloads, CSS injections, Localhost tunneling.
 *
 * @link https://browsersync.io/docs/options/
 */
gulp.task( 'browser-sync', () => {
	browserSync.init( {
		proxy: localURL, // The local project URL.
		open: true, // Automatically open the project in the browser.
		injectChanges: true, // Inject CSS changes.
        host: devIP, // Local development IP.
	});
});

/**
 * Styles task.
 *
 * Compiles Sass, adds vendor prefixes, and minifies.
 */
gulp.task('styles', () => {
    const cssFilter = filter( ['**/*.css'], { restore: true } );

    gulp.src( styleSrc )
        .pipe( plumber( (error) => {
			gutil.log(gutil.colors.red(error.message));
			notify.onError({
    		    title: "Compile Error",
                message: "Sass encountered an error.",
                sound: false,
            }).apply(this, arguments);
			this.emit('end');
        }))
        .pipe( sourcemaps.init() )
        .pipe( sass( {
            errLogToConsole: true,
            outputStyle: 'expanded'
        }))
        .pipe( prefix( AUTOPREFIXER_BROWSERS ) )
        .pipe( gulp.dest( styleDest ) )
        .pipe( cssFilter )
        .pipe( browserSync.stream() )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( cleancss() )
        .pipe( sourcemaps.write( './' ) )
        .pipe( gulp.dest( styleDest ) )
        .pipe( cssFilter )
        .pipe( browserSync.stream() );
});

/**
 * Scripts task.
 *
 * Minifies JavaScript and adds a .min suffix to the filename.
 */
gulp.task('scripts', () => {
    gulp.src( jsSrc )
        .pipe( uglify() )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( gulp.dest( jsDest ) );
});

/**
 * Images task.
 *
 * Optimizes and minifies SVG, PNG, JPEG, and GIF. Runs manually.
 */
gulp.task( 'images', () => {
	gulp.src( imgSrc )
	.pipe( imagemin( {
		progressive: true,
		optimizationLevel: 4, // 0-7
		interlaced: true,
		svgoPlugins: [{removeViewBox: false}]
	}))
	.pipe( gulp.dest( imgDest ) )
	.pipe( notify( {
		message: 'Image optimization complete.',
		onLast: true
	}));
});

/**
 * Deploy Task.
 *
 * Uploads changed files to a remote server. Runs manually.
 */
gulp.task( 'deploy', () => {
	var conn = ftp.create({
		host:     gulpftp.config.host,
		user:     gulpftp.config.user,
		password: gulpftp.config.pass,
		parallel: 20,
		log:      gutil.log,
	});

	var globs = [
		'**/*',
		'*',
		'!node_modules',
		'!node_modules/**',
		'!src/img/raw',
		'!src/img/raw/**',
		'!gulpconfig.js',
		'!.git',
		'!.git/**',
		'!.gitignore',
		'!.sass-cache',
		'!.sass-cache/**',
		'!.ftpconfig',
		'!sftp-config.json',
		'!ftpsync.settings',
	];

	gulp.src(globs, { base: '.', buffer: false })
		.pipe(conn.newer( gulpftp.config.path )) // Only upload newer files.
		.pipe(conn.dest( gulpftp.config.path ));
});

/**
 * Default task.
 *
 * Watches for file changes and runs tasks in a specific order.
 */
gulp.task( 'default', ['styles', 'scripts', 'browser-sync'], () => {
    gulp.watch( phpWatchFiles, reload );
    gulp.watch( styleWatchFiles, [ 'styles' ] );
    gulp.watch( jsWatchFiles, [ 'scripts', reload ] );
});
