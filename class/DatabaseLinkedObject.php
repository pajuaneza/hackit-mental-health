<?php
include_once("./config/dbconfig.php");

abstract class DatabaseLinkedObject
{
    protected $id;

    abstract public function loadData(int $id): bool;
    abstract public function saveData(): bool;
    abstract public function updateData(): bool;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    private function isNullOrWhitespace(?string $string): bool
    {
        return ctype_space($string) || empty($string);
    }

    protected function emptyStringToNull(?string $string): ?string
    {
        if (isset($string))
        {
            $string = trim($string);
        }

        return !$this->isNullOrWhitespace($string) ? $string : null;
    }
}