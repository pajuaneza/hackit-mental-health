<?php
include_once("./class/User.php");
include_once("./config/dbconfig.php");

session_start();

if (isset($_POST['submit']))
{
	if ($_SESSION['activeUser']->isPasswordValid($_POST['passwordCurrent']))
	{
		if ($_POST['passwordNew'] == $_POST['passwordNewVerify'])
	    {
	    	// TODO: Use DatabaseLinkedObject saveData method
	    	$hashedNewPassword = hash("sha256", $_POST['passwordNew']);
	    	$stmt = $dbConnection->prepare(<<<SQL
	    		UPDATE User
	    		SET PasswordHash = :passwordHash
	    		WHERE UserId = :userId;
SQL
			);

			$stmt->execute([
				':passwordHash' => $hashedNewPassword,
				':userId' => $_SESSION['activeUser']->getId()
			]);

	    	header("location: ./settings.php?successPassword");
	    }
	    else
	    {
	    	header("location: ./settings.php?errorPasswordVerify");
	    }
	}
    else
    {
    	header("location: ./settings.php?errorPasswordCurrent");
    }
}
else
{
    header("location: ./");
}