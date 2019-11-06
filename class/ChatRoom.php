<?php
include_once("./class/ChatRoomMessage.php");
include_once("./class/DatabaseLinkedObject.php");
include_once("./config/dbconfig.php");

class ChatRoom extends DatabaseLinkedObject
{
    private $name, $topic, $description, $rules, $themeColor;

    public function __construct()
    {
        
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setTopic(string $topic): void
    {
        $this->topic = $topic;
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setRules(string $rules): void
    {
        $this->rules = $rules;
    }

    public function getRules(): string
    {
        return $this->rules;
    }

    public function setThemeColor(string $themeColor): void
    {
        $this->themeColor = $themeColor;
    }

    public function getThemeColor(): string
    {
        return $this->themeColor;
    }

    public function loadData(int $id): bool
    {
        global $dbConnection;

        $this->setId($id);

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT *
            FROM ChatRoom
            WHERE ChatRoomId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);
        
        if ($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch();

            // Set fields
            $this->setName($row['Name']);
            $this->setTopic($row['Topic']);
            $this->setDescription($row['Description']);
            $this->setRules($row['Rules']);
            $this->setThemeColor($row['ThemeColor']);
            
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveData(): bool
    {
        // TODO: Implement
    }

    public function updateData(): bool
    {
        // TODO: Implement
    }

    public static function getAllChatRoom(): array
    {
        global $dbConnection;

        $chatRoomList = array();

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT ChatRoomId
            FROM ChatRoom;
        SQL
        );

        $stmt->execute();
        
        while ($row = $stmt->fetch())
        {
            $chatRoom = new ChatRoom();
            $chatRoom->loadData($row['ChatRoomId']);
            array_push($chatRoomList, $chatRoom);
        }

        return $chatRoomList;
    }

    public function getMessages(?int $messageNumber = null): array
    {
        global $dbConnection;

        $messageList = array();

        if ($messageNumber == null)
        {
            $stmt = $dbConnection->prepare(<<<SQL
                SELECT ChatRoomMessageId
                FROM ChatRoomMessage
                WHERE ChatRoomId = ?;
            SQL
            );
        }
        else
        {
            $stmt = $dbConnection->prepare(<<<SQL
                SELECT ChatRoomMessageId
                FROM ChatRoomMessage
                WHERE ChatRoomId = ?
                LIMIT {$messageNumber};
            SQL
            );
        }

        $stmt->execute([$this->getId()]);
        
        while ($row = $stmt->fetch())
        {
            $chatRoomMessage = new ChatRoomMessage();
            $chatRoomMessage->loadData($row['ChatRoomMessageId']);
            array_push($messageList, $chatRoomMessage);
        }

        return $messageList;
    }
}