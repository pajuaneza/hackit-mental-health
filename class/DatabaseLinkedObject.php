<?php
include_once("./config/dbconfig.php");

/**
 * Represents a row in a table in the database
 */
abstract class DatabaseLinkedObject
{
    /**
     * The ID of the object, usually the primary key of the table
     *
     * @var int
     */
    protected $id;

    /**
     * Loads all necessary data from the database using the ID
     *
     * @param integer $id
     * @return bool Whether or not any data was loaded (the object exists)
     */
    abstract public function loadData(int $id): bool;

    /**
     * Inserts a new row into the database using
     * the values stored in the object's fields
     *
     * @return void
     */
    abstract public function saveData(): void;

    /**
     * Updates the row corresponding to the object's ID
     * with the values stored in the object's fields
     *
     * @return void
     */
    abstract public function updateData(): void;

    /**
     * Sets the object's ID
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Returns the object's ID
     *
     * @return integer The object's ID
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Checks if the string's value is null, empty, or filled with whitespace
     * characters
     *
     * @param string|null $string
     * @return bool
     */
    private function isNullOrWhitespace(?string $string): bool
    {
        return ctype_space($string) || empty($string);
    }

    /**
     * Returns the string's value if it is not null, empty, or filled with
     * whitespace characters, returns null otherwise
     * 
     * The string returned by this method will have all whitespace characters
     * at the start and end of the string stripped
     *
     * @param string|null $string
     * @return string|null
     */
    protected function emptyStringToNull(?string $string): ?string
    {
        if (isset($string))
        {
            $string = trim($string);
        }

        return !$this->isNullOrWhitespace($string) ? $string : null;
    }
}