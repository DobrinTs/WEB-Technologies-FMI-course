<?php
  //Validations helpers
  function is_required_field_present($field_name, &$errors)
  {
      if (!$_POST[$field_name]) {
          $errors[$field_name] = "$field_name е задължително поле.";
          return false;
      }
      return true;
  }
  function is_below_max_length($field_name, $maxlength, &$errors)
  {
      if (strlen($_POST[$field_name]) > $maxlength) {
          $errors[$field_name] = "$field_name има максимална дължина $maxlength символа.";
          return false;
      }
      return true;
  }
?>

<?php
  //Validations
  $valid = array();
  $errors = array();

  if ($_POST) {
      //Title validations
      if (is_required_field_present('title', $errors) &&
          is_below_max_length('title', 128, $errors)) {
          $valid['title'] = $_POST['title'];
      }

      //Lecturer validation
      if (is_required_field_present('lecturer', $errors) &&
          is_below_max_length('lecturer', 128, $errors)) {
          $valid['lecturer'] = $_POST['lecturer'];
      }

      //Description validation
      if (is_required_field_present('description', $errors) &&
          is_below_max_length('description', 1024, $errors)) {
          $valid['description'] = $_POST['description'];
      }
  }
?>

<?php
  $conn = new PDO('mysql:host=localhost;dbname=Electives;charset=utf8', 'root', '');
  $stmt = $conn->prepare("SELECT * FROM electives WHERE id=?");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $update_statement = $conn->prepare(
        "UPDATE electives
        SET title=?, description=?, lecturer=?
        WHERE id=?"
      );

      if (empty($errors)) {
          $update_statement->execute([$_POST['title'], $_POST['description'],
            $_POST['lecturer'], $_GET['id']]);
      } else {
          echo "Course not updated! Errors: <br/>";
          foreach ($errors as $key => $value) {
              echo $value . "<br/>";
          }
      }
  }

  $stmt->execute([$_GET['id']]);
  $elective = $stmt->fetch();
?>
<!DOCTYPE html>
<html>

<head>
  <title> Electives </title>
  <meta charset="UTF-8">
</head>

<body>

  <form method="post">
    <label for="course-title"> Course Title </label>
    <?php
      echo "<input id=\"course-title\" name=\"title\"
        value=\"{$elective['title']}\">";
    ?>

    <label for="course-description"> Course Description </label>
    <?php
      echo "<input id=\"course-description\" name=\"description\"
        value=\"{$elective['description']}\">";
    ?>

    <label for="course-lecturer"> Course Lecturer </label>
    <?php
      echo "<input id=\"course-lecturer\" name=\"lecturer\"
        value=\"{$elective['lecturer']}\">";
    ?>

    <button> Submit </button>
  </form>
</body>
</html>
