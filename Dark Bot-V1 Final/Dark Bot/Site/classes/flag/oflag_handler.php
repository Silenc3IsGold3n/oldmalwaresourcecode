<?php
               $c = curl_init();
        curl_setopt($c, CURLOPT_URL, base64_decode('aHR0cDovL2xpY2VuY2UuZGVkYmFzZS5jb20vdmVyaWZ5Lz9rZXk9').'a7e891ad700fe6b6786c428aabc0ef4f');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_TIMEOUT, 20);
        $re = curl_exec($c);

        if($re == 'error') die('Unlicensed version of Exonet');
		