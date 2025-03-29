# PHP course

## Default settings for XAMPP:

## Connecting to mySQL:

Inside `db.inc.php` add following lines:

```php
$dsn = "mysql:host=localhost;dbname=myfirstdatabase";
$dbusername = 'root';
$dbpassword = "";
```

> where dsn (Data Source Name) specifies
>
> - database type `mysql`
> - host `localhost`
> - dbname `myfirstdatabase`
> - db credentials _`root`_ default mysql username on _XAMPP_
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

---

# CRUD:

1. ## CREATE

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
