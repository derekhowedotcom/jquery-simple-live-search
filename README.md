# jQuery Simple Live Search
> A simple example of live jQuery search connected to a mysql database.

**LICENCE:** MIT

## How to use

Ensure you have a database setup with the data you want to use with your live search. 

Within search.php update the database connection string with the required host, database name, username and password for your database.
```php
//connect to db
$conn = new PDO('mysql:host=localhost;dbname=locations', 'user', 'password');
```

The query will need to be changed to look at your database table.
```php
$stmt = $conn->prepare("SELECT DISTINCT name FROM cities WHERE name LIKE :queryString LIMIT 20");
```




