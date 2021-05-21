<?php
if(isset($_POST['signin'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $host='localhost';
    $user='mohamed';
    $password='';
    $dbname='form';
    
    //set DSN (data source name)
    $dsn='mysql:host='.$host. ';dbname='.$dbname;
     
    //creat a PDO instance
    $pdo= new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = 'SELECT *FROM form WHERE email = :email && password = :password';
    $stmt = $pdo->prepare($sql);
    $stmt ->execute(['email'=>$email, 'password'=> $password]);
    $forms = $stmt->fetchAll();
    
    
     foreach($forms as $form){
         if($form == $_POST['email'] && $form== $_POST['password']){
             if(isset($_POST['keep'])){
                 setcookie('email', $email, time()+60*60*7);
                 session_start();
                 $_SESSION['email']=$email;
                 header('location:tutorial-32\Nuno Theme Starter Files\Nuno Theme Starter Files/index.html');
             }
         else{
            $errors['email'] = 'Email must be a valid email address';
             header('location:form.html');
         }
        }
    }else{
    header('location:form.html');
   }
}