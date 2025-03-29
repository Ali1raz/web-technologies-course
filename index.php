<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php First website</title>
    <link rel="stylesheet" href="./style/styles.css">
</head>
<body>
    <main style="background: inherit;">
        <h1>CREATE Account</h1>
        <form action="includes/formhandler.inc.php" method="post">
            <input required type="text" name="username" placeholder="username">
            <input required type="password" name="password" placeholder="password">
            <button>SignUp</button>
        </form>
    </main>

    <main style="background: violet;">
        <h1>UPDATE Account Details</h1>
        <form action="includes/updateaccount.inc.php" method="post">
            <input required type="text" name="username" placeholder="OLD username">
            <input required type="password" name="password" placeholder="password">
            <input required type="text" name="newusername" placeholder="NEW username">
            <button>Update</button>
        </form>
    </main>

    <main style="background: red;">
        <h1>DELETE Account</h1>
        <form action="includes/deleteaccount.inc.php" method="post">
            <input required type="text" name="username" placeholder="username">
            <input required type="password" name="password" placeholder="password">
            <button>Delete</button>
        </form>
    </main>

    <main class="search">
        <h1>READ comments</h1>
        <form action="search.php" method="post">
            <input type="text" name="search" placeholder="Enter id to search">
            <button>Search</button>
        </form>
    </main>

</body>
</html>