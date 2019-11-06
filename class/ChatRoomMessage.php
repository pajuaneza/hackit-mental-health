<?php
include_once("./class/DatabaseLinkedObject.php");
include_once("./config/dbconfig.php");

class ChatRoomMessage extends DatabaseLinkedObject
{
    private $chatRoomId, $userId, $message, $dateCreated;

    public function __construct()
    {
        
    }

    public function setChatRoomId(int $chatRoomId): void
    {
        $this->chatRoomId = $chatRoomId;
    }

    public function getChatRoomId(): int
    {
        return $this->chatRoomId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
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
            FROM ChatRoomMessage
            WHERE ChatRoomMessageId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);
        
        if ($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch();

            // Set fields
            $this->setChatRoomId($row['ChatRoomId']);
            $this->setUserId($row['UserId']);
            $this->setMessage($row['Message']);
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
            INSERT INTO ChatRoomMessage (ChatRoomId, UserId, Message)
            VALUES (?, ?, ?)
        SQL
        );

        $stmt->execute([
            $this->getChatRoomId(),
            $this->getUserId(),
            $this->getMessage(),
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