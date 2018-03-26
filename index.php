<?php
error_reporting(0);
require_once('./redis.php');
$redis = new redis_cli ( 'redis', 6379, false );

function addVote() {

	global $redis;
	$os = $_POST["os"];
	$redis->cmd('INCR',$os)->set();
	echo "<header>Gracias por participar. Puedes votar las veces que quieras.</header>";

}
function showVotes() {

	global $redis;

	$votos_windows = $redis->cmd('GET','windows')->get();
	$votos_windows = $votos_windows >= 1 ? $votos_windows : 0 ;

	$votos_mac = $redis->cmd('GET','mac')->get();
	$votos_mac = $votos_mac >= 1 ? $votos_mac : 0 ;

	$votos_linux = $redis->cmd('GET','linux')->get();
	$votos_linux = $votos_linux >= 1 ? $votos_linux : 0 ;

	echo "<li>$votos_windows - Windows</li>";
	echo "<li>$votos_mac - Mac</li>";
	echo "<li>$votos_linux - Linux</li>";
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Windows vs. Mac vs. Linux</title>
		<link rel="stylesheet" href="normalize.min.css" media="screen">
		<link rel="stylesheet" href="estilos.css" media="screen">
	</head>
	<body>
		<?php if (!empty($_POST["os"])) {addVote();} ?>
		<div id='wrapper'>
			<h1>Windows vs. Mac vs. Linux</h1>
			<ul>
			<form class="" action="/" method="post">
				<li class="windows">
					<input id="windows" type="radio" name="os" onclick="this.form.submit();" value="windows">
					<label for="windows">Windows</label>
				</li>
				<li class="mac">
					<input id="mac" type="radio" name="os" onclick="this.form.submit();" value="mac">
					<label for="mac">Mac</label>
				</li>
				<li class="linux">
					<input id="linux" type="radio" name="os" onclick="this.form.submit();" value="linux">
					<label for="linux">Linux</label>
				</li>
			</form>
			</ul>
			<h2>Resultados</h2>
			<ul>
				<?php showVotes(); ?>
			</ul>
			<footer>
				<p>	<br>
					Procesado por <strong><?php echo getenv('HOSTNAME');?></strong>
				</p>
			</footer>
		</div>
	</body>
</html>
