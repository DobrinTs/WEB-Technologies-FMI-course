<!--
    showPage($data, $pageId)
    showNav($data, $pageId)
-->

<?php function showPage($data, $pageId)
{
    $page = $data[$pageId];

    $text = <<<EOF
			<h1> {$page['title']} </h1>
	    <h2> {$page['lecturer']} </h2>
	    <p> {$page['description']} </p>
EOF;

    return $text;
}
?>

<?php function showNav($data, $pageId)
{
    $page = $data[$pageId];

    $text = "<nav>";
    foreach ($data as $key => $value) {
        $title = $value['title'];
        if ($key === $pageId) {
            $text = $text . "<a href=\"?page=$key\" class=\"selected\"> $title </a>";
        } else {
            $text = $text . "<a href=\"?page=$key\"> $title </a>";
        }
    }
    $text = $text . "</nav>";

    return $text;
}

?>

<?php
// Example usage
  $custom_data = [
    'webgl' => [
        'title' => 'Компютърна графика с WebGL',
        'description' => '...',
        'lecturer' => 'доц. П. Бойчев',
    ],
    'go' => [
        'title' => 'Програмиране с Go',
        'description' => '...',
        'lecturer' => 'Николай Бачийски',
    ],
  ];

  echo showNav($custom_data, 'webgl');
  echo showPage($custom_data, 'webgl');
 ?>
