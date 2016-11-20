<?php

$encodedSecret = "3d3d516343746d4d6d6c315669563362";

function decode($encodedSecret) {
    return base64_decode(strrev(hex2bin($encodedSecret)));
}

print decode($encodedSecret) . "\n";

?>
