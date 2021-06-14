<?php
require_once("config.php");
?>

<?php
//condition to all post requests
 if (isset($_POST)){
    switch ($_POST['state']){
        case "registration":
             //registration process starts here
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $phonenumber = $_POST['phonenumber'];
                $password = ($_POST['password']);
            
                $sql = "INSERT INTO tbl_students (firstname, lastname, email, phonenumber, password) VALUES (?,?,?,?,?)";
                $stmtinsert = $conn->prepare($sql);
                $result = $stmtinsert->execute([$firstname,$lastname,$email,$phonenumber,$password]);
                    if ($result){ //is true
                        echo "Registration Successful";
                    }
                    else{
                        echo "There were errors connecting to the database";
                    }
                  
                break;

        case "login":
            //login process
       $email = $_POST['email'];
       $password = $_POST['password'];
       $sql = "SELECT * FROM tbl_students where email = ? and password = ? LIMIT 1";
       $stmtselect = $conn->prepare($sql);
       $result = $stmtselect->execute([$email, $password]); 
          if ($result){ 
               $user = $stmtselect->fetch(PDO::FETCH_ASSOC);
               if ($stmtselect->rowCount() > 0 ){
                   echo "1";
               }else{
                   echo "No user";
               }
           }
           else{
            echo "There were errors connecting to the database";
           }
          
       break;
    }
}
else{
    echo"no data";
    }  
?>


