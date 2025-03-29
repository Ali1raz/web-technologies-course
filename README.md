# PHP course

## Default settings for XAMPP:

## Connecting to mySQL:

Inside `db.inc.php` add following lines:

```php
$dsn = "mysql:host=localhost;dbname=myfirstdatabase";
$dbusername = 'root';
$dbpassword = "";
```

> Here dsn (Data Source Name) specifies
>
> - database type `mysql`
> - host `localhost`
> - dbname `myfirstdatabase`
> - db credentials `root` default mysql username on _XAMPP_
> - (empty password) default for `root`

## Error handling:

```php
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed ' . $e->getMessage();
}
```

> If failed due to wrong credentials, throw error.

## Full Example:

```php
// includes/db.inc.php
<?php

$dsn = "mysql:host=localhost;dbname=myfirstdatabase";
$dbusername = 'root';
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed ' . $e->getMessage();
}
```

---

# CRUD:

1. ## CREATE

```php
// index.php
<form action="includes/formhandler.inc.php" method="post">
  <input required type="text" name="username" placeholder="username" />
  <input required type="password" name="password" placeholder="password" />
  <button>SignUp</button>
</form>
```

- include handlerfile:

```php
<form action="includes/formhandler.inc.php" method="post">
```

> Client-side form validation:

```php
<input required type="text" name="username" placeholder="username">
```

> check if `POST` method:

```php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // ...
} else {
    // ...
}
```

> get field values from submitted form:

> ALSO CHECK XSS here: (not included yet)

```php
$username = $_POST["username"];
// other fields ...
```

> Error handling during Queries executions:

```php
try {
    // queries ...
} catch (PDOException $e) {
    // throw
    die("Query failed: " . $e->getMessage());
}
```

## Example:

```php
// includes/formhandler.php
<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    try {
        require_once 'db.inc.php';

        $query = "INSERT INTO users (username, pwd) VALUES (?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$username, $pwd]);

        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
}
```

# UPDATE:

```php
$query = "UPDATE users set username = :newUsername where username = :username and pwd = :pwd;";

$stmt = $pdo->prepare($query);

$stmt->bindParam(":username", $username);
$stmt->bindParam(":newUsername", $newUsername);
$stmt->bindParam(":pwd", $pwd);

$stmt->execute();
```

## Full Example:

```php
// includes/updateaccount.inc.php
<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST["username"];
    $newUsername = $_POST["newusername"];
    $pwd = $_POST["password"];

    try {
        require_once 'db.inc.php';

        $query = "UPDATE users set username = :newUsername where username = :username and pwd = :pwd;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":newUsername", $newUsername);
        $stmt->bindParam(":pwd", $pwd);

        $stmt->execute();

        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
}
``
```
