<?php

/* @var $siteMaps */

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <?php foreach ($siteMaps as $siteMap): ?>
            <sitemap>
                <loc><?= Yii::$app->request->hostInfo.'/'.$siteMap['loc'] ?></loc>
                <lastmod><?= $siteMap['lastmod'] ?></lastmod>
                <changefreq><?= $siteMap['changefreq'] ?></changefreq>
                <priority><?= $siteMap['priority'] ?></priority>
            </sitemap>
        <?php endforeach; ?>
    </url>
</urlset>
