<?php
class  Contacts
{
    public function getContacts()
    {
        $conn = new DataBase();
        $conn = $conn->getConnection();
        $query="SELECT * FROM contacts";
        $response=array();
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result))
        {

            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $srcId = $row['source_id'];

            $items = ['name'=>$name, 'email'=>$email, 'phone'=>$phone];
            $response = ['source_id'=>$srcId,'items:'=>[$items]];
            header('Content-Type: application/json');
            echo json_encode($response);
        }

    }
    public function getContactByPhone($phone)
    {
        $conn = new DataBase();
        $conn = $conn->getConnection();

        $query = "SELECT * FROM contacts WHERE phone LIKE $phone";
        $response=array();
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result))
        {

            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $srcId = $row['source_id'];

            $items = ['name'=>$name, 'email'=>$email, 'phone'=>$phone];
            $response = ['source_id'=>$srcId,'items:'=>[$items]];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
    public function insertContact()
    {
            $conn = new DataBase();
            $conn = $conn->getConnection();

            $data = json_decode(file_get_contents('php://input'), true);
            $srcId = $data["source_id"];
            $name=$data["name"];
            $phone=$data["phone"];
            $phone = substr($phone, 2);
            $email=$data["email"];
            echo $query="INSERT INTO contacts SET source_id = $srcId, 'name' = $name, phone = $phone, email = $email";
            if(mysqli_query($conn, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' =>'Success.'
                );
            }
            else
            {
                $response=array(
                    'status' => 0,
                    'status_message' =>'Error.'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
    }
}