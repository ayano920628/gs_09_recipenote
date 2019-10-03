<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="login.php">登録している方はこちら</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="userinfo.php">
  <div class="jumbotron">
   <fieldset>
    <legend>新規登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>Email：<input type="text" name="email"></label><br>
     <label>Password：<input type="password" name="password"></label><br>
     <label><input type="hidden" name="administrator" value="2"></label><br>
     <label><input type="hidden" name="lifeflg" value="2"></label><br>
     <input type="submit" value="登録">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<script>
  $('form').validate({
    rules: {
        name: { required: true },
        email: { required: true,
                 email: true},
        password: { required: true }
    }
  });
</script>

</body>
</html>
