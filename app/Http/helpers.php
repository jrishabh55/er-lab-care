<?php
function generateLicence(...$data)
{
    $data = count($data) < 1 ? [] : $data;
    return hash('sha256', json_encode($data));
}