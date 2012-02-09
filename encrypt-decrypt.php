<?php
    /*
     * Chandler Hoisington
     * February 9, 2012
     * Command example:
     * php encrypt-decrypt.php encrypt 100002205361733 1435530480
     * php encrypt-decrypt.php decrypt WZP4PQ+Z/LeNHCDygr5mTXe8C1UHfm1ahK/DBylKCQo=
     */

    $SECRET_KEY = 'YOUR SECRET KEY';
    $i = 0;

    //Probably could do this better, I will try and fix later
    if (sizeof($argv) >= 3) {
        foreach($argv as $value) {

            if($i >= 2 && (strtolower($argv[1]) == "encrypt" )) {
                $i++;
                echo "Creating base64, mcrypted values\n";
                $encrypted_i = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($SECRET_KEY), $value, MCRYPT_MODE_CBC, md5(md5($SECRET_KEY))));
                echo "Value " . $i . " " . $encrypted_i . "\n";

            } else if($i >= 2 && (strtolower($argv[1]) == "decrypt")) {
                $i++;
                echo "Decrypting base64, mcrypted values\n";
                $decrypted_i = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($SECRET_KEY), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($SECRET_KEY))), "\0");
                echo "Value " . $i . " " . $decrypted_i . "\n";

            } else if ($i <= 2) {
                $i++;
                continue;

            } else {
                $i++;
                echo "First command line argument must be \"encrypt\" or \"decrypt\" followed by the values.\n";
            }

        }

    } else {
        echo "First command line argument must be \"encrypt\" or \"decrypt\" followed by the values.\n";
    }

?>

