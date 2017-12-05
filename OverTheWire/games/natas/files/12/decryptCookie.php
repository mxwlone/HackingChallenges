<?php 

$defaultdata = array( "showpassword"=>"no", "bgcolor"=>"#ffffff");

function xor_encrypt($in, $key) {
    $text = $in;
    $outText = '';

    // Iterate through each character
    for($i=0;$i<strlen($text);$i++) {
    $outText .= $text[$i] ^ $key[$i % strlen($key)];
    }

    return $outText;
}

function loadData($def) {
    $cookie="ClVLIh4ASCsCBE8lAxMacFMZV2hdVVotEhhUJQNVAmhSE1wuFRNcaAw%3D";
    $mydata = $def;
    $tempdata = json_decode(xor_encrypt(base64_decode($cookie)), true);
    var_dump($tempdata);
    if(is_array($tempdata) && array_key_exists("showpassword", $tempdata) && array_key_exists("bgcolor", $tempdata)) {
        if (preg_match('/^#(?:[a-f\d]{6})$/i', $tempdata['bgcolor'])) {
        $mydata['showpassword'] = $tempdata['showpassword'];
        $mydata['bgcolor'] = $tempdata['bgcolor'];
        }
    }
    return $mydata;
}

//$data = loadData($defaultdata);

// {"showpassword":"no","bgcolor":"#ffffff"}

print "json_encode(\$defaultdata)\n";
printf(json_encode($defaultdata) . "\n");

print "xor_encrypt(json_encode(\$defaultdata))\n";
printf(xor_encrypt(json_encode($defaultdata)) . "\n");

print "base64_encode(xor_encrypt(json_encode(\$defaultdata)))\n";
printf(base64_encode(xor_encrypt(json_encode($defaultdata))) . "\n");

?>
