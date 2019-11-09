<?php
include_once("./class/DatabaseLinkedObject.php");
include_once("./config/dbconfig.php");

class DiaryEntry extends DatabaseLinkedObject
{
    private $userId, $content, $dateCreated;

    public function __construct()
    {
        
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public function loadData(int $id): bool
    {
        global $dbConnection;

        $this->setId($id);

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT *
            FROM DiaryEntry
            WHERE DiaryEntryId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);
        
        if ($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch();

            // Set fields
            $this->setUserId($row['UserId']);
            $this->setContent($row['Content']);
            $this->dateCreated = new DateTime($row['DateCreated']);
            
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveData(): bool
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            INSERT INTO DiaryEntry (UserId, Content)
            VALUES (?, ?)
        SQL
        );

        $stmt->execute([
            $this->getUserId(),
            $this->getContent(),
        ]);
        
        if ($stmt->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateData(): bool
    {
        // TODO: Implement
    }
}