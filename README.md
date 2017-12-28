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

You are expected to set the next environment variables:

```
EPUB_ARCHIVE_FILENAME - this is full archive name with path. This may be empty, in this case the archive from resource/E.zip will be used
EPUB_ARCHIVE_PASSWORD - this is archive password
EPUB_ARCHIVE_EXTRACTION_FOLDER - temporary folder where archive will be being extracted
```

example
```php
//this is load environment from your dotenv
(new \Dotenv\Dotenv(__DIR__))->load();

$generator = new \Epub\Generator();

foreach ($generator->getEpubsInArchive() as $epubFilename) {
    //
}
```