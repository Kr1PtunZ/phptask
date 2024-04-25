<?php

include("config/DataBase.php");
include("API/Contacts.php");
$db = new DataBase();
$connection =  $db->getConnection();
$request_method=$_SERVER["REQUEST_METHOD"];

$contacts = new Contacts();

switch($request_method)
{
    case 'GET':
        // Retrive Products
        if(!empty($_GET["phone"]))
        {
            $phone=intval($_GET["phone"]);
            $contacts->getContactByPhone($phone);
        }
        else
        {
            $contacts->getContacts();
        }

        break;
    case 'POST':
        $contacts->insertContact();
        break;

    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}