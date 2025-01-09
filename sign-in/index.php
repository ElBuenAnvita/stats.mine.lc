<?php
session_start();
if(isset($_SESSION['logueado']) && $_SESSION['logueado'] == TRUE) {
	header("Location: ../dashboard/");
} 
ini_set("allow_url_fopen", 1);
?>
<?php 
  /* SHUTTING DOWN */
  /* header("Location: https://www.anvico.club/shutting-down/?caso=StatsLC"); */
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Inicia sesión para ver tus estadísticas en MineLC">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Iniciar sesión | MineLC Estadísticas</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Bienvenido(a)</h1>
							<p class="lead">
								Por favor inidique su nombre de usuario
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="https://avatars.githubusercontent.com/u/74076204?s=400&u=a870d3275ab7da63ca52687b5d3555dbbce0724f&v=4" class="img-fluid" width="102" height="102" /><span class="h1"> | Estadísticas</span>
									</div>
									<br>
									<div class="text-center">
										<hr>
									</div>
									<br>
									<form>
										<div class="mb-3">
											<label class="form-label">Nombre de usuario</label>
											<input class="form-control form-control-lg" name="usuariolc" placeholder="Ingresa tu nickname" />
										</div>
										</div>
										<div class="text-center mt-3">
											<!-- <a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->
											<input type="submit" value="Entrar" class="btn btn-lg btn-primary"></input>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

<?php
if(isset($_POST['entrar'])) {
	$username = $_POST['usuariolc'];

	if(isset($username)) {
		$_SESSION['logueado'] = TRUE;
		$_SESSION['username'] = $username;
		echo('<script>alert("aaa");</script>');
	}
}

if(isset($_GET['usuariolc'])) {
	$username = $_GET['usuariolc'];
	$goto = $_GET['goto'];

	if(isset($goto) && !empty($goto) && !empty($username)) {
		$_SESSION['logueado'] = TRUE;
		$_SESSION['username'] = $username;

		$urltolcoins = "https://mine.lc/api/jugadores/lcoins/" . $username;

		$json = file_get_contents($urltolcoins);
		$json_data = json_decode($json, true);
		$lcoinss = $json_data[0]["LCoins"];
		if (isset($lcoinss)) {
			// echo("<script>alert('Usuario reconocido, redirigiendote a $goto');</script>");
			header("Location: https://stats.mine.lc/dashboard/?mostrar=mystats&modalidad_individual=$goto");
			// echo("<script>window.location = window.location.protocol + '//' + window.location.hostname + '/dashboard/?mostrar=mystats&modalidad_individual=' + $goto;</script>");
		} else {
			echo("<script>alert('Usuario no reconocido');</script>");
		}
	} else if(!empty($username)) {
		$_SESSION['logueado'] = TRUE;
		$_SESSION['username'] = $username;

		$urltolcoins = "https://mine.lc/api/jugadores/lcoins/" . $username;

		$json = file_get_contents($urltolcoins);
		$json_data = json_decode($json, true);
		$lcoinss = $json_data[0]["LCoins"];
		if (isset($lcoinss)) {
			echo("<script>window.location = window.location.protocol + '//' + window.location.hostname + '/dashboard';</script>");
		} else {
			echo("<script>alert('Usuario no reconocido');</script>");
		}
	}
}
?>

</html>