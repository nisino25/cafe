<?php 
include 'functions.php';
session_start();

kickout();

echo '<br>';
echo '<br>';

editRow();

$id = $_GET['id'];
$row = getRow();



?>

<!DOCTYPE html>
<style>
</style>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lesson Sample Site</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>

        function deletingConfirmation(num) {   
            let text = 'id No.' + num + ' を削除しますか？' ;
            
            if (confirm(text) == true) {

                window.location = (`./delete.php?id="${num}"`) 
            } else {
                text = "You canceled!";
            }
            // document.getElementById("demo").innerHTML = text;
        }  



        function validateForm() {
            let name = document.querySelector('.name').value;
            let kana = document.querySelector('.kana').value;
            let tel = document.querySelector('.tel').value;
            let email  = document.querySelector('.email').value;
            let main = document.querySelector('.main').value;

            let flag = true;
            let warning = ''

            if(!name){
                flag =false;
                warning = warning + '氏名は必須入力です。' + '10文字以内でご入力ださい。'　+ '\n';
            }

            if(name.length > 10){
                flag =false;
                warning = warning + '氏名は10文字以内でご入力ださい。' + '\n';
            }

            if(!kana){
                flag =false;
                warning = warning + 'フリガナは必須入力です。' + '10文字以内でご入力ださい。'　+ '\n';
            }

            if(kana.length > 10){
                flag =false;
                warning = warning + 'フリガナは10文字以内でご入力ださい。' + '\n';
            }

            // let str = tel;
            // warnign = warning + tel

            if(tel){
                for (let i = 0; i < tel.length; i++) {
                    if(tel.charAt(i) == '0' || tel.charAt(i) == '1' || tel.charAt(i) == '2' || tel.charAt(i) == '3' || tel.charAt(i) == '4' || tel.charAt(i) == '5' || tel.charAt(i) == '6' || tel.charAt(i) == '7' || tel.charAt(i) == '8' || tel.charAt(i) == '9' ){
                        
                    } else{
                        flag =false;

                        warning = warning + '電話番号は0-9の数字のみでご入力ください'  + '\n';
                        // warning = warning + tel.charAt(i)
                        break;
                    }
                }

            }

            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (!filter.test(email)) {
                flag =false;
                warning = warning + 'メールアドレスは正しくご入力ください。' + '\n';
            }

            if(main.length == 0){
                flag = false;
                warning = warning + 'お問い合わせ内容は必須入力です。' + '\n';

                // warning = warning + ;
            }
            // main.split('\n').join('<br>'));

            // main = main.replace(/\n/g, "<br>");
            main = main.replace(/\n/g, "<br />");

            if(!flag) alert(`${warning}`);
            
            return true; 
        }

</script>
</head>
<body id="app" v-on="click: closeMenu">
    <header style="background-image: url(''); 
	position: absolute;
    top: 0px;
	min-height: 0px;
    background-color: rgba(0,0,0,0.8);
      ">
        <?php include ( dirname(__FILE__) . '/header.php' ); ?>
    </header>
    <open-modal v-show="showContent" v-on="click: closeModal"></open-modal>

    <section>
        <div class="contact_box">
            <h2 style=""><?php echo 'ID NO.' . $id . '　を編集中' ?></h2>
			<form name="myform" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post"  onsubmit="return validateForm()">
                <h3 >下記の項目をご記入の上送信ボタンを押してください</h3>
                <!-- <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
                <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p> -->
                <p><span class="required">*</span>は必須項目となります。</p>


                <dl>
                    <dt><label for="name">氏名</label><span class="required">*</span></dt>
                    <?php 
                        if(isset($_POST['submit'])){
                            if($validationList['name'] !== true) echo '<dd class="error">' . $validationList['name'] . '</dd>';
                        }
                    ?> 
                    <dd><input class="name" type="text" name="name" id="username" placeholder="yamada" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : $row['name']; ?>"></dd>

                    
                    <dt><label for="kana">フリガナ</label><span class="required">*</span></dt>
                    <?php 
                        if(isset($_POST['submit'])){
                            if($validationList['kana'] !== true) echo '<dd class="error">' . $validationList['kana'] . '</dd>';
                        }
                    ?> 
                    <dd><input class="kana" type="text" name="kana" id="kana" placeholder="ヤマダタロウ" value="<?php echo $row['kana']; ?>"></dd>

                    <dt><label for="tel">電話番号</label></dt>
                    <?php 
                        if(isset($_POST['submit'])){
                            if($validationList['tel'] !== true) echo '<dd class="error">' . $validationList['tel'] . '</dd>';
                        }
                    ?> 
                    <dd><input class="tel" type="text" name="tel" id="tel" placeholder="09012345678" value="<?php echo $row['tel']; ?>"></dd>

                    <dt><label for="email">メールアドレス</label><span class="required">*</span></dt>
                    <?php 
                        if(isset($_POST['submit'])){
                            if($validationList['email'] !== true) echo '<dd class="error">' . $validationList['email'] . '</dd>';
                        }
                    ?> 
                    <dd><input class="email" type="text" name="email" id="email" placeholder="test@test.co.jp" value="<?php echo $row['email']; ?>"></dd>

                </dl>
                
                <h3><label for="body">お問い合わせ内容をご記入ください<span class="required">*</span></label></h3>
                <dl class="body">
                    <?php 
                        if(isset($_POST['submit'])){
                            if($validationList['body'] !== true) echo '<dd class="error">' . $validationList['body'] . '</dd>';
                        }
                    ?> 
                    <dd><textarea class="main" name="body" id="body" ><?php echo $row['body']; ?>"</textarea></dd>
                    <dd><button type="submit" name="submit">更　新</button></dd>
                </dl>


                    
			</form>
        </div>
    </section>



    <footer>
      <?php include ( dirname(__FILE__) . '/footer.php' ); ?>
    </footer>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.11.5/vue.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // alert("氏名は必須入力です。10文字以内でご入力ください。\nフリガナは必須入力です。10文字以内でご入力ください。\n電話番号は0-9の数字のみでご入力ください。\nメールアドレスは正しくご入力ください。\nお問い合わせ内容は必須入力です。");   
    </script>
</body>
</html>