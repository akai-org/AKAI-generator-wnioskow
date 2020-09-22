<?php

class DocumentDirectoryOperator
{
    private $directoryName;

    public function __construct($directoryName)
    {
        $this->directoryName = $directoryName;
    }

    public function directoryExists(): bool
    {
        return file_exists($this->directoryName);
    }

    public function createDirectory(): void
    {
        mkdir($this->directoryName, 0777, true);
    }

    public function removeOlderThan(int $minutes): void
    {
        foreach (new DirectoryIterator($this->directoryName) as $fileInfo)
        {
            if ($fileInfo->isDot())
            {
                continue;
            }
            if ($fileInfo->isFile() && time() - $fileInfo->getCTime() >= 1*60*60/*godziny * minuty * sekundy*/) //usuwa pliki starsze niż godzina
            {
                unlink($fileInfo->getRealPath());
            }
        }
    }
}