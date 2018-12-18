<div class=menu>
	<?php if(isset($_SESSION['droits'])){ ?>
	<?php if($_SESSION['droits'] == 1){ ?>
		<div>
			<h2>Etudiants</h2>
			<ul>
				<li><a href="index.php?page=1">Consulter les étudiants</a></li>
				<li><a href="index.php?page=2">Gestion des étudiants</a></li>
				<li><a href="index.php?page=3">Consulter les notes</a></li>
			</ul>
		</div>

		<div>
			<h2>Contrôles</h2>
			<ul>
				<li><a href="index.php?page=4">Consulter les sujets</a></li>
				<li><a href="index.php?page=5">Créer un sujet</a></li>
				<li><a href="index.php?page=6">Attribuer les sujets</a></li>
				<li><a href="index.php?page=7">Consulter les réponses</a></li>
			</ul>
		</div>

		<div>
			<h2>Paramètres</h2>
			<ul>
				<li><a href="index.php?page=8">...</a></li>
				<li><a href="index.php?page=9">...</a></li>
			</ul>
		</div>
	<?php }
	else{
		if($_SESSION['droits'] == 0){
			?>
			<div>
				<h2>Espace personnel</h2>
				<ul>
					<li><a href="index.php?page=10">Voir mes résultats</a></li>
					<li><a href="index.php?page=11">Changer de mot de passe</a></li>
				</ul>
			</div>

			<div>
				<h2>Contrôles</h2>
				<ul>
					<li><a href="index.php?page=12">Repondre a un contrôle</a></li>
				</ul>
			</div>

			<?php
		}
	}
}?>
</div>
