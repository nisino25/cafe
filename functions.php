<?php 

  $GLOBALS['connection'] =  mysqli_connect('localhost', 'root', '', 'cafe');
  if(!$GLOBALS['connection']){
    echo '<br>' . '<br>';
    echo 'not connected';
    return;
  };

  function createRow(){
    // makeConnection();

    $query = "SELECT *  FROM contacts";
    $result = mysqli_query($GLOBALS['connection'], $query); 

    if(!$result){
        die('failed sending data. '. mysqli_error($connection));
    };

    $validationFlag = true;
    $validationList = [
        "name"=> true,
        "kana"=> true,
        "tel"=> true,
        "email"=> true,
        "body"=> true,
    ];

    if(isset($_POST['submit'])){
      $username = $_POST['name']; 
      $kana = $_POST['kana']; 
      $tel = $_POST['tel']; 
      $email = $_POST['email']; 
      $body = $_POST['body']; 

      if(!$username){
        $validationList['name'] = '氏名は必須入力です。　１０文字以内でご入力ださい。';
        $validationFlag = false;
      };
      
      if(mb_strlen(strval($username)) > 10){
        $validationList['name'] = '氏名は１０文字以内でご入力ださい。' . mb_strlen($username);
        $validationFlag = false;
      };
      
      
      // kana validation
      if(!$kana){
      $validationList['kana'] = 'フリガナは必須入力です。　１０文字以内でご入力ださい。';
      $validationFlag  = false;
      };
      
      if(mb_strlen($kana) > 10){
      $validationList['kana'] = 'フリガナは１０文字以内でご入力ださい。';
      $validationFlag  = false;
      };

      if($tel){
          $validationList['tel'] = '';
          $str = $tel;
          for($i =0; $i<strlen($tel); $i++){
              if($str[0] == '0' || $str[0] == '1' || $str[0] == '2'|| $str[0] == '3'|| $str[0] == '4'|| $str[0] == '5'|| $str[0] == '6'|| $str[0] == '7'|| $str[0] == '8' || $str[0] == '9'){
              } else{
                  $validationList['tel'] = '電話番号は0-9の数字のみでご入力ください';
                  $validationFlag = false;
              };
              $str = substr($str, 1);
          };
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $validationList['email'] = 'メールアドレスは正しくご入力ください。';
          $validationFlag = false;
      };

      if(strlen($body) == ''){
          $validationList['body'] ='お問い合わせ内容は必須入力です。';
          $validationFlag = false;
      }
        



      if($validationFlag){
        $body  =str_replace("\n", '<br />', $body);
        $_SESSION['name'] = $username; 
        $_SESSION['kana'] = $kana; 
        $_SESSION['tel'] = $tel;
        $_SESSION['email'] = $email; 
        $_SESSION['body'] = $body;


        

        header("Location: ./confirm.php");
        die();
      };
    
    };
  };

  function readTheTable(){
    
    $query = "SELECT *  FROM contacts";
    $result = mysqli_query($GLOBALS['connection'], $query); 

    if(!$result){
        die('failed sending data. '. mysqli_error($GLOBALS['connection']));
    }else{
      return $result;
    }
    
  };

  function kickout(){
    if(!isset($_SERVER['HTTP_REFERER'])){
      header("Location: ./contact.php");
      exit;
    }
  };

  function sendData(){
    if(isset($_POST['submit'])){

      $name = $_SESSION['name'];
      $kana = $_SESSION['kana'] ;
      $tel = $_SESSION['tel'];
      $email = $_SESSION['email'] ;
      $body = $_SESSION['body'];
    
      
    
      $name = mysqli_real_escape_string($GLOBALS['connection'],$name );
      $kana = mysqli_real_escape_string($GLOBALS['connection'],$kana );
      $tel = mysqli_real_escape_string($GLOBALS['connection'],$tel );
      $email = mysqli_real_escape_string($GLOBALS['connection'],$email );
      $body = mysqli_real_escape_string($GLOBALS['connection'],$body );
  
      $query = "INSERT INTO contacts(name,kana,tel,email,body,created_at)";
      $query .= "VALUES ('$name', '$kana', '$tel', '$email', '$body',now() )";
  
      $result = mysqli_query($GLOBALS['connection'], $query); 
  
      if(!$result){
          die('failed sending data. <br>'. mysqli_error($GLOBALS['connection']));
      }else{
        header("Location: ./complete.php");
        die();
      }
    
    }else{
      // echo 'hney';
    };
  };

  function deleteRow(){
    $id = $_GET['id'];
    $query = "DELETE FROM contacts WHERE id = $id";


    $result = mysqli_query($GLOBALS['connection'], $query);

    if(!$result){
      die('failed sending data. '. mysqli_error($GLOBALS['connection']));
    }else{
      header("Location: ./contact.php");
      die();
    }
  };

  function getRow(){
    $id = $_GET['id'];
    $result = mysqli_query($GLOBALS['connection'],"SELECT * FROM contacts WHERE id='" . $id . "'");
    $row= mysqli_fetch_array($result);
    return $row;
  };

  

  function editRow(){
    $id = $_GET['id'];

    $result = mysqli_query($GLOBALS['connection'],"SELECT * FROM contacts WHERE id='" . $id . "'");
    $row= mysqli_fetch_array($result);

    $validationFlag = true;
    $validationList = [
        "name"=> true,
        "kana"=> true,
        "tel"=> true,
        "email"=> true,
        "body"=> true,
    ];

    if(isset($_POST['submit'])){
        $username = $_POST['name']; 
        $kana = $_POST['kana']; 
        $tel = $_POST['tel']; 
        $email = $_POST['email']; 
        $body = $_POST['body']; 
        echo '<br>' . '<br>'  . '<br>';

        if(!$username){
            $validationList['name'] = '氏名は必須入力です。　１０文字以内でご入力ださい。';
            $validationFlag = false;
        };
        
        if(mb_strlen(strval($username)) > 10){
        // if(  preg_match('/^{10,}$/', $username)){}
        $validationList['name'] = '氏名は１０文字以内でご入力ださい。' ;
        $validationFlag = false;
        };
        
        
        // kana validation
        if(!$kana){
        $validationList['kana'] = 'フリガナは必須入力です。　１０文字以内でご入力ださい。';
        $validationFlag  = false;
        };
        
        if(mb_strlen($kana) > 10){
        $validationList['kana'] = 'フリガナは１０文字以内でご入力ださい。';
        $validationFlag  = false;
        };

        if($tel){
            $validationList['tel'] = '';
            $str = $tel;
            for($i =0; $i<strlen($tel); $i++){
                if($str[0] == '0' || $str[0] == '1' || $str[0] == '2'|| $str[0] == '3'|| $str[0] == '4'|| $str[0] == '5'|| $str[0] == '6'|| $str[0] == '7'|| $str[0] == '8' || $str[0] == '9'){
                } else{
                    $validationList['tel'] = '電話番号は0-9の数字のみでご入力ください';
                    $validationFlag = false;
                };
                $str = substr($str, 1);
            };
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // $emailErr = "Invalid email format";
            $validationList['email'] = 'メールアドレスは正しくご入力ください。';
            $validationFlag = false;
        };

        if(strlen($body) == ''){
            $validationList['body'] ='お問い合わせ内容は必須入力です。';
            $validationFlag = false;
        }
          



        if(!$validationFlag){
        }else{
            $body  =str_replace("\n", '<br />', $body);
            $_SESSION['name'] = $username; 
            $_SESSION['kana'] = $kana; 
            $_SESSION['tel'] = $tel;
            $_SESSION['email'] = $email; 
            $_SESSION['body'] = $body;


            

            header('Location: ./updateConfirm.php?id='. $_GET['id']);
            die();
        };
    
    };
  };

  function snedNewData(){
    
    $id = $_GET['id'];
    if(isset($_POST['submit'])){
    
      $name = $_SESSION['name'];
      $kana = $_SESSION['kana'] ;
      $tel = $_SESSION['tel'];
      $email = $_SESSION['email'] ;
      $body = $_SESSION['body'];
    
    
      $name = mysqli_real_escape_string($GLOBALS['connection'],$name );
      $kana = mysqli_real_escape_string($GLOBALS['connection'],$kana );
      $tel = mysqli_real_escape_string($GLOBALS['connection'],$tel );
      $email = mysqli_real_escape_string($GLOBALS['connection'],$email );
      $body = mysqli_real_escape_string($GLOBALS['connection'],$body );

      $query = "UPDATE contacts SET name='$name', kana='$kana', tel='$tel', email='$email', body='$body' WHERE id = $id";
  
      $result = mysqli_query($GLOBALS['connection'], $query); 
  
      if(!$result){
          die('failed sending data. '. mysqli_error($connection));
      }else{
        header("Location: ./contact.php");
        die();
      }
      
    
    };
  };

?>