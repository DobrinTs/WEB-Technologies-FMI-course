<!DOCTYPE html>
<html>

<head>
  <title> Add column </title>
  <meta charset="UTF-8">
</head>

<body>

  <?php
  $conn = new PDO('mysql:host=localhost;dbname=Electives;charset=utf8', 'root', '');

  $stmt = $conn->prepare("ALTER  TABLE electives
     ADD Column created_at timestamp NOT NULL DEFAULT current_timestamp");
  $stmt->execute();

  echo "<p> Added created_at column to database electives </p>";
  ?>

</body>

</html>
