<?php

namespace Epub;

use Archive7z\Archive7z;
use Zakirovir6\Directory\IteratorRecursive;

class Generator
{
    /** @var Archive7z  */
    private $archive;

    /** @var Config */
    private $config;

    /**
     * Generator constructor.
     * @throws \Archive7z\Exception
     * @throws \Exception
     */
    public function __construct()
    {
        $this->config = new Config();
        $this->archive = new Archive7z($this->config->filename);
        if ($this->config->password) {
            $this->archive->setPassword($this->config->password);
        }

        if (!$this->archive->isValid()) {
            throw new \Exception('Incorrect archive ' . $this->config->filename);
        }

        if (! is_dir($this->config->extractionFolder) &&
            !mkdir($this->config->extractionFolder, 0777, true)) {
            throw new \Exception('Cannot create extraction folder ' . $this->config->extractionFolder);
        }

        $this->archive->setOutputDirectory($this->config->extractionFolder);
        $this->archive->extract();
    }

    /**
     * @return \Generator
     */
    public function getEpubsInArchive()
    {
        foreach (new IteratorRecursive($this->config->extractionFolder) as $key => $file)
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