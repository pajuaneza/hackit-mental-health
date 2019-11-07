<?php
include_once("./class/DatabaseLinkedObject.php");
include_once("./config/appconfig.php");
include_once("./config/dbconfig.php");

class Psychiatrist extends DatabaseLinkedObject
{
    private $name, $latitude, $longitude, $description;

    public function __construct()
    {
        
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCoordinates(float $latitude, float $longitude): void
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function loadData(int $id): bool
    {
        global $dbConnection;

        $this->setId($id);

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT *
            FROM Psychiatrist
            WHERE PsychiatristId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);
        
        if ($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch();

            // Set fields
            $this->setName($row['Name']);
            $this->setCoordinates($row['Latitude'], $row['Longitude']);
            $this->setDescription($row['Description']);
            
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

    public function getRatings(): array
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT *
            FROM PsychiatristRating
            WHERE PsychiatristId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);

        $ratingsList = array();
        while ($row = $stmt->fetch())
        {
            $rater = new User();
            $rater->loadData($row['UserId']);

            array_push($ratingsList, array('Rating' => $row['Rating'], 'Comment' => $row['Comment'], 'Rater' => $rater));
        }

        return $ratingsList;
    }

    public function getAverageRating(): ?float
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT Rating
            FROM PsychiatristRating
            WHERE PsychiatristId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);

        if ($stmt->rowcount() <= 0)
        {
            return null;
        }
        else
        {
            $total = 0;

            while ($row = $stmt->fetch())
            {
                $total += $row['Rating'];
            }

            return (double)$total / $stmt->rowcount();
        }
    }

    public function addRating(int $rating, string $review, int $userId)
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            INSERT INTO PsychiatristRating (PsychiatristId, Rating, Comment, UserId)
            VALUES (?, ?, ?, ?)
        SQL
        );

        $stmt->execute([$this->getId(), $rating, $review, $userId]);
    }
}