<?php
session_start();
include "connect.php";
$user_id = null;
if(isset($_POST['loginbtn'])){
    $user = $_POST['username'];
$pass = $_POST['password'];
$_SESSION["user"] = $user;
// Przygotowanie i wykonanie zapytania SQL
$sql = "SELECT password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($hashed_password);

$stmt->fetch();



if (password_verify($pass, $hashed_password)) {
    echo "<script>alert('Zalogowano');</script>";
} else {
    echo "<script>window.location.href = 'http://localhost/CityPlannerPro/logowanie_rejestracja.php'; alert('Błędne hasło lub nazwa');</script>";
}
$stmt->close();


}
?>

<?php
// $stmt->close();
// $conn->close();
if(isset($_POST['registerbtn'])){
    $user = $_POST['username'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Sprawdzenie, czy nazwa użytkownika już istnieje
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Nazwa użytkownika już istnieje
    echo "Nazwa użytkownika jest już zajęta. Wybierz inną nazwę.";
    $stmt->close();
    $conn->close();
    exit();
}

// Sprawdzenie, czy email już istnieje
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Email już istnieje
    echo "Email jest już zajęty. Wybierz inny email.";
    $stmt->close();
    $conn->close();
    exit();
}


$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $user, $email, $pass);

if ($stmt->execute()) {
    echo "Rejestracja zakończona sukcesem";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();

$sqlid = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sqlid);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_id); 
$stmt->fetch();

$stmt->close();


}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityPlanner Pro</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/aplikacja.css">
    <link rel="shortcut icon" href="./IMG/icon.png">
    
