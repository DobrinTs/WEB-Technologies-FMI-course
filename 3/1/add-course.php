<!DOCTYPE html>
<html>

<head>
  <title> Add course </title>
  <meta charset="UTF-8">
</head>

<body>
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

    $conn = new PDO('mysql:host=localhost;dbname=Electives;charset=utf8', 'root', '');
    $stmt = $conn->prepare("INSERT INTO electives (title, description, lecturer) VALUES (?, ?, ?)");

    if (empty($errors)) {
        $stmt->execute([$_POST['title'], $_POST['description'], $_POST['lecturer']]);
        echo "<p>Great success!!!</p>";
    } else {
        echo "Course not added! Errors: <br/>";
        foreach ($errors as $key => $value) {
            echo $value . "<br/>";
        }
    }
  ?>

</body>
</html>
