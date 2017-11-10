<?php

echo <<<HTML
<html>
<head>
<meta name="viewport" content="width=device-width" />
<title>WIFI Controlled LED</title>
</head>

       <body>

 <center><b><font size = '20'>Select Level:</b>
         <form method="get" action="index.php">
                 <input type="submit" style = "font-size: 16 pt" value="LEVEL I" name="level_1">
                 <input type="submit" style = "font-size: 16 pt" value="LEVEL II" name="level_2">
                 <input type="submit" style = "font-size: 16 pt" value="LEVEL III" name="level_3">
         </form></font></center>
HTML;




if(isset($_GET['level_1']))
{

echo <<<HTML
<center><b><font size = '20'>Control LED:</b>
<form method="get" action="index.php">
                         <input type="submit" style = "font-size: 16 pt" value="OFF" name="off">
                 <input type="submit" style = "font-size: 16 pt" value="ON" name="on">
                 <input type="submit" style = "font-size: 16 pt" value="BLINK" name="blink">
         </form></font></center>
HTML;

}

$random_string = generateRandomString(4);

shell_exec("/usr/local/bin/gpio -g mode 17 out");
shell_exec("/usr/local/bin/gpio -g mode 27 out");
shell_exec("/usr/local/bin/gpio -g mode 22 out");
shell_exec("/usr/local/bin/gpio -g mode 18 out");

if(isset($_GET['off']))
{
        echo "LED is off";
        shell_exec("/usr/local/bin/gpio -g write 17 1");
        shell_exec("/usr/local/bin/gpio -g write 27 0");
                shell_exec("/usr/local/bin/gpio -g write 22 0");
                shell_exec("/usr/local/bin/gpio -g write 18 0");

}
else if(isset($_GET['on']))
{
        echo "LED is on";
        shell_exec("/usr/local/bin/gpio -g write 17 0");
        shell_exec("/usr/local/bin/gpio -g write 27 1");
}
else if(isset($_GET['blink']))
//      shell_exec("/usr/local/bin/gpio -g mode 17 out");
//shell_exec("/usr/local/bin/gpio -g mode 27 out");
{
        echo "LED is blinking";
        for($x=0;$x<=6;$x++)
        {
                shell_exec("/usr/local/bin/gpio -g write 17 0");
                shell_exec("/usr/local/bin/gpio -g write 27 1");
                sleep(1);
                shell_exec("/usr/local/bin/gpio -g write 17 1");
                shell_exec("/usr/local/bin/gpio -g write 27 0");
                sleep(1);
        }
}


function noOfLedSelector( $no = 4 ) {
        if($no==4){
                shell_exec("/usr/local/bin/gpio -g mode 17 out");
                shell_exec("/usr/local/bin/gpio -g mode 27 out");
                shell_exec("/usr/local/bin/gpio -g mode 22 out");
                shell_exec("/usr/local/bin/gpio -g mode 18 out");

        }
        else if($no==6){

        }
        else if($no==8){

        }
}


function generateRandomString($length = 4) {
            $characters = '0123456789';
                $charactersLength = strlen($characters);
                $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                                        }
    return $randomString;
}


?>
