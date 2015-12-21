
<?php
/* initialises the used variables:
 * $name etc for the inserts of the fields (Aufgabenpunkt mind 10 Eingabefelder)
 * $nameErr for the error of not writing into the name field (Aufgabenpunkt Pflichtfelder)
 * $emailErr for the error of not writing into the name field (Aufgabenpunkt Pflichtfelder)
 * $okMessage to confirm the sending of the data, the form with its inserts is shown further (Aufgabenpunkt Anzeigeseite)
 * $insertName is set to true if the name field is complete  (Aufgabenpunkt Pflichtfelder)
 * $insertEmail is set to true if the email field is complete  (Aufgabenpunkt Pflichtfelder)
 * $invalidZipcode checks that only numbers are inserteded for zipcode (Aufgabenpunkt Datenprüfung)
 * $invalidBirthdate checks the right shape of the birth date (Aufgabenpunkt Datenprüfung)
 * $invalidEmail checks the right shape of the email address (Aufgabenpunkt Datenprüfung)
 * $invalidPhone checks that only numbers are inserted for phone (Aufgabenpunkt Datenprüfung)
 */
$name = $prename = $street = $housenumber = $zipcode = $city = $phone = $email = $birthdate = $comment = "";
$nameErr = $emailErr = $okMessage = " ";
$invalidZipcode = $invalidPhone = $invalidBirthdate = $invalidEmail = " ";

$insertName = $insertEmail = false;
$validZipcode = $validPhone = $validBirthdate = $validEmail = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $prename = test_input($_POST["prename"]);
    $street = test_input($_POST["street"]);
    $housenumber = test_input($_POST["housenumber"]);
    $zipcode = test_input($_POST["zipcode"]);
    $city = test_input($_POST["city"]);
    $phone = test_input($_POST["phone"]);
    $email = test_input($_POST["email"]);
    $birthdate = test_input($_POST["birthdate"]);
    $comment = test_input($_POST["comment"]);

    //makes sure that the required fields name and email are complete
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required! ";
        } else {
            $insertName = true;
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required! ";
        } else {
            $insertEmail = true;
        }
        //makes sure that the inserted data is valid
        if (preg_match('/(\D)/', $_POST["zipcode"])) { // input includes letters 
            $invalidZipcode = "Please make sure that the zipcode includes only numbers from 0-9!";
        } else {
            $validZipcode = true; //valid zipcode
        }

        if (preg_match('/(\D)/', $_POST["phone"])) {
            $invalidPhone = "Please make sure that the phone number includes only numbers from 0-9! ";
        } else {
            $validPhone = true;
        }

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $invalidEmail = "Please enter your email in a valid shape! ";
        } else {
            $validEmail = true;
        }

        if (!preg_match('/([0-9][0-9]-[0-1][0-9]-[0-9]{4})/', $_POST["birthdate"])) {
            $invalidBirthdate = "Please enter your birth date like Day-Month-Year as xx-yy-zzzz! ";
        } else {
            $validBirthdate = true;
        }

        //if every input is correct the data is sent
        if ($insertName && $insertEmail && $validZipcode && $validPhone && $validEmail && $validBirthdate) {
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $zipcode = test_input($_POST["zipcode"]);
            $phone = test_input($_POST["phone"]);
            $email = test_input($_POST["email"]);
            $birthdate = test_input($_POST["birthdate"]);
            $okMessage = "Data sent!!  ";
        }
    }
}

// auxiliary method 
function test_input($data) {
    $data = trim($data); //removes whitespace
    $data = stripslashes($data); // removes slashes
    $data = htmlspecialchars($data); //removes special characters
    return $data;
}
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- scales for the device's width-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- http://getbootstrap.com/getting-started/ -->

        <title>My form-ESA1</title>
        <!--Framework Twitter Bootstrap-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>

        
        <!-- form.php/%22%3E%3Cscript%3Ealert('hacked')%3C/script%3E -->
        <!-- <script>alert('hacked')</script> -->
        <!-- http://php.net/manual/de/function.htmlspecialchars.php -->

        <!-- <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"> -->

        <div class="container">
            <h2 class="bg-primary" >Please insert your contact dates!!</h2>
            <div class="input-group input-group-lg">  <!--bootstrap requires div elements--> <!--class= is needed for CSS-->

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  <!-- htmlspecialchars verhindert javascript tags -->
                    * Name: <input class="form-control" placeholder="Name" type="text" name="name" value="<?php echo $name; ?>"> <?php echo $nameErr ?> <br/>
                    Prename: <input class="form-control" type="text" name="prename" value="<?php echo $prename; ?>"> <br/>
                    Street: <input class="form-control" type="text" name="street" value="<?php echo $street; ?>"> <br/>
                    Housenumber: <input class="form-control" type="text" name="housenumber" value="<?php echo $housenumber; ?>"> <br/>
                    Zipcode: <input class="form-control" type="text" name="zipcode" value="<?php echo $zipcode; ?>"> <?php echo $invalidZipcode ?> <br/>
                    City: <input class="form-control" type="text" name="city" value="<?php echo $city; ?>"> <br/>
                    Phone: <input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>"> <?php echo $invalidPhone; ?> <br/>
                    * E-mail: <input class="form-control" placeholder="Email" type="text" name="email" value="<?php echo $email; ?>"> <?php echo $emailErr ?> <?php echo $invalidEmail ?> <br/>  
                    Birthday: <input class="form-control" type="text" name="birthdate" value="<?php echo $birthdate; ?>"> <?php echo $invalidBirthdate ?> <br/>
                    Comment: <textarea class="form-control" name="comment" rows="5" cols="40"></textarea> <br/><br/><br/>
                    <input type="submit" value="send" /><?php echo $okMessage; ?>
                </form>
            </div>
        </div>
        <br/>


    </body>
</html>
