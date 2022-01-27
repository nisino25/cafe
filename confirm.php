<?php 
include 'functions.php';
session_start();

kickout();



sendData();




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
          <form action="confirm.php" method="POST">
            <p>下記の内容をご確認の上送信ボタンを押してください</p>
            <p>内容を訂正する場合は戻るを押してください。</p>
            <dl class="confirm">
                      <dt>氏名</dt>
                      <dd name="name"  ><?= $_SESSION['name'] ?></dd>
                      <dt>フリガナ</dt>
                      <dd name="kana"><?=  $_SESSION['kana'] ?></dd>
                      <dt>電話番号</dt>
                      <dd name="tel"><?=  $_SESSION['tel'] ?></dd>
                      <dt>メールアドレス</dt>
                      <dd name="email"><?=  $_SESSION['email'] ?></dd>
                      <dt>お問い合わせ内容</dt>
                      <dd name="body"><?=  $_SESSION['body'] ?></dd>
                      <dd class="confirm_btn">
                          <button type="submit" name="submit">送　信</button>
                          <a href="javascript:history.back();">戻　る</button>
                      </dd>
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
</body>
</html> 