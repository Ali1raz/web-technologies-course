<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php First website</title>
    <style>

        body {
            font-family: poppins;
            color: #fff;
            background: #222;
            margin: 0;
            width: 100%;
            height: 100vh;
        }

        main {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items:center;
            justify-content: center;

            h1 {
                position: sticky;
                top: 0;
                text-align: center;
                width: 100%;
                font-size: 3rem;
                background: inherit;
            }
        }

        
    </style>
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

</body>
</html>