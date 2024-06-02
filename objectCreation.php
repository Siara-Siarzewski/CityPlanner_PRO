<?php
$host = "localhost";
$user = "root";
$password = "";
$base = "cityplanner_pro";

$do_bazy = mysqli_connect($host, $user, $password, $base);

class building {
    public $id;
    public $name;
    public $type;
    public $cost;
    public $valueOfEffect;
    public $description;
    public $buildTime;
    public $waterUsage;
    public $electricityUsage;

    public function __construct($id, $name, $type, $cost, $valueOfEffect, $description, $buildTime, $waterUsage,  $electricityUsage) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->cost = $cost;
        $this->valueOfEffect = $valueOfEffect;
        $this->description = $description;
        $this->buildTime = $buildTime;
        $this->waterUsage = $waterUsage;
        $this->electricityUsage = $electricityUsage;
    }
}

$q1 = "SELECT * FROM buildings";

$select = mysqli_query($do_bazy, $q1);

while ($row = mysqli_fetch_row($select)) {
    ${$row[1]} = new building($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
};
?>