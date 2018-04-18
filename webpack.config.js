const Encore = require('@symfony/webpack-encore');
const EmitFile = require('./tools/webpack-plugins/EmitFile');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .addEntry('js/app', [
        './assets/js/app.js',
        './assets/js/react.jsx'
    ])
    .addEntry('js/validation',
        './assets/js/validation.js'
    )
    .addEntry('js/validateStudent',
        './assets/js/validateStudent.js'
    )

    .addStyleEntry('css/app', './assets/css/app.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()
    .enableReactPreset()

    // Custom WebPack plugin
    .addPlugin(
        new EmitFile(
            'version.json',
            {'date': (new Date()).toISOString()}
        )
    )

    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
