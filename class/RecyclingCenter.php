<?php
include_once("./class/DatabaseLinkedObject.php");
include_once("./config/dbconfig.php");

class RecyclingCenter extends DatabaseLinkedObject
{
    private $name, $latitude, $longitude;

    public function __construct()
    {
        
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCoordinates(): string
    {
        return "{$this->latitude},{$this->longitude}";
    }

    public function loadData(int $id): bool
    {
        global $dbConnection;

        $this->setId($id);

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT *
            FROM RecyclingCenter
            WHERE RecyclingCenterId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);
        
        if ($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch();

            // Set fields
            $this->name = $row['Name'];
            $this->latitude = $row['Latitude'];
            $this->longitude = $row['Longitude'];
            
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveData(): void
    {
        // TODO: Implement
    }

    public function updateData(): void
    {
        // TODO: Implement
    }

    /**
     * Returns NONE if cannot accept, SOME if can accept some, ALL if can accept all
     *
     * @param integer $categoryId
     * @return boolean
     */
    public function canAcceptMaterialCategory(array $categoryId)
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT MaterialCategoryId
            FROM RecyclingCenterAvailability
            INNER JOIN RecyclingCenter ON RecyclingCenterAvailability.RecyclingCenterId = RecyclingCenter.RecyclingCenterId
            WHERE RecyclingCenterAvailability.RecyclingCenterId = ?
        SQL
        );

        $stmt->execute([$this->getId()]);

        $ctr = 0;

        while ($row = $stmt->fetch())
        {
            if (in_array($row['MaterialCategoryId'], $categoryId))
            {
                $ctr++;
            }
        }

        if ($ctr === 0)
        {
            return "NONE";
        }
        else if ($ctr === count($categoryId))
        {
            return "ALL";
        }
        else
        {
            return "SOME";
        }
    }
}