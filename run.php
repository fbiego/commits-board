<?php


function getCountry($country)
{
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, 'https://commits.top/' . $country);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($cURLConnection, CURLOPT_HEADERFUNCTION, "getHeaders");
    curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
        'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.82 Mobile Safari/537.36'
    ));

    $json = curl_exec($cURLConnection);

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($json);
    $list = $dom->getElementsByTagName("tbody")
        ->item(0);
    $data = $list->getElementsByTagName("tr");
    $date = $dom->getElementsByTagName("code")
        ->item(0)->nodeValue;
    $fname = str_replace([' ', '-', ':', '+'], ['_', '', '', ''], $date);
    $array = "{" . PHP_EOL;
    $x = 1;
    foreach ($data as $n)
    {

        $elem = $n->getElementsByTagName("td");
        $rank = $elem->item(0)->nodeValue;
        $commits = $elem->item(2)->nodeValue;
        $username = $n->getElementsByTagName("a")
            ->item(0)->nodeValue;
        $icon = $elem->item(3)
            ->getElementsByTagName("img")
            ->item(0)
            ->getAttribute("data-src");
        $name = $elem->item(1)->nodeValue;
        $name = str_replace($username, "", $name);
        $name = str_replace("(", "", $name);
        $name = str_replace(")", "", $name);
        $name = str_replace('"', '\"', $name);
        $array = $array . '"' . $username . '":{"rank": ' . str_replace(".", "", $rank) . ', "icon": "' . urldecode($icon) . '", "name": "' . $name . '", "commits": ' . $commits . '}';

        if ($x < 256)
        {
            $array = $array . ',' . PHP_EOL;
        }
        $x = $x + 1;

    }

    $array = $array . '}' . PHP_EOL;
    if (!is_dir($country . '/'))
    {
        // dir doesn't exist, make it
        mkdir($country . '/');
    }
    file_put_contents($country . '/' . str_split($fname, 15) [0] . ".json", $array);

}

$file = file_get_contents("countries.json");
$json = json_decode($file, true);
foreach ($json as $i => $j)
{
    getCountry($i);
}

?>
