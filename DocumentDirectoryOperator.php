<?php

class DocumentDirectoryOperator
{
    const SECONDS = 1, MINUTES = 60 , HOURS = 60*60;
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

    public function removeOlderThan(int $count, int $unit): void
    {
        foreach (new DirectoryIterator($this->directoryName) as $fileInfo)
        {
            if ($fileInfo->isDot())
            {
                continue;
            }
            if ($fileInfo->isFile() && time() - $fileInfo->getCTime() >= $count * $unit)
            {
                unlink($fileInfo->getRealPath());
            }
        }
    }
}