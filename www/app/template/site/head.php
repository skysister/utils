<head data-template="<?=$template?>">
    <meta charset="utf-8">
    <title><?=site()->pageTitle()?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <?=site()->bustCSS("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css")?>
    <?=site()->bustCSS("/app/rsrc/font/opensans/v1.10/fontface.css")?>
    <?=site()->bustCSS("/app/css/color.css")?>
    <?=site()->bustCSS("/app/css/dark.css")?>
    <?=site()->bustCSS("/app/css/style.css")?>
    <?=site()->addedCSS()?>

    <?=site()->bustJS("https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js")?>
    <?=site()->bustJS("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js")?>
    <?=site()->bustJS("https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js")?>
    <?=site()->bustJS("https://cdn.jsdelivr.net/npm/mustache@4.2.0/mustache.min.js")?>
    <?=site()->bustJS("/app/js/onclick.js")?>
    <?=site()->bustJS("/app/js/ssStorage.js")?>
    <?=site()->bustJS("/app/js/site.js")?>
    <?=site()->addedJS()?> 
</head>
