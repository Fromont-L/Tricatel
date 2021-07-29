
<?php
	session_start();
	require './db_inc.php';
	require './account_class.php';

	$account = new Account();
	$login = FALSE;

	try
	{
		$login = $account->sessionLogin();
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	$sql = 'SELECT * FROM `plat`';

	// On prépare la requête
	$query = $pdo->prepare($sql);

	// On exécute la requête
	$query->execute();

	// On stocke le résultat dans un tableau associatif
	$listeplats = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang=fr>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="Tricatel, plats industriels"/>
		<meta name="author" content="Lucas Fromont"/>
		<link rel="icon" type="image/png" href="assets/image/tricatel_logo.jpg"/>
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>Tricatel - Accueil</title>
	</head>
	<body>

		<?php include 'header.php'?>

		<div class="container my-3">
			<h1 class="text-center">Bienvenue sur le site de Tricatel, créateur de plats industriels</h1>
		</div>
		
		<div class="container">
			<div class="row py-5">
				<?php
					// Création de la boucle pour afficher 9 plats au total
					for ($i = 0; $i < 9; $i++){
						// Condition pour couper la boucle s'il y en a moins de 9 pour éviter les erreurs
						if($i >= count($listeplats) ){
							break;
						}
				?>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="card shadow mb-5">
					<img src="<?= $listeplats[$i]['lien_image'] ?>" alt="<?= $plats['nom'] ?>"
					class="card-img-top"/>
						<div class="card-body">
						<p class="card-title"><?= $listeplats[$i]['nom'] ?></p>
						<p class="card-text"><?= $listeplats[$i]['description'] ?></p>
							<div class="d-flex justify-content-between">
								<a href="<?= 'info.php?id=' . $listeplats[$i]['id'] ?>" class="btn btn-primary btn-sm">Voir plus</a>
								<?php if ($login) { ?>
								<a href="<?= 'modifier.php?id=' . $listeplats[$i]['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
								<a href="<?= 'supprimer.php?id=' . $listeplats[$i]['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<a class="btn btn-primary btn-lg btn-block mb-3" type="button" href="plats.php">Voir tous nos plats</a>
			<?php if ($login) { ?>
			<a class="btn btn-info btn-lg btn-block mb-3" type="button" href="ajouter.php">Ajouter un plat</a>
			<?php } ?>
		</div>

		<?php include 'footer.php'?>
		

		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>


	</body>
</html>