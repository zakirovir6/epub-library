<?php

namespace Epub;

use Archive7z\Archive7z;
use Zakirovir6\Directory\IteratorRecursive;

class Generator
{
    /** @var Archive7z  */
    private $archive;

    /** @var string */
    private $extractionFolder;

    /**
     * Generator constructor.
     * @param $zipFilename
     * @param string $zipPass
     * @param string $extractionFolder
     *
     * @throws \Archive7z\Exception
     * @throws \Exception
     */
    public function __construct(
        $zipFilename,
        $zipPass = '',
        $extractionFolder = '/tmp/zip_extraction/folder')
    {
        $this->archive = new Archive7z($zipFilename);
        if ($zipPass) {
            $this->archive->setPassword($zipPass);
        }

        if (!$this->archive->isValid()) {
            throw new \Exception('Incorrect archive ' . $zipFilename);
        }

        if (! is_dir($extractionFolder) &&
            !mkdir($extractionFolder, 0777, true)) {
            throw new \Exception('Cannot create extraction folder ' . $extractionFolder);
        }

        $this->archive->setOutputDirectory($extractionFolder);
        $this->archive->extract();
    }

    /**
     * @return \Generator
     */
    public function getEpubsInArchive()
    {
        foreach (new IteratorRecursive($this->extractionFolder) as $key => $file)
        {
            if (is_dir($file)) {
                continue;
            }

            if (!pathinfo($file, PATHINFO_EXTENSION) === 'epub') {
                continue;
            }

            yield $file;
        }
    }
}