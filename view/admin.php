<!DOCTYPE html>
<html>
<head>
	<title>Админ-панель</title>
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
  <style type="text/css">
  	.remove {
		filter: brightness(200%);
		cursor: pointer;
	}
	.remove:hover{
		filter: brightness(100%);
	}
  </style>
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
	<div class="container">
		<div class="row">
			<div class="col-10 offset-1">
				<h1 class="text-center mt-5">Список ссылок</h1>
				<table class="table">
				  <thead class="thead-light">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Короткий путь</th>
				      <th scope="col">Пользовательская ссылка</th>
				      <th scope="col">Действие</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach ($links_array as $key => $link): ?>
				  		<tr id="row-<?php echo $link['id']; ?>">
					      <th scope="row"><?php echo $link['id']; ?></th>
					      <td><?php echo $link['link_slug']; ?></td>
					      <td><?php echo $link['redirect_link']; ?></td>
					      <td><span class="remove" id="<?php echo $link['id']; ?>"><i class="fas fa-trash" ></i></span></td>
					    </tr>
				  	<?php endforeach ?>
				    
				   
				  </tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.remove').on('click',linkRemoveHandler);

			function linkRemoveHandler(e){
				let id = $(this).attr('id');
				$.ajax({
						url: '<?php $_SERVER['DOCUMENT_ROOT'] ?>/link-remove',
						type: 'POST',
						dataType: 'JSON',
						data:{id:id},
						success: function(resp){
							$('#row-'+resp).remove();
						},
						error: function(error){
							console.log(error);
						}
					});
			}
		});
	</script>
</body>
</html>