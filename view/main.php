<!DOCTYPE html>
<html>
<head>
	<title>Укоротить ссылку</title>
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
      
      <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true): ?>
  		<li class="nav-item active">
        	<a class="nav-link" href="/admin">Админ-панель <span class="sr-only">(current)</span></a>
     	</li>
     	<li class="nav-item active">
        	<a class="nav-link" href="/logout">Выйти <span class="sr-only">(current)</span></a>
     	</li>
      <?php else: ?>
     	<li class="nav-item active">
        	<a class="nav-link" href="/login">Войти <span class="sr-only">(current)</span></a>
     	</li>
     <?php endif ?>	
    </ul>
  </div>
</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 offset-3">
				 <div class="form-group mt-5" >
				    <label for="textInput">Ссылка:</label>
				    <input type="text" class="form-control" id="textInput" aria-describedby="" placeholder="Пример www.сайт.ru">
				    
  				</div>
  				<div class="form-group">
  					<button class="btn btn-success" id="getLink">Получить ссылку</button>
  				</div>
  				<div class="alert alert-success" role="alert" style="display: none;" id="linkAlert">
				  Ваша ссылка: <a href="" id="link"></a>
				</div>
				<div class="alert alert-danger" role="alert" style="display: none;">
				  Введите ссылку 
				</div>
				<div class="alert alert-danger validate" role="alert" style="display: none;">
				  Ссылка должна быть формата домен.страна
				</div>
			</div>	
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#getLink').on('click',getLinkHandler);
			function getLinkHandler(){
				$('.alert').fadeOut();
				let linkText = $('#textInput').val();
				if (linkText != '') {
					if(linkText.split('.').length >= 2 ){
					$.ajax({
						url: '<?php $_SERVER['DOCUMENT_ROOT'] ?>/link-generate',
						type: 'POST',
						dataType: 'JSON',
						data:{link:linkText},
						success: function(resp){
							$('#linkAlert').fadeIn();
							$('#link').attr('href',window.location.href+'short/'+resp);
							$('#link').text(window.location.href + 'short/'+resp);
						},
						error: function(error){
							console.log(error);
						}
					});
					}else {
						$('.alert-danger.validate').fadeIn();

					}
				} else {
					$('.alert-danger').fadeIn();
				}

			
			}
		});
	</script>
</body>
</html>