<?php
session_start();
if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] == FALSE) {
	header("Location: ../sign-in/");
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Estadísticas MineLC">
	<meta name="keywords" content="stats, estadisticas, minelc, liroxcraft, net">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>MineLC - Estadísticas</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/mc-icons.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="css/bg.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
	<script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>	
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="#">
          			<span class="align-middle"><img src="https://avatars.githubusercontent.com/u/74076204?s=400&u=a870d3275ab7da63ca52687b5d3555dbbce0724f&v=4" height="50" /> | Estadísticas</span>
        		</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						<?php echo($username); ?>
					</li>

					<li class="sidebar-item <?php if (!isset($_GET['mostrar']) || $_GET['mostrar'] == 'main') echo('active'); ?>">
						<a class="sidebar-link" href="?mostrar=main">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">General</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="?error=NOT_YET_OR_DISABLED">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Perfil</span>
						</a>
					</li>

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
						<i class="align-middle" data-feather="frown"></i> <span class="align-middle">Mis sanciones</span>
						</a>
					</li> -->

					<li class="sidebar-item <?php if ($_GET['mostrar'] == 'stats') echo('active'); ?>">
						<a href="#stats_per_user" data-bs-toggle="collapse" class="sidebar-link collapsed">
              			<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Mis estadísticas</span>
            		</a>
						<ul id="stats_per_user" class="sidebar-dropdown list-unstyled collapse <?php if ($_GET['mostrar'] == 'mystats') echo('show'); ?>" data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if ($_GET['modalidad_individual'] == 'sw') echo('active'); ?>"><a class="sidebar-link" href="?mostrar=mystats&modalidad_individual=sw">SkyWars</a></li>
							<li class="sidebar-item <?php if ($_GET['modalidad_individual'] == 'ew') echo('active'); ?>"><a class="sidebar-link" href="?mostrar=mystats&modalidad_individual=ew">EggWars</a></li>
							<li class="sidebar-item <?php if ($_GET['modalidad_individual'] == 'kitpvp') echo('active'); ?>"><a class="sidebar-link" href="?mostrar=mystats&modalidad_individual=kitpvp">KitPvP</a></li>
							<li class="sidebar-item <?php if ($_GET['modalidad_individual'] == 'prac') echo('active'); ?>"><a class="sidebar-link" href="?mostrar=mystats&modalidad_individual=prac">Practice</a></li>
							<li class="sidebar-item <?php if ($_GET['modalidad_individual'] == 'pvpg') echo('active'); ?>"><a class="sidebar-link" href="?mostrar=mystats&modalidad_individual=pvpg">PvPGames</a></li>
							<li class="sidebar-item <?php if ($_GET['modalidad_individual'] == 'chg') echo('active'); ?>"><a class="sidebar-link" href="?mostrar=mystats&modalidad_individual=chg">CHG</a></li>
						</ul>
					</li>

					<li class="sidebar-header">
						Tops
					</li>
					<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'sw') echo('active'); ?>">
						<a data-bs-target="#sw_top" data-bs-toggle="collapse" class="sidebar-link collapsed">
						<i style="transform:scale(1.5);" class="mc-icon mc-icon-bow_standby"></i> <span class="align-middle">SkyWars</span>
						</a>
						<ul id="sw_top" class="sidebar-dropdown list-unstyled collapse <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'sw') echo('show'); ?>" data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'sw' && $_GET['tipo'] == "stats_kills") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=sw&tipo=stats_kills">Asesinatos</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'sw' && $_GET['tipo'] == "stats_deaths") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=sw&tipo=stats_deaths">Muertes</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'sw' && $_GET['tipo'] == "stats_partidas_jugadas") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=sw&tipo=stats_partidas_jugadas">Partidas Jugadas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'sw' && $_GET['tipo'] == "stats_partidas_ganadas") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=sw&tipo=stats_partidas_ganadas">Partidas Ganadas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'sw' && $_GET['tipo'] == "stats_level") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=sw&tipo=stats_level">Nivel</a></li>
						</ul>
					</li>
					<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'ew') echo('active'); ?>">
						<a data-bs-target="#ew_top" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i style="transform:scale(1.5);" class="mc-icon mc-icon-dragon_egg"></i> <span class="align-middle">EggWars</span>
						</a>
						<ul id="ew_top" class="sidebar-dropdown list-unstyled collapse <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'ew') echo('show'); ?>" data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'ew' && $_GET['tipo'] == "stats_kills") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=ew&tipo=stats_kills">Asesinatos</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'ew' && $_GET['tipo'] == "stats_deaths") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=ew&tipo=stats_deaths">Muertes</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'ew' && $_GET['tipo'] == "stats_partidas_jugadas") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=ew&tipo=stats_partidas_jugadas">Partidas Jugadas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'ew' && $_GET['tipo'] == "stats_partidas_ganadas") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=ew&tipo=stats_partidas_ganadas">Partidas Ganadas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'ew' && $_GET['tipo'] == "stats_level") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=ew&tipo=stats_level">Nivel</a></li>
						</ul>
					</li>
					<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'kitpvp') echo('active'); ?>">
						<a data-bs-target="#kitpvp_top" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i style="transform:scale(1.5);" class="mc-icon mc-icon-iron_chestplate"></i> <span class="align-middle">KitPvP</span>
						</a>
						<ul id="kitpvp_top" class="sidebar-dropdown list-unstyled collapse <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'kitpvp') echo('show'); ?>" data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'kitpvp' && $_GET['tipo'] == "stats_kills") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=kitpvp&tipo=stats_kills">Asesinatos</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'kitpvp' && $_GET['tipo'] == "stats_kills_month") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=kitpvp&tipo=stats_kills_month">Asesinatos (mensuales)</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'kitpvp' && $_GET['tipo'] == "stats_deaths") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=kitpvp&tipo=stats_deaths">Muertes</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'kitpvp' && $_GET['tipo'] == "stats_level") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=kitpvp&tipo=stats_level">Nivel</a></li>
						</ul>
					</li>
					<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'prac') echo('active'); ?>">
						<a data-bs-target="#prac_top" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i style="transform:scale(1.5);" class="mc-icon mc-icon-potion_bottle_splash"></i> <span class="align-middle">Practice</span>
						</a>
						<ul id="prac_top" class="sidebar-dropdown list-unstyled collapse <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'prac') echo('show'); ?>" data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'prac' && $_GET['tipo'] == "kills") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=prac&tipo=kills">Asesinatos</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'prac' && $_GET['tipo'] == "deaths") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=prac&tipo=deaths">Muertes</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'prac' && $_GET['tipo'] == "global_elo") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=prac&tipo=global_elo">ELO Global</a></li>
						</ul>
					</li>
					<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg') echo('active'); ?>">
						<a data-bs-target="#pvpg_top" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i style="transform:scale(1.5);" class="mc-icon mc-icon-cake"></i> <span class="align-middle">PvPGames</span>
						</a>
						<ul id="pvpg_top" class="sidebar-dropdown list-unstyled collapse <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg') echo('show'); ?>" data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg' && $_GET['tipo'] == "stats_kills") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=pvpg&tipo=stats_kills">Asesinatos</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg' && $_GET['tipo'] == "stats_deaths") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=pvpg&tipo=stats_deaths">Muertes</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg' && $_GET['tipo'] == "stats_partidas_jugadas") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=pvpg&tipo=stats_partidas_jugadas">Partidas Jugadas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg' && $_GET['tipo'] == "stats_partidas_ganadas") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=pvpg&tipo=stats_partidas_ganadas">Partidas Ganadas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg' && $_GET['tipo'] == "stats_monuments_destroyed") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=pvpg&tipo=stats_monuments_destroyed">Monumentos destruídos</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg' && $_GET['tipo'] == "stats_wools_placed") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=pvpg&tipo=stats_wools_placed">Lanas puestas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'pvpg' && $_GET['tipo'] == "stats_cores_leakeds") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=pvpg&tipo=stats_cores_leakeds">Núcleos filtrados</a></li>
						</ul>
					</li>
					<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'chg') echo('active'); ?>">
						<a data-bs-target="#chg_top" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i style="transform:scale(1.5);" class="mc-icon mc-icon-porkchop_raw"></i> <span class="align-middle">CHG</span>
						</a>
						<ul id="chg_top" class="sidebar-dropdown list-unstyled collapse <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'chg') echo('show'); ?>" data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'chg' && $_GET['tipo'] == "stats_kills") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=chg&tipo=stats_kills">Asesinatos</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'chg' && $_GET['tipo'] == "stats_deaths") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=chg&tipo=stats_deaths">Muertes</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'chg' && $_GET['tipo'] == "stats_partidas_jugadas") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=chg&tipo=stats_partidas_jugadas">Partidas Jugadas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'chg' && $_GET['tipo'] == "stats_partidas_ganadas") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=chg&tipo=stats_partidas_ganadas">Partidas Ganadas</a></li>
							<li class="sidebar-item <?php if ($_GET['mostrar'] == 'tops' && $_GET['modalidad'] == 'chg' && $_GET['tipo'] == "stats_level") echo('active'); ?>"><a class="sidebar-link" href="?mostrar=tops&modalidad=chg&tipo=stats_level">Nivel</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<?php echo("<img src='https://minotar.net/helm/$username/44.png' class='avatar img-fluid rounded me-1' alt='$username' /> <span class='text-dark'>$username</span>"); ?>
								<!-- <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span> -->
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="../backend/logout.php">Cerrar sesión</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<?php
					switch ($_GET['mostrar']) {
						default:
						case "main":
							$urltolcoins = "https://mine.lc/api/jugadores/lcoins/" . $username;
							$json = file_get_contents($urltolcoins);
							$json_data = json_decode($json, true);
							$lcoinss = $json_data[0]["LCoins"];

							$urltolcoins = "https://mine.lc/api/jugadores/rango/" . $username;
							$json = file_get_contents($urltolcoins);
							$json_data = json_decode($json, true);
							$rank = $json_data[0]["Rank"];
							$vippoints = $json_data[0]["Puntos"];
							$duration = $json_data[0]["Duration"];
							$rankmsg = ($rank == 'PREMIUM' || $rank == 'DEFAULT') ? '<a href="https://mine.lc/tienda">Comprar rango ahora</a>' : '¡Gracias por apoyarnos!';

							echo("
								<div class='container-fluid p-0'>

								<div class='row mb-2 mb-xl-3'>
									<div class='col-auto d-none d-sm-block'>
										<h3><strong>Vista general</strong></h3>
									</div>
								</div>
								<div class='row'>
									<div class='col-xl-6 col-xxl-5 d-flex'>
										<div class='w-100'>
											<div class='row'>
												<div class='col-sm-6'>
													<div class='card'>
														<div class='card-body'>
															<h5 class='card-title mb-4'>LCoins</h5>
															<h1 class='mt-1 mb-3'>$lcoinss ⛁</h1>
															<div class='mb-1'>
																<!-- <span class='text-success'> <i class='mdi mdi-arrow-bottom-right'></i> 5.25% </span> -->
																<span class='text-muted'>Consíguelas jugando</span>
															</div>
														</div>
													</div>
													<div class='card'>
														<div class='card-body'>
															<h5 class='card-title mb-4'>VIP-Points</h5>
															<h1 class='mt-1 mb-3'>$vippoints Ⓥ</h1>
															<div class='mb-1'>
																<!-- <span class='text-success'> <i class='mdi mdi-arrow-bottom-right'></i> 5.25% </span> -->
																<span class='text-muted'><a href='https://tienda.minelc.net/category/vip-points'>Comprar ahora</a></span>
															</div>
														</div>
													</div>
												</div>
												<div class='col-sm-6'>
													<div class='card'>
														<div class='card-body'>
															<h5 class='card-title mb-4'>Rango</h5>
															<h1 class='mt-1 mb-3 color-$rank'>$rank</h1>
															<div class='mb-1'>
																<!-- <span class='text-success'> <i class='mdi mdi-arrow-bottom-right'></i> 5.25% </span> -->
																<span class='text-muted'>$rankmsg</span>
															</div>
														</div>
													</div>
													<div class='card'>
														<div class='card-body'>
															<h5 class='card-title mb-4'>Duración del Rango</h5>
															<h1 class='mt-1 mb-3'><span class='changeDuration'>$duration</span></h1>
															<div class='mb-1'>
																<!-- <span class='text-danger'> <i class='mdi mdi-arrow-bottom-right'></i> -2.25% </span>-->
																<span class='text-muted'><a href='https://tienda.minelc.net/category/rangos'>Comprar más días</a></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class='col-xl-6 col-xxl-7'>
										<div class='card flex-fill w-100'>
											<div class='card-header'>

												<h5 class='card-title mb-0'>Últimos anuncios</h5>
											</div>
											<div class='card-body py-3'>
												<div class='chart chart-sm'>
													<canvas id='chartjs-dashboard-line'></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							");
							break;
						case "tops":
							if (!isset($_GET['modalidad']) || !isset($_GET['tipo'])) {
								echo("no modalidad and/or tipo selected! D:");
								break;
							}

							$modalidad = $_GET['modalidad'];
							$tipo = $_GET['tipo'];
							// $customPlayerHolder = 'Player';
							$customPlayerHolder = ($modalidad == 'prac') ? 'username' : 'Player';

							$topapi = "https://mine.lc/api/tops/modalidad/" . $modalidad . "/" . $tipo;
							$json = file_get_contents($topapi);
							$json_data = json_decode($json, true);
							// $rank = $json_data[0]["Rank"];

							echo("
								<div class='container-fluid p-0'>

								<h1 class='h3 mb-3'>Tops</h1>
			
								<div class='row'>
									<div class='col-12'>
										<div class='card'>
											<div class='card-header'>
												<table id='myTable' class='display'>
													<tr>
														<th>Posición</th>
														<th>Cabeza</th>
														<th>$tipo</th>
														<th>Jugador</th>
													</tr>");

													$indexA = 0;
													foreach ($json_data as $value) {
														++$indexA;
														$cadena = "<tr> <td>#". $indexA . "</td> <td><img src='https://minotar.net/helm/". $value[$customPlayerHolder] ."/50.png' /></td> <td>" . $value[$tipo] ."</td> <td>". $value[$customPlayerHolder] ."</td> </tr>";
														echo ($cadena);
													}

												echo("</table>
												<script>
												$('#myTable').DataTable();
												</script>
											</div>
											<div class='card-body'>
											</div>
										</div>
									</div>
								</div>
			
							</div>
							");
							break;
						case "mystats":
							if (!isset($_GET['modalidad_individual']) || $_GET['modalidad_individual'] == "") {
								echo("no modalidad and/or tipo selected! D:");
								break;
							}
							$modalidad_ind = $_GET['modalidad_individual'];
							switch ($_GET['modalidad_individual']) {
								case "sw":
									$urlAPI = "https://mine.lc/api/jugadores/modalidad/sw/" . $username;
									$json = file_get_contents($urlAPI);
									$json_data = json_decode($json, true);
									$kills = $json_data[0]["stats_kills"];
									$deaths = $json_data[0]["stats_deaths"];
									$pjug = $json_data[0]["stats_partidas_jugadas"];
									$pgan = $json_data[0]["stats_partidas_ganadas"];
									echo("
										<div class='container-fluid p-0'>

										<div class='row mb-2 mb-xl-3'>
											<div class='col-auto d-none d-sm-block'>
												<h3><strong>Mis estadísticas</strong> <button class='btn btn-secondary' data-clipboard-text='https://mine.lc/p/?u=$username&q=$modalidad_ind'><i data-feather='share-2' id='copy'></i></button></h3>
											</div>
										</div>
										<div class='row'>
											<div class='col-xl-12 col-xxl-7'>
												<div class='card flex-fill w-100' id='sw-bg'>
													<div class='card-body py-3' id='insidetag'>
														<br>
														<br>
														<h1 class='h1' style='text-align: center;'>SkyWars</h1>
														<br>
														<br>
													</div>
												</div>
											</div>
										</div>

										<div class='row'>
											<div class='col-xl-12 col-xxl-5 d-flex'>
												<div class='w-100'>
													<div class='row'>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-green);'>Asesinatos</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-green);'>$kills</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-red);'>Muertes</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-red);'>$deaths</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Partidas Jugadas</h5>
																	<h1 class='mt-1 mb-3'>$pjug</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Partidas Ganadas</h5>
																	<h1 class='mt-1 mb-3'>$pgan</h1>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									");
									break;
								case "ew":
									$urlAPI = "https://mine.lc/api/jugadores/modalidad/ew/" . $username;
									$json = file_get_contents($urlAPI);
									$json_data = json_decode($json, true);
									$kills = $json_data[0]["stats_kills"];
									$deaths = $json_data[0]["stats_deaths"];
									$pjug = $json_data[0]["stats_partidas_jugadas"];
									$pgan = $json_data[0]["stats_partidas_ganadas"];
									echo("
										<div class='container-fluid p-0'>

										<div class='row mb-2 mb-xl-3'>
											<div class='col-auto d-none d-sm-block'>
												<h3><strong>Mis estadísticas</strong> <button class='btn btn-secondary' data-clipboard-text='https://mine.lc/p/?u=$username&q=$modalidad_ind'><i data-feather='share-2' id='copy'></i></button></h3>
											</div>
										</div>
										<div class='row'>
											<div class='col-xl-12 col-xxl-7'>
												<div class='card flex-fill w-100' id='ew-bg'>
													<div class='card-body py-3' id='insidetag'>
														<br>
														<br>
														<h1 class='h1' style='text-align: center;'>EggWars</h1>
														<br>
														<br>
													</div>
												</div>
											</div>
										</div>

										<div class='row'>
											<div class='col-xl-12 col-xxl-5 d-flex'>
												<div class='w-100'>
													<div class='row'>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-green);'>Asesinatos</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-green);'>$kills</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-red);'>Muertes</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-red);'>$deaths</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Partidas Jugadas</h5>
																	<h1 class='mt-1 mb-3'>$pjug</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Partidas Ganadas</h5>
																	<h1 class='mt-1 mb-3'>$pgan</h1>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									");
									break;
								case "kitpvp":
									$urlAPI = "https://mine.lc/api/jugadores/modalidad/kitpvp/" . $username;
									$json = file_get_contents($urlAPI);
									$json_data = json_decode($json, true);
									$kills = $json_data[0]["stats_kills"];
									$deaths = $json_data[0]["stats_deaths"];
									$level = $json_data[0]["stats_level"];
									$killsmonth = $json_data[0]["stats_kills_month"];
									echo("
										<div class='container-fluid p-0'>

										<div class='row mb-2 mb-xl-3'>
											<div class='col-auto d-none d-sm-block'>
												<h3><strong>Mis estadísticas</strong> <button class='btn btn-secondary' data-clipboard-text='https://mine.lc/p/?u=$username&q=$modalidad_ind'><i data-feather='share-2' id='copy'></i></button></h3>
											</div>
										</div>
										<div class='row'>
											<div class='col-xl-12 col-xxl-7'>
												<div class='card flex-fill w-100' id='kitpvp-bg'>
													<div class='card-body py-3' id='insidetag'>
														<br>
														<br>
														<h1 class='h1' style='text-align: center;'>KitPvP</h1>
														<br>
														<br>
													</div>
												</div>
											</div>
										</div>

										<div class='row'>
											<div class='col-xl-12 col-xxl-5 d-flex'>
												<div class='w-100'>
													<div class='row'>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-green);'>Asesinatos</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-green);'>$kills</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-green);'>Asesinatos (mensuales)</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-green);'>$killsmonth</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-red);'>Muertes</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-red);'>$deaths</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Nivel</h5>
																	<h1 class='mt-1 mb-3'>$level</h1>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									");
									break;
								case "prac":
									$urlAPI = "https://mine.lc/api/jugadores/modalidad/prac/" . $username;
									$json = file_get_contents($urlAPI);
									$json_data = json_decode($json, true);
									$kills = $json_data[0]["kills"];
									$deaths = $json_data[0]["deaths"];
									$elo = $json_data[0]["global_elo"];
									echo("
										<div class='container-fluid p-0'>

										<div class='row mb-2 mb-xl-3'>
											<div class='col-auto d-none d-sm-block'>
												<h3><strong>Mis estadísticas</strong> <button class='btn btn-secondary' data-clipboard-text='https://mine.lc/p/?u=$username&q=$modalidad_ind'><i data-feather='share-2' id='copy'></i></button></h3>
											</div>
										</div>
										<div class='row'>
											<div class='col-xl-12 col-xxl-7'>
												<div class='card flex-fill w-100' id='prac-bg'>
													<div class='card-body py-3' id='insidetag'>
														<br>
														<br>
														<h1 class='h1' style='text-align: center;'>Practice</h1>
														<br>
														<br>
													</div>
												</div>
											</div>
										</div>

										<div class='row'>
											<div class='col-xl-12 col-xxl-5 d-flex'>
												<div class='w-100'>
													<div class='row'>
														<div class='col-sm-6'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>ELO Global</h5>
																	<h1 class='mt-1 mb-3'>$elo ELO</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-green);'>Asesinatos</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-green);'>$kills</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-red);'>Muertes</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-red);'>$deaths</h1>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									");
									break;
								case "pvpg":
									$urlAPI = "https://mine.lc/api/jugadores/modalidad/pvpg/" . $username;
									$json = file_get_contents($urlAPI);
									$json_data = json_decode($json, true);
									$kills = $json_data[0]["stats_kills"];
									$deaths = $json_data[0]["stats_deaths"];
									$pjug = $json_data[0]["stats_partidas_jugadas"];
									$pgan = $json_data[0]["stats_partidas_ganadas"];
									$monu = $json_data[0]["stats_monuments_destroyed"];
									$wools = $json_data[0]["stats_wools_placed"];
									$core = $json_data[0]["stats_cores_leakeds"];
									$lvl = $json_data[0]["stats_level"];
									echo("
										<div class='container-fluid p-0'>

										<div class='row mb-2 mb-xl-3'>
											<div class='col-auto d-none d-sm-block'>
												<h3><strong>Mis estadísticas</strong> <button class='btn btn-secondary' data-clipboard-text='https://mine.lc/p/?u=$username&q=$modalidad_ind'><i data-feather='share-2' id='copy'></i></button></h3>
											</div>
										</div>
										<div class='row'>
											<div class='col-xl-12 col-xxl-7'>
												<div class='card flex-fill w-100' id='pvpg-bg'>
													<div class='card-body py-3' id='insidetag'>
														<br>
														<br>
														<h1 class='h1' style='text-align: center;'>PvPGames</h1>
														<br>
														<br>
													</div>
												</div>
											</div>
										</div>

										<div class='row'>
											<div class='col-xl-12 col-xxl-5 d-flex'>
												<div class='w-100'>
													<div class='row'>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-green);'>Asesinatos</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-green);'>$kills</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-red);'>Muertes</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-red);'>$deaths</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Partidas Jugadas</h5>
																	<h1 class='mt-1 mb-3'>$pjug</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Partidas Ganadas</h5>
																	<h1 class='mt-1 mb-3'>$pgan</h1>
																</div>
															</div>
														</div>
													</div>
													<!-- CAMBIO                       -->
													<div class='row'>
														<div class='col-sm-4'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Monumentos destruídos</h5>
																	<h1 class='mt-1 mb-3'>$monu</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-4'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Lanas colocadas</h5>
																	<h1 class='mt-1 mb-3'>$wools</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-4'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Núcleos filtrados</h5>
																	<h1 class='mt-1 mb-3'>$core</h1>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									");
									break;
								case "chg":
									$urlAPI = "https://mine.lc/api/jugadores/modalidad/chg/" . $username;
									$json = file_get_contents($urlAPI);
									$json_data = json_decode($json, true);
									$kills = $json_data[0]["stats_kills"];
									$deaths = $json_data[0]["stats_deaths"];
									$pjug = $json_data[0]["stats_partidas_jugadas"];
									$pgan = $json_data[0]["stats_partidas_ganadas"];
									echo("
										<div class='container-fluid p-0'>

										<div class='row mb-2 mb-xl-3'>
											<div class='col-auto d-none d-sm-block'>
												<h3><strong>Mis estadísticas</strong> <button class='btn btn-secondary' data-clipboard-text='https://mine.lc/p/?u=$username&q=$modalidad_ind'><i data-feather='share-2' id='copy'></i></button></h3>
											</div>
										</div>
										<div class='row'>
											<div class='col-xl-12 col-xxl-7'>
												<div class='card flex-fill w-100' id='chg-bg'>
													<div class='card-body py-3' id='insidetag'>
														<br>
														<br>
														<h1 class='h1' style='text-align: center;'>Classic Hunger Games</h1>
														<br>
														<br>
													</div>
												</div>
											</div>
										</div>

										<div class='row'>
											<div class='col-xl-12 col-xxl-5 d-flex'>
												<div class='w-100'>
													<div class='row'>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-green);'>Asesinatos</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-green);'>$kills</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4' style='color: var(--bs-red);'>Muertes</h5>
																	<h1 class='mt-1 mb-3' style='color: var(--bs-red);'>$deaths</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Partidas Jugadas</h5>
																	<h1 class='mt-1 mb-3'>$pjug</h1>
																</div>
															</div>
														</div>
														<div class='col-sm-3'>
															<div class='card'>
																<div class='card-body'>
																	<h5 class='card-title mb-4'>Partidas Ganadas</h5>
																	<h1 class='mt-1 mb-3'>$pgan</h1>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									");
									break;
							}
							break;
					}
				
				?>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a href="#" class="text-muted"><strong>MineLC Network</strong></a> <a href="https://anvico.club">&copy; ElBuenAnvita</a>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://mine.lc/discord">Discord</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://mine.lc/reglas">Reglas</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">API</a>
								</li>
								<li class="list-inline-item">
									play.minelc.net
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/app.js"></script>
	<script>
		// var DateTime = luxon.DateTime;
		Array.from(document.getElementsByClassName("changeDuration")).forEach(el => {
			var numeros = parseInt(el.textContent);
			if (numeros == 0) {
				el.textContent = "Permanente";
				return;
			}
			var duracion = "";
			var time = (numeros - Date.now()) / 1000 / 60;
			var time2 = time;
			var isItYear = false;

			if (time2 > 52034400) {
				el.textContent = "99+ años";
				return;
			} else {
				// time = (time - System.currentTimeMillis()) / 1000L / 60L;
				if (time2 > 525600) {
					time2 = time2 / 525600;
					duracion = Math.floor(time2) + "a ";
					time2 = (time2 - Math.floor(time2)) * 525600.0;
					isItYear = true;
				}

				if (time2 > 1440) {
					time2 = time2 / 24 / 60;
					duracion = duracion + Math.floor(time2) + "d ";
					time2 = (time2 - Math.floor(time2)) * 24 * 60;
				}

				if (time2 > 60) {
					time2 /= 60;
					duracion = duracion + Math.floor(time2) + "h ";
					time2 = (time2 - Math.floor(time2)) * 60;
				}

				if (!isItYear) {
					if (time2 >= 1) {
						duracion = duracion + Math.floor(time2) + "m";
					}
				}
			}

			el.textContent = duracion;
		});
	</script>
	<script>
		document.body.innerHTML = document.body.innerHTML.replace(/<th>stats_kills/g, '<th>Asesinatos');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>stats_deaths/g, '<th>Muertes');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>stats_partidas_jugadas/g, '<th>Partidas Jugadas');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>stats_partidas_ganadas/g, '<th>Partidas Ganadas');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>stats_level/g, '<th>Nivel');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>kills/g, '<th>Asesinatos');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>deaths/g, '<th>Muertes');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>global_elo/g, '<th>ELO Global');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>stats_cores_leakeds/g, '<th>Núcleos filtrados');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>stats_wools_placed/g, '<th>Lanas puestas');
		document.body.innerHTML = document.body.innerHTML.replace(/<th>stats_monuments_destroyed/g, '<th>Monumentos destruídos');
	</script>
	<script>
		new ClipboardJS('.btn');
	</script>
</body>

</html>