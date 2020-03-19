<?php
// connect to aws mysql server
$db = new PDO('mysql:host=172.31.22.43;dbname=Mitchell_T1100775','Mitchell_T1100775', 'UJpCKJUeW6');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