</head>
<body>
    <div class="container">
        <div class="banner">
            <p id="saldo">
            
            </p>
            
            <button id="showstats">Statystyki</button>
            <a href="http://localhost/CityPlannerPro/logowanie_rejestracja.php" id="wlg">
                <button >Wyloguj się</button>
            </a>
            
            <p id="day"></p>
            <!-- <script>
                let day = 1;

                let intervalId = setInterval(function() {
                    // Pobierz element do wyświetlania danych
                    let dayElement = document.getElementById("day");
                    
                    // Ustaw tekst w elemencie na aktualną wartość licznika
                    dayElement.textContent = "Dni: " + day;
                    
                    day++; // Zwiększ wartość licznika o 1
                }, 10000); // Wykonuj co 10 sekund (10000 milisekund)
            </script> -->
        </div>
        
            <div class="overlay" id="overlay">
                
                    <button name="btn1" value="1" id="btn1" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz1"></button>
                    <button name="btn2" value="2" id="btn2" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz2"></button>
                    <button name="btn3" value="3" id="btn3" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz3"></button>
                    <button name="btn4" value="4" id="btn4" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz4"></button>
                    <button name="btn5" value="5" id="btn5" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz5"></button>
                    <button name="btn6" value="6" id="btn6" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz6"></button>
                    <button name="btn7" value="7" id="btn7" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz7"></button>
                    <button name="btn8" value="8" id="btn8" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz8"></button>
                    <button name="btn9" value="9" id="btn9" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz9"></button>
                    <button name="btn10" value="10" id="btn10" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz10"></button>
                    <button name="btn11" value="11" id="btn11" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz11"></button>
                    <button name="btn12" value="12" id="btn12" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz12"></button>
                    <button name="btn13" value="13" id="btn13" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz13"></button>
                    <button name="btn14" value="14" id="btn14" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz14"></button>
                    <button name="btn15" value="15" id="btn15" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz15"></button>
                    <button name="btn16" value="16" id="btn16" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz16"></button>
                    <button name="btn17" value="17" id="btn17" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz17"></button>
                    <button name="btn18" value="18" id="btn18" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz18"></button>
                    <button name="btn19" value="19" id="btn19" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz19"></button>
                    <button name="btn20" value="20" id="btn20" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz20"></button>
                    <button name="btn21" value="21" id="btn21" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz21"></button>
                    <button name="btn22" value="22" id="btn22" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz22"></button>
                    <button name="btn23" value="23" id="btn23" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz23"></button>
                    <button name="btn24" value="24" id="btn24" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz24"></button>
                    <button name="btn25" value="25" id="btn25" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz25"></button>
                    <button name="btn26" value="26" id="btn26" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz26"></button>
                    <button name="btn27" value="27" id="btn27" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz27"></button>
                    <button name="btn28" value="28" id="btn28" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz28"></button>
                    <button name="btn29" value="29" id="btn29" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz29"></button>
                    <button name="btn30" value="30" id="btn30" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz30"></button>
                    <button name="btn31" value="31" id="btn31" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz31"></button>
                    <button name="btn32" value="32" id="btn32" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz32"></button>
                    <button name="btn33" value="33" id="btn33" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz33"></button>
                    <button name="btn34" value="34" id="btn34" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz34"></button>
                    <button name="btn35" value="35" id="btn35" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz35"></button>
                    <button name="btn36" value="36" id="btn36" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz36"></button>
                    <button name="btn37" value="37" id="btn37" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz37"></button>
                    <button name="btn38" value="38" id="btn38" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz38"></button>
                    <button name="btn39" value="39" id="btn39" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz39"></button>
                    <button name="btn40" value="40" id="btn40" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz40"></button>
                    <button name="btn41" value="41" id="btn41" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz41"></button>
                    <button name="btn42" value="42" id="btn42" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz42"></button>
                    <button name="btn43" value="43" id="btn43" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz43"></button>
                    <button name="btn44" value="44" id="btn44" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz44"></button>
                    <button name="btn45" value="45" id="btn45" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz45"></button>
                    <button name="btn46" value="46" id="btn46" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz46"></button>
                    <button name="btn47" value="47" id="btn47" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz47"></button>
                    <button name="btn48" value="48" id="btn48" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz48"></button>
                    <button name="btn49" value="49" id="btn49" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz49"></button>
                    <button name="btn50" value="50" id="btn50" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz50"></button>
                    <button name="btn51" value="51" id="btn51" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz51"></button>
                    <button name="btn52" value="52" id="btn52" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz52"></button>
                    <button name="btn53" value="53" id="btn53" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz53"></button>
                    <button name="btn54" value="54" id="btn54" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz54"></button>
                    <button name="btn55" value="55" id="btn55" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz55"></button>
                    <button name="btn56" value="56" id="btn56" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz56"></button>
                    <button name="btn57" value="57" id="btn57" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz57"></button>
                    <button name="btn58" value="58" id="btn58" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz58"></button>
                    <button name="btn59" value="59" id="btn59" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz59"></button>
                    <button name="btn60" value="60" id="btn60" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz60"></button>
                    <button name="btn61" value="61" id="btn61" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz61"></button>
                    <button name="btn62" value="62" id="btn62" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz62"></button>
                    <button name="btn63" value="63" id="btn63" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz63"></button>
                    <button name="btn64" value="64" id="btn64" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz64"></button>
                    <button name="btn65" value="65" id="btn65" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz65"></button>
                    <button name="btn66" value="66" id="btn66" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz66"></button>
                    <button name="btn67" value="67" id="btn67" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz67"></button>
                    <button name="btn68" value="68" id="btn68" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz68"></button>
                    <button name="btn69" value="69" id="btn69" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz69"></button>
                    <button name="btn70" value="70" id="btn70" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz70"></button>
                    <button name="btn71" value="71" id="btn71" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz71"></button>
                    <button name="btn72" value="72" id="btn72" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz72"></button>
                    <button name="btn73" value="73" id="btn73" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz73"></button>
                    <button name="btn74" value="74" id="btn74" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz74"></button>
                    <button name="btn75" value="75" id="btn75" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz75"></button>
                    <button name="btn76" value="76" id="btn76" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz76"></button>
                    <button name="btn77" value="77" id="btn77" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz77"></button>
                    <button name="btn78" value="78" id="btn78" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz78"></button>
                    <button name="btn79" value="79" id="btn79" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz79"></button>
                    <button name="btn80" value="80" id="btn80" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz80"></button>
                    <button name="btn81" value="81" id="btn81" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz81"></button>
                    <button name="btn82" value="82" id="btn82" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz82"></button>
                    <button name="btn83" value="83" id="btn83" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz83"></button>
                    <button name="btn84" value="84" id="btn84" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz84"></button>
                    <button name="btn85" value="85" id="btn85" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz85"></button>
                    <button name="btn86" value="86" id="btn86" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz86"></button>
                    <button name="btn87" value="87" id="btn87" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz87"></button>
                    <button name="btn88" value="88" id="btn88" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz88"></button>
                    <button name="btn89" value="89" id="btn89" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz89"></button>
                    <button name="btn90" value="90" id="btn90" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz90"></button>
                    <button name="btn91" value="91" id="btn91" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz91"></button>
                    <button name="btn92" value="92" id="btn92" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz92"></button>
                    <button name="btn93" value="93" id="btn93" type="submit"><img src="./IMG/plus.png" class="implus" id="ibraz93"></button>
                
                
            </div>
        
        <div id="budowa" class="modal">
            <span class="close">&times;</span>
            <?php include "objectCreation.php"; ?> 
            <center>
                
            <table id="tabelabudynki">
                <tr>
                    <th>Wybierz</th>
                    <th>Ikona</th>
                    <th>Nazwa</th>
                    <th>Typ</th>
                    <th>Koszt</th>
                    <th>Max ludzi</th>
                    <th>Czas budowy</th>
                    <th>Zurzycie wody</th>
                    <th>Zurzycie energi</th>
                </tr>
                <tr>
                    <td><button id="budynek1" value="1" type="submit" name="budynek1">Wybierz</buttom></td>
                    <td><img src="./IMG/house.png" id="wyborbud" alt="dom"></td>
                    <td><?php echo $house->name; ?></td>
                    <td><?php echo $house->type; ?></td>
                    <td><?php echo $house->cost; ?></td>
                    <td><?php echo $house->valueOfEffect; ?></td>
                    <td><?php echo $house->buildTime; ?></td>
                    <td><?php echo $house->waterUsage; ?></td>
                    <td><?php echo $house->electricityUsage; ?></td>
                    
                </tr>
                <tr>
                    <td><button id="budynek2" value="2" type="submit" name="budynek2">Wybierz</buttom></td>
                    <td><img src="./IMG/blok.png" id="wyborbud" alt="blok"></td>
                    <td><?php echo $flats_block->name; ?></td>
                    <td><?php echo $flats_block->type; ?></td>
                    <td><?php echo $flats_block->cost; ?></td>
                    <td><?php echo $flats_block->valueOfEffect; ?></td>
                    <td><?php echo $flats_block->buildTime; ?></td>
                    <td><?php echo $flats_block->waterUsage; ?></td>
                    <td><?php echo $flats_block->electricityUsage; ?></td>
                    
                </tr>
                <tr>
                    <td><button id="budynek3" value="3" type="submit" name="budynek3">Wybierz</buttom></td>
                    <td><img src="./IMG/hospital.png" id="wyborbud" alt="hospital"></td>
                    <td><?php echo $hospital->name; ?></td>
                    <td><?php echo $hospital->type; ?></td>
                    <td><?php echo $hospital->cost; ?></td>
                    <td><?php echo $hospital->valueOfEffect; ?></td>
                    <td><?php echo $hospital->buildTime; ?></td>
                    <td><?php echo $hospital->waterUsage; ?></td>
                    <td><?php echo $hospital->electricityUsage; ?></td>
                    
                </tr>
                <tr>
                    <td><button id="budynek4" value="4" type="submit" name="budynek4">Wybierz</buttom></td>
                    <td><img src="./IMG/bank.png" id="wyborbud" alt="bank"></td>
                    <td><?php echo $bank->name; ?></td>
                    <td><?php echo $bank->type; ?></td>
                    <td><?php echo $bank->cost; ?></td>
                    <td><?php echo $bank->valueOfEffect; ?></td>
                    <td><?php echo $bank->buildTime; ?></td>
                    <td><?php echo $bank->waterUsage; ?></td>
                    <td><?php echo $bank->electricityUsage; ?></td>
                    
                </tr>
                <tr>
                    <td><button id="budynek5" value="5" type="submit" name="budynek5">Wybierz</buttom></td>
                    <td><img src="./IMG/factory.png" id="wyborbud" alt="factory"></td>
                    <td><?php echo $factory->name; ?></td>
                    <td><?php echo $factory->type; ?></td>
                    <td><?php echo $factory->cost; ?></td>
                    <td><?php echo $factory->valueOfEffect; ?></td>
                    <td><?php echo $factory->buildTime; ?></td>
                    <td><?php echo $factory->waterUsage; ?></td>
                    <td><?php echo $factory->electricityUsage; ?></td>
                    
                </tr>
                <tr>
                    <td><button id="budynek6" value="6" type="submit" name="budynek6">Wybierz</buttom></td>
                    <td><img src="./IMG/electro.png" id="wyborbud" alt="power station"></td>
                    <td><?php echo $power_station->name; ?></td>
                    <td><?php echo $power_station->type; ?></td>
                    <td><?php echo $power_station->cost; ?></td>
                    <td><?php echo $power_station->valueOfEffect; ?></td>
                    <td><?php echo $power_station->buildTime; ?></td>
                    <td><?php echo $power_station->waterUsage; ?></td>
                    <td><?php echo $power_station->electricityUsage; ?></td>
                    
                </tr>
                <tr>
                    <td><button id="budynek7" value="7" type="submit" name="budynek7">Wybierz</buttom></td>
                    <td><img src="./IMG/water.png" id="wyborbud" alt="water station"></td>
                    <td><?php echo $water_tower->name; ?></td>
                    <td><?php echo $water_tower->type; ?></td>
                    <td><?php echo $water_tower->cost; ?></td>
                    <td><?php echo $water_tower->valueOfEffect; ?></td>
                    <td><?php echo $water_tower->buildTime; ?></td>
                    <td><?php echo $water_tower->waterUsage; ?></td>
                    <td><?php echo $water_tower->electricityUsage; ?></td>
                    
                </tr>
                <tr>
                    <td><button id="budynek8" value="8" type="submit" name="budynek8">Wybierz</buttom></td>
                    <td><img src="./IMG/park.png" id="wyborbud" alt="park"></td>
                    <td><?php echo $park->name; ?></td>
                    <td><?php echo $park->type; ?></td>
                    <td><?php echo $park->cost; ?></td>
                    <td><?php echo $park->valueOfEffect; ?></td>
                    <td><?php echo $park->buildTime; ?></td>
                    <td><?php echo $park->waterUsage; ?></td>
                    <td><?php echo $park->electricityUsage; ?></td>
                    
                </tr>
            

            
            </table>
            </center>
        </div>
            
        <div id="statystyki" class="modal">
            <span class="close">&times;</span>
            <p id="people"></p>
            <p id="energy"></p>
            <p id="water"></p>
            <p id="Chart">
            <canvas id="populationChart" ></canvas>
            </p>
            <p id="Chart2">
            <canvas id="resourcesChart"></canvas>
            </p>
            
               
            
        </div>
        
            
        <script src="js/script_ap.js"></script> 
    </div>
</body>
</html>
<?php
$location_id = null;
$building_id = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['value1']) && isset($_POST['value2'])) {
        // Odczytanie wartości z POST
        $location_id = $_POST['value1'];
        $building_id = $_POST['value2'];

        // Przygotowanie zapytania SQL
        $sqllocation = "INSERT INTO locations (id, user_id, building_id) VALUES (?, ?, ?)";

        // Przygotowanie i wykonanie zapytania przy użyciu prepared statements
        $stmt = $conn->prepare($sqllocation);
        
        // Sprawdzenie, czy zapytanie zostało poprawnie przygotowane
        if ($stmt) {
            // Powiązanie parametrów zapytania z wartościami
            $stmt->bind_param("iii", $location_id, $user_id, $building_id);

            // Wykonanie zapytania
            $stmt->execute();

        }
    }
}



$conn->close();
?>


