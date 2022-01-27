<?php 
include 'functions.php';
session_start();
kickout();






?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lesson Sample Site</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/sp.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h2>お問い合わせ</h2>
            <div class="complete_msg">
                <p>お問い合わせ頂きありがとうございます。</p>
                <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
                <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
                <a href="index.php">トップへ戻る</a>
            </div>
        </div>
    </section>

    <footer>
      <?php include ( dirname(__FILE__) . '/footer.php' ); ?>
    </footer>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.11.5/vue.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>