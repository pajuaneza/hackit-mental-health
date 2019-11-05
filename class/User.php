<?php
include_once("./class/DatabaseLinkedObject.php");
include_once("./config/dbconfig.php");

/**
 * Represents a user account used for logging into the system
 */
class User extends DatabaseLinkedObject
{
    private $username, $passwordHash, $emailAddress;

    /**
     * Searches for a user account with the given username, then returns a User
     * object if found, otherwise returns null
     *
     * @param string $username
     * @return User|null
     */
    public static function getUserFromUsername(string $username): ?User
    {
        global $dbConnection;

        $stmt = $dbConnection->prepare(<<<SQL
            SELECT UserId
            FROM User
            WHERE Username = ?;
        SQL
        );

        $stmt->execute([$username]);

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

    public function __construct()
    {
        
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
            // TODO: Use setters
            $this->username = $row['Username'];
            $this->passwordHash = $row['PasswordHash'];
            $this->emailAddress = $row['EmailAddress'];
            
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

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * Sets the username
     *
     * @param string $username
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * Gets the username
     *
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * Returns the date that the account was created as a DateTime object
     *
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }
}