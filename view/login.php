<!DOCTYPE html>
<html>
<head>
	<title>Админ-панель</title>
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="/">Главная</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	     
	    </ul>
	  </div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-4 offset-4 mt-5">
				<form method="POST" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/login">
				  <div class="form-group">
				    <label for="login">Логин</label>
				    <input type="text" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Введите логин" name="login">
				    
				  </div>
				  <div class="form-group">
				    <label for="password">Пароль</label>
				    <input type="password" class="form-control" id="password" placeholder="Введите пароль" name="password">
				  </div>
				  <?php if (isset($_SESSION['loginError'])): ?>
				  	<div class="alert alert-danger" role="alert">
				  		Введите корректные данные
				 	</div>
				  <?php endif ?>
				  
				  <button type="submit" class="btn btn-primary">Войти</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>