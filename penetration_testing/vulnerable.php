<!DOCTYPE html>
<html>

<head>
    <title>Vulnerable Page</title>
</head>

<body>
    <h1>Welcome to the vulnerable page</h1>
    <form action="vulnerable.php" method="GET">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search">
        <input type="submit" value="Search">
    </form>
    <?php
    if (isset($_GET['search'])) {
        echo "You searched for: " . $_GET['search'];
    }
    ?>
</body>

</html>