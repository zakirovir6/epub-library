<?php

require __DIR__ . '/vendor/autoload.php';

$generator = new \Epub\Generator(__DIR__ . '/resource/E.zip');

foreach ($generator->getEpubsInArchive() as $epubFilename) {
    //
}
