<?php
include_once("./class/DiaryEntry.php");
include_once("./class/User.php");
include_once("./config/dbconfig.php");

class Diary
{
    private $diaryEntries;

    public function __construct()
    {
        $this->diaryEntries = array();
    }

    public function loadUserData(User $user): void
    {
        global $dbConnection;

        $this->diaryEntries = array();

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT DiaryEntryId
            FROM DiaryEntry
            WHERE UserId = ?
            ORDER BY DateCreated DESC;
        SQL
        );

        $stmt->execute([$user->getId()]);
        
        while ($row = $stmt->fetch())
        {
            $diaryEntry = new DiaryEntry();
            $diaryEntry->loadData($row['DiaryEntryId']);
            array_push($this->diaryEntries, $diaryEntry);
        }
    }

    public function getEntries(): array
    {
        return $this->diaryEntries;
    }
}