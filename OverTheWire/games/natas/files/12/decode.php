<?php 

print "Start\n";

$defaultdata = array( "showpassword"=>"no", "bgcolor"=>"#ffffff");

function xor_encrypt($in) {
    $key = '<censored>';
    $text = $in;
    $outText = '';

    // Iterate through each character
    for($i=0;$i<strlen($text);$i++) {
    $outText .= $text[$i] ^ $key[$i % strlen($key)];
    }

    return $outText;
}

function loadData($def) {
    $cookie="R0EWBhwYAgQXTUsMFwpRVVAcAU0eT0cMFAwdCQtMHllHTRUJFAMCWB4e";
    $mydata = $def;
    $tempdata = json_decode(xor_encrypt(base64_decode($cookie)), true);
    if(is_array($tempdata) && array_key_exists("showpassword", $tempdata) && array_key_exists("bgcolor", $tempdata)) {
        if (preg_match('/^#(?:[a-f\d]{6})$/i', $tempdata['bgcolor'])) {
        $mydata['showpassword'] = $tempdata['showpassword'];
        $mydata['bgcolor'] = $tempdata['bgcolor'];
        }
    }
    return $mydata;
}

function encodeArray($arr) {
    return base64_encode(xor_encrypt(json_encode($arr)));
}

function saveData($d) {
    print "data=" . base64_encode(xor_encrypt(json_encode($d)));
}

#$arr = array("showpassword"=>"yes", "bgcolor"=>"#ffffff");
#var_dump(encodeArray($arr));


$data = loadData($defaultdata);
print "data:";
var_dump($data);

$bgcolor = "#ffffff";
if (preg_match('/^#(?:[a-f\d]{6})$/i', $bgcolor)) {
    print "matches\n";
    $data['bgcolor'] = $bgcolor;
}

$data = array( "showpassword"=>"yes", "bgcolor"=>"#ffffff");
saveData($data);




?>
