<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/SQL.php");

class Admission {
    private $database;

    public function __construct(&$database) {
        $this->database = $database;
    }

    public function register(
        $ssn, $type, $doctor, $room, $time, $fName, $lName, $mName,
        $birthday, $gender, $disabled, $address, $zipCode, $email,
        $phone, $contactLName, $contactFName, $contactAddress,
        $contactPhone, $trustedLName, $trustedFName, $trustedAddress,
        $trustedPhone, $insuranceFund, $isPolicyHolder, $mutualName, $mutualNum
    ) {
        $query =
        'INSERT INTO preadmission (
            ssn,type,doctor,room,time,fName,lName,mName,birthday,gender,
            disabled,address,zipCode,email,phone,contactLName,contactFName,
            contactAddress,contactPhone,trustedLName,trustedFName,trustedAddress,
            trustedPhone,insuranceFund,isPolicyHolder,mutualName,mutualNum
        ) VALUES ("'.$ssn.'", "'.$type.'", "'.$doctor.'", "'.$room.'", "'.$time
        .'", "'.$fName.'", "'.$lName.'", "'.$mName.'", "'.$birthday.'", "'.$gender.'", "'
        .$disabled.'", "'.$address.'", "'.$zipCode.'", "'.$email.'", "'.$phone.'", "'
        .$contactLName.'", "'.$contactFName.'", "'.$contactAddress.'", "'
        .$contactPhone.'", "'.$trustedLName.'", "'.$trustedFName.'", "'
        .$trustedAddress.'", "'.$trustedPhone.'", "'.$insuranceFund.'", "'
        .$isPolicyHolder.'", "'.$mutualName.'", "'.$mutualNum.'");';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (__FUNCTION__.':'.$error->getMessage());
        }
        return (null);
    }


    public function list() {
        $query =
        'select * from preadmission;';

        try {
            $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (__FUNCTION__.':'.$error->getMessage());
        }
        return (null);
    }
}
?>
