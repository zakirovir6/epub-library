<?php

namespace Epub;

/**
 * Class Config
 * @package Epub
 *
 * @property string $filename
 * @property string $password
 * @property string $extractionFolder
 */
class Config
{
    /**
     * @param $name
     *
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        switch ($name)
        {
            case "filename":
                if (getenv('EPUB_ARCHIVE_FILENAME')) {
                    return getenv('EPUB_ARCHIVE_FILENAME');
                }

                return __DIR__ . "/../resource/E.zip";

            case "password":
                return getenv('EPUB_ARCHIVE_PASSWORD');

            case "extractionFolder":
                return getenv('EPUB_ARCHIVE_EXTRACTION_FOLDER');
        }

        throw new \Exception("Unsupported property");
    }

}