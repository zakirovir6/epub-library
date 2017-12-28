# epub_library
This repository Contains epubs' archive for testing and tools for iterating through archive

installation via composer.json
```
"require": {
        "zakirovir6/epub_library": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/zakirovir6/epub_library.git"
        }
    ],
```

The generator is constructed with params:

```
$zipFilename - this is full archive name with path. This may be empty, in this case the archive from resource/E.zip will be used
$zipPass - this is archive password
$extractionFolder - temporary folder where archive will be being extracted
```

example
```php
require __DIR__ . '/vendor/autoload.php';

(new \Dotenv\Dotenv(__DIR__))->load();

$generator = new \Epub\Generator(__DIR__ . '/resource/E.zip');

foreach ($generator->getEpubsInArchive() as $epubFilename) {
    //
}

```