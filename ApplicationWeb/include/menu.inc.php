
<?php if(isset($_SESSION['droits'])){ ?>
	<div id="wrapper">

		<?php //partie prof
		if($_SESSION['droits'] == 1){
			?>

			<!-- Sidebar -->
			<ul class="sidebar navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="index.php">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Tableau de bord</span>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown_etudiant" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-users"></i>
						<span>Etudiants</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="pagesDropdown">
						<h6 class="dropdown-header">Gestion des étudiants:</h6>
						<a class="dropdown-item" href="index.php?page=1">Lister</a>
						<a class="dropdown-item" href="index.php?page=2">Importer</a>
						<a class="dropdown-item" href="index.php?page=12">Gérer</a>
						<a class="dropdown-item" href="index.php?page=13">Supprimer promotion</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown_controle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-edit"></i>
						<span>Création</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="pagesDropdown">
						<h6 class="dropdown-header">Espace création:</h6>
						<a class="dropdown-item" href="index.php?page=5">Créer un énoncé</a>
						<a class="dropdown-item" href="index.php?page=6">Attribuer les sujets</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown_controle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-print"></i>
						<span>Gestion</span>
						<?php
						$notFinished = $enonceManager->checkUnfinishedCorrection();
						if($notFinished == true){ ?>
							<button type="button" class="btn btn-danger btn-xs">
								!
							</button>
						<?php } ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="pagesDropdown">
						<h6 class="dropdown-header">Espace gestion:</h6>
						<a class="dropdown-item" href="index.php?page=7">Lister les énoncés<?php if($notFinished == true){ ?>
							<span class="badge badge-danger">!</span>	<?php } ?></a>
							<a class="dropdown-item" href="index.php?page=11">Lister les attributions</a>
							<a class="dropdown-item" href="index.php?page=8">Lister les réponses</a>
                            <a class="dropdown-item" href="index.php?page=21">Élèves sans réponses</a>
						</div>
					</li>
				</ul>
			<?php }
			else{
				if($_SESSION['droits'] == 0){
					//partie élève
					?>

					<ul class="sidebar navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="index.php">
								<i class="fas fa-fw fa-tachometer-alt"></i>
								<span>Tableau de bord</span>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="index.php?page=10">
								<i class="fa fa-eye"></i>
								<span>Voir mes résultats</span>
							</a>
						</li>
					</ul>

					<?php
				}
			}
		}?>
		<div id="content-wrapper">
			<div class="container-fluid">
