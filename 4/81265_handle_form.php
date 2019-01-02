<!DOCTYPE html>
<html>
<head>
  <title> Form result </title>
  <meta charset="UTF-8" />
</head>

<body>
<?php
  //Display request
  $request_info = <<<EOT
  This is the request I got: <br/>
  <div>Title: {$_POST["title"]}</div>
  <div>Lecturer: {$_POST["lecturer"]}</div>
  <div>Description: {$_POST["description"]}</div>
  <div>Group: {$_POST["group"]}</div>
  <div>Credits: {$_POST["credits"]}</div>
EOT;
  echo $request_info;
  echo "----------------------------------<br/>"
?>

<?php
  function is_required_field_present($field_name, &$errors)
  {
      if (!$_POST[$field_name]) {
          $errors[$field_name] = "$field_name е задължително поле.";
          return false;
      }
      return true;
  }

  function is_above_min_length($field_name, $minlength, &$errors)
  {
      if (strlen($_POST[$field_name]) < $minlength) {
          $errors[$field_name] = "$field_name има минимална дължина $minlength символа.";
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

  function is_valid_value($field_name, $allowed_values, &$errors)
  {
      if (!in_array($_POST[$field_name], $allowed_values)) {
          $errors[$field_name] = "$field_name трябва да е една от следните стойности: "
            . implode(', ', $allowed_values);
          return false;
      }
      return true;
  }

  function is_a_positive_integer($field_name, &$errors)
  {
      $toFloat = (float)$_POST[$field_name];
      if ($toFloat <= 0 || ($toFloat !== floor($toFloat))) {
          $errors[$field_name] = "$field_name трябва да е цяло положително число.";
          return false;
      }
      return true;
  }


  $valid = array();
  $errors = array();

  if ($_POST) {
      //Title validations
      if (is_required_field_present('title', $errors) &&
          is_below_max_length('title', 150, $errors)) {
          $valid['title'] = $_POST['title'];
      }

      //Lecturer validation
      if (is_required_field_present('lecturer', $errors) &&
          is_below_max_length('lecturer', 200, $errors)) {
          $valid['lecturer'] = $_POST['lecturer'];
      }

      //Description validation
      if (is_required_field_present('description', $errors) &&
          is_above_min_length('description', 10, $errors)) {
          $valid['description'] = $_POST['description'];
      }

      //Group validation
      $allowed_group_values = ['М', 'ПМ', 'ОКН', 'ЯКН'];
      if (is_valid_value('group', $allowed_group_values, $errors)) {
          $valid['group'] = $_POST['group'];
      }

      //Credits validation
      if (is_a_positive_integer('credits', $errors)) {
          $valid['credits'] = $_POST['credits'];
      }

      echo "Valid fields are: <br/>";
      foreach ($valid as $key => $value) {
          echo $key . "<br/>";
      }
      echo "<br/>--------------------<br/>";
      echo "Errors encountered: <br/>";
      foreach ($errors as $key => $value) {
          echo $value . "<br/>";
      }
  }
?>
</body>
</html>
