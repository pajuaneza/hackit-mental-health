<?php
include_once("./class/DatabaseLinkedObject.php");
include_once("./config/dbconfig.php");

class User extends DatabaseLinkedObject
{
    private $emailAddress, $passwordHash, $firstName, $lastName, $username, $dateCreated;

    public function __construct()
    {
        
    }

    public function setEmailAddress(string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function setPassword(string $password): void
    {
        $this->setPasswordHash(hash("sha256", $password));
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public static function getUserFromEmailAddress(string $emailAddress): ?User
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT UserId
            FROM User
            WHERE EmailAddress = ?;
        SQL
        );

        $stmt->execute([$emailAddress]);

        if ($stmt->rowcount() > 0)
        {
            $row = $stmt->fetch();
            $user = new User();
            $user->loadData($row['UserId']);

            return $user;
        }
        else
        {
            return null;
        }
    }

    public function loadData(int $id): bool
    {
        global $dbConnection;

        $this->setId($id);

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT *
            FROM User
            WHERE UserId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);
        
        if ($stmt->rowCount() > 0)
        {
            $row = $stmt->fetch();

            // Set fields
            $this->setEmailAddress($row['EmailAddress']);
            $this->setPasswordHash($row['PasswordHash']);
            $this->setFirstName($row['FirstName']);
            $this->setLastName($row['LastName']);
            $this->setUsername($row['Username']);
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
            INSERT INTO User (EmailAddress, PasswordHash, FirstName, LastName, Username)
            VALUES (?, ?, ?, ?, ?)
        SQL
        );

        $stmt->execute([
            $this->getEmailAddress(),
            $this->getPasswordHash(),
            $this->getFirstName(),
            $this->getLastName(),
            $this->getUsername(),
        ]);
        
        if ($stmt->rowCount() > 0)
        {
            $this->setId($stmt->lastInsertId());

            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateData(): bool
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            UPDATE User
            SET EmailAddress = ?, PasswordHash = ?, FirstName = ?, LastName = ?, Username = ?
            WHERE UserId = ?
        SQL
        );

        $stmt->execute([
            $this->getEmailAddress(),
            $this->getPasswordHash(),
            $this->getFirstName(),
            $this->getLastName(),
            $this->getUsername(),
            
            $this->getId(),
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

    /**
     * Checks if the current user's username and given password is valid
     *
     * @param string $passwordHash
     * @return boolean
     */
    public function isValid(string $passwordHash): bool
    {
        return $this->isUsernameValid() && $this->isPasswordValid($passwordHash);
    }

    /**
     * Checks if the username is valid (in the database)
     *
     * @return boolean
     */
    public static function isUsernameValid($username): bool
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT COUNT(1)
            FROM User
            WHERE Username = ?;
        SQL
        );

        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_NUM);

        return $row[0] >= 1;
    }

    /**
     * Checks if the given password is valid to the current user
     *
     * @param string $password
     * @param boolean $isHashed Whether the given password has been hashed with
     * SHA256 or not
     * @return boolean
     */
    public function isPasswordValid(string $password, bool $isHashed = FALSE): bool
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT PasswordHash
            FROM User
            WHERE UserId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);
        $result = $stmt->fetch(PDO::FETCH_NUM);

        return $result[0] == ($isHashed ? $password : hash("sha256", $password));
    }

    public function getPoints(): int
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT SUM(Earning) - SUM(Spending) AS Points
            FROM UserPoints
            WHERE UserId = ?;
        SQL
        );

        $stmt->execute([$this->getId()]);

        $data = $stmt->fetch();

        return $data['Points'] != null
            ? $data['Points']
            : 0;
    }
}