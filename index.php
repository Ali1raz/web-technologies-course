<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP First Website</title>
    <link rel="stylesheet" href="./style/styles.css">
</head>
<body>

    <section class="account-section create">
        <h1>Create Account</h1>
        <form action="includes/formhandler.inc.php" method="post">
            <input required type="text" name="username" placeholder="Username">
            <input required type="password" name="password" placeholder="Password">
            <button>Sign Up</button>
        </form>
    </section>

    <section class="account-section update">
        <h1>Update Account Details</h1>
        <form action="includes/updateaccount.inc.php" method="post">
            <input required type="text" name="username" placeholder="Old Username">
            <input required type="password" name="password" placeholder="Password">
            <input required type="text" name="newusername" placeholder="New Username">
            <button>Update</button>
        </form>
    </section>

    <section class="account-section delete">
        <h1>Delete Account</h1>
        <form action="includes/deleteaccount.inc.php" method="post">
            <input required type="text" name="username" placeholder="Username">
            <input required type="password" name="password" placeholder="Password">
            <button>Delete</button>
        </form>
    </section>

    <section class="account-section search">
        <h1>Read Comments</h1>
        <form action="search.php" method="post">
            <input required type="text" name="search" placeholder="Enter username to search">
            <button>Search</button>
        </form>
    </section>

</body>
</html>
