// webpack.config.js
// ...
if (Encore.isProduction()) {
    Encore.setPublicPath(
        'https://YOUR_ASSETS_BUCKET_NAME.s3.amazonaws.com/build'
    );
    Encore.setManifestKeyPrefix('build/');
}



