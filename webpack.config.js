var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('src/Resources/public/')
    .addEntry('contao-status-message-bundle', './src/Resources/assets/js/contao-status-message-bundle-be.js')
    .setPublicPath('/bundles/heimrichhannotstatusmessage/')
    .setManifestKeyPrefix('bundles/heimrichhannotstatusmessage')
    .enableSassLoader()
    .disableSingleRuntimeChunk()
    .addExternals({
        '@hundh/contao-utils-bundle': 'utilsBundle'
    })
    .enableSourceMaps(!Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
