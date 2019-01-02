<?php
class Request
{
    protected $info;
    public function __construct($info)
    {
        $this->info = $info;
    }

    public function getMethod()
    {
        $method = $this->info['REQUEST_METHOD'];
        return mb_strtolower($method);
    }

    public function getPath()
    {
        return $this->info['PHP_SELF'];
    }

    public function getURL()
    {
        return $this->info['SERVER_NAME'] . $this->info['REQUEST_URI'];
    }

    public function getUserAgent()
    {
        return $this->info['HTTP_USER_AGENT'];
    }
}

class GetRequest extends Request
{
    public function getData()
    {
        $exploded_data = explode('&', $this->info['QUERY_STRING']);
        $endresult = [];
        foreach ($exploded_data as $value) {
            $attribute = explode('=', $value);
            $endresult[$attribute[0]] = $attribute[1];
        }

        return $endresult;
    }
}

// Example Usage
$custom = new GetRequest($_SERVER);
echo "<p>" . $custom->getMethod() . "</p>";
echo "<p>" . $custom->getPath() . "</p>";
echo "<p>" . $custom->getURL() . "</p>";
echo "<p>" . $custom->getUserAgent() . "</p>";

$data = $custom->getData();
// echo "<p>" . $data . "</p>";
foreach ($data as $key => $value) {
    echo "<p> Key: " . $key ."; value: " . $value . "</p>";
}
