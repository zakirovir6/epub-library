<?php

require __DIR__ . '/vendor/autoload.php';

(new \Dotenv\Dotenv(__DIR__))->load();

$generator = new \Epub\Generator();

foreach ($generator->getEpubsInArchive() as $epubFilename) {
    //
}
