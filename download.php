<?php
spl_autoload_extensions(".php"); 
spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

//POSTリクエストからパラメーターを取得
$numberEmployees = $_POST['numberEmployees'] ?? 3;
$minSalary = $_POST['minSalary'] ?? 10;
$maxSalary = $_POST['maxSalary'] ?? 50;
$numberLocations = $_POST['numberLocations'] ?? 3;
$minZipcode = $_POST['minZipcode'] ?? 1;
$maxZipcode = $_POST['maxZipcode'] ?? 10;
$format =$_POST['format'] ?? 'html';

// パラメータが正しき形式であることを確認
$numberEmployees = (int)$numberEmployees;
$minSalary = (int)$minSalary;
$maxSalary = (int)$maxSalary;
$numberLocations = (int)$numberLocations;
$minZipcode = (int)$minZipcode;
$maxZipcode = (int)$maxZipcode;

// 検証
if(
    is_null($numberEmployees) ||
    is_null($minSalary) ||
    is_null($maxSalary) ||
    is_null($numberLocations) ||
    is_null($minZipcode) ||
    is_null($maxZipcode) ||
    is_null($format)){
            exit('Missing parameters.');
}

if(!is_numeric($numberEmployees) || $numberEmployees < 1 || $numberEmployees > 5){
    exit('Invalid number of employees. Must be a number betwen 1 and 5');
}

if(!is_numeric($minSalary) || $minSalary < 1 || $minSalary > 100 || $minSalary > $maxSalary){
    exit('Invalid number of salary. Must be a number betwen 1 and 100');
}

if(!is_numeric($maxSalary) || $maxSalary < 1 || $maxSalary > 100 || $minSalary > $maxSalary){
    exit('Invalid number of salary. Must be a number betwen 1 and 100');
}

if(!is_numeric($numberLocations) || $numberLocations < 1 || $numberLocations > 5){
    exit('Invalid number of locations. Must be a number betwen 1 and 5');
}

if(!is_numeric($minZipcode) || $minZipcode < 1 || $minZipcode > 20 || $minZipcode > $maxZipcode){
    exit('Invalid number of zip code. Must be a number betwen 1 and 20');
}

if(!is_numeric($maxZipcode) || $maxZipcode < 1 || $maxZipcode > 20 || $minZipcode > $maxZipcode){
    exit('Invalid number of zip code. Must be a number betwen 1 and 20');
}

$allowedFormats = ['json', 'txt', 'html', 'md'];
if (!in_array($format, $allowedFormats)) {
    exit('Invalid type. Must be one of: ' . implode(', ', $allowedFormats));
}

//データを生成
$restaurantChains = \Helpers\RandomGenerator::restaurantChains($numberEmployees,
                                                                $minSalary,
                                                                $maxSalary,
                                                                $numberLocations,
                                                                $minZipcode,
                                                                $maxZipcode);
                                          
//各フォーマットに変換                               
if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="result.md"');
    foreach ($users as $user) {
        echo $user->toMarkdown();
    }

} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="result.json"');
    $usersArray = array_map(fn($user) => $user->toArray(), $users);
    echo json_encode($usersArray);

} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="result.txt"');
    foreach ($users as $user) {
        echo $user->toString();
    }

} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
    include "toChange/toHtml.php";
}
?>