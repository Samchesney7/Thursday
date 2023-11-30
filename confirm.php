<?php
function getUsers()
{
    $usersFile = 'users.txt';
    if (file_exists($usersFile)) {
        $usersJson = file_get_contents($usersFile);
        return json_decode($usersJson, true);
    }
    return [];
}

// Function to write user data to the file
function saveUsers($users)
{
    $usersFile = 'users.txt';
    $usersJson = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents($usersFile, $usersJson);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    // Check if the registration or login form is submitted
    if (isset($_POST["register"])) {
        // Register new user
        if (isset($_POST["new_username"]) && isset($_POST["new_password"])) {
            $newUsername = $_POST["new_username"];
            $newPassword = $_POST["new_password"];

            $users = getUsers();
            if (!isset($users[$newUsername])) {
                // Add new user
                $users[$newUsername] = $newPassword;
                saveUsers($users);

                $_SESSION["loggedIn"] = true;
                etcookie("username", $newUsername, time() + 3600, "/"); // Cookie expires in 1 hour
                header("Location: menu.php"); // Redirect to the homepage after successful registration
                exit();
            } else {
                $error_message = "Username already exists. Please choose a different one.";
            }
        } else {
            $error_message = "Username or password is blank. Please try again.";

            header("Location: menu.php"); // Redirect to the homepage after successful registration
            exit();
        } else {
            $error_message = "Username already exists. Please choose a different one.";


        }
    } elseif (isset($_POST["login"])) {
        // Login existing user
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
    
            $users = getUsers();
            if (isset($users[$username]) && $users[$username] === $password) {
                $_SESSION["loggedIn"] = true;
    
                // Set a cookie for the logged-in user
                setcookie("username", $username, time() + 3600, "/"); // Cookie expires in 1 hour
    
                header("Location: menu.php"); // Redirect to the homepage after successful login
                exit();
            } else {
                $error_message = "Wrong username or password. Please try again.";
            }
        } else {
            $error_message = "Username or password is blank. Please try again.";
        }
    }
    

// Render the login and registration forms
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php if (isset($error_message)) : ?>
    <p><?php echo $error_message; ?></p>
<?php endif; ?>

<!-- Login Form -->
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" name="login" value="Login">
</form>

<!-- Registration Form -->
<form method="post" action="">
    <label for="new_username">New Username:</label>
    <input type="text" id="new_username" name="new_username" required>
    <br>
    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required>
    <br>
    <input type="submit" name="register" value="Register">
</form>

<!-- Link back to menu -->
<a href="menu">Back to menu</a>

</body>
</html>
