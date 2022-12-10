<?php
function bID(){
    $bank= abs( crc32( uniqid() ) );
    return $bank;
}
