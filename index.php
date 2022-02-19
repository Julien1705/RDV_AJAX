<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Formulaire</title>
	<link rel="stylesheet" href="style.css">

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

	<div class="alert alert-danger text-center" id="erreur_insertion" role="alert" style="display: none;">
	
	</div>

	<form method="post" id="form">
		<fieldset>
			<legend>Vos coordonnées</legend>
			<p class="formulaire">
				<label for="num_client">N° Client :</label>
				<select name="num_client" id="num_client">

				</select>
			</p>
			<p class="formulaire">
				<label for="prenom">Prénom :</label>
				<input type="text" id="prenom" name="prenom" placeholder="Votre prénom" />
			</p>
			<p class="formulaire">
				<label for="nom">Nom :</label>
				<input type="text" id="nom" name="nom" placeholder="Votre nom" />
			</p>
			<p class="formulaire">
				<label for="mail">Email :</label>
				<input type="text" id="mail" name="mail" placeholder="Votre Email" />
			</p>
		</fieldset>
		<p align="center">
			<button type="button" id="creation" class="btn btn-info">Créer</button>
			<button type="button" id="modifier" class="btn btn-warning" style="display: none;">Modifier</button>
			<button type="button" id="supprimer" class="btn btn-danger" style="display: none;">Supprimer</button>
			<button type="button" id="prise_rdv" class="btn btn-primary" style="display: none;" data-toggle="modal" data-target="#rdv-modal">Prise RDV</button>
		</p>
	</form>

	<div id="rdv-modal" class="modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Prise de RDV</h5>
				</div>
				<div class="modal-body">
					<form id="rdv_form">
						<fieldset>
							<legend>RDV</legend>
							<p>
								<input class="date" value="<?= date('Y-m-d'); ?>" type="date" name="date" id="date_rdv"/>
							</p>
							<p>
								<label for="heure">Heures</label><br />
								<select id="heure-debut" name="heure-debut">
									<option value="09:00:00">9H00</option>
									<option value="10:00:00">10H00</option>
									<option value="11:00:00">11H00</option>
									<option value="14:00:00">14H00</option>
									<option value="15:00:00">15H00</option>
									<option value="16:00:00">16H00</option>
									<option value="17:00:00">17H00</option>
								</select>
								<select id="heure-fin" name="heure-fin">
									<option value="10:00:00">10H00</option>
									<option value="11:00:00">11H00</option>
									<option value="12:00:00">12H00</option>
									<option value="15:00:00">15H00</option>
									<option value="16:00:00">16H00</option>
									<option value="17:00:00">17H00</option>
									<option value="18:00:00">18H00</option>
								</select>
							</p>
							<p id="intervenant">


								</select>
							</p>
						</fieldset>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="validation_rdv" class="btn btn-primary">Prendre Rendez-Vous</button>
					<button type="button" id="modal_close" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
				</div>
			</div>
		</div>
	</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



<script type="text/javascript">
	function Affichage_Client() {
		$.ajax({
			type: "POST",
			url: 'lecture.php',
			data: {},
			dataType: "html",
			success: function(data) {
				$('#num_client').html(data);
			}
		});
	}

	function Affichage_Intervenant() {
		$.ajax({
			type: "POST",
			url: 'affichage_intervenant.php',
			data: {},
			dataType: "html",
			success: function(data) {
				$('#intervenant').html(data);
			}
		});
	}

	Affichage_Intervenant();
	Affichage_Client();


	$('#num_client').change(function() {
		$selection = $('#num_client').val();

		if ($selection === "0") {
			$('#creation').show();
			$('#modifier').hide();
			$('#supprimer').hide();
			$('#prise_rdv').hide();

			$("#form").trigger("reset");
		} else {

			$.ajax({
				type: "POST",
				url: 'recherche.php',
				data: {
					'id': $selection
				},
				dataType: "json",
				success: function(data) {
					$("#prenom").val(data.prenom);
					$("#nom").val(data.nom);
					$("#mail").val(data.email);
				}
			});

			$('#creation').hide();
			$('#modifier').show();
			$('#supprimer').show();
			$('#prise_rdv').show();

		}
	})


	$("#creation").click(function(e) {
		e.preventDefault();
		$nom = $("#nom").val();
		$prenom = $("#prenom").val();
		$mail = $("#mail").val();
		$.ajax({
			type: "POST",
			url: 'traitement.php',
			data: {
				'nom': $nom,
				'prenom': $prenom,
				'mail': $mail
			},
			dataType: "json",
			success: function(data) {
				if(data.REPONSE === "OK"){
					$("#form").trigger("reset");
					alertify.success(data.MESSAGE);

					Affichage_Client();
				}
				else{
					$("#erreur_insertion").show();
					$("#erreur_insertion").append("<h1> Liste des erreurs : </h1>")
					for (let $erreur of data.MESS_ERR) {
						$("#erreur_insertion").append($erreur + "<br>" ) ;
					}
				}

			}
		});
	})

	$("#modifier").click(function(e) {
		e.preventDefault();
		$selection = $('#num_client').val();
		$nom = $("#nom").val();
		$prenom = $("#prenom").val();
		$mail = $("#mail").val();
		$.ajax({
			type: "POST",
			url: 'modification.php',
			data: {
				'id': $selection,
				'nom': $nom,
				'prenom': $prenom,
				'mail': $mail
			},
			dataType: "json",
			success: function(data) {
				$("#form").trigger("reset");
				alertify.success($prenom + ` ` + $nom + ` a été modifié`);

				Affichage_Client();

			}
		});
	})

	$("#supprimer").click(function(e) {
		e.preventDefault();

		$selection = $('#num_client').val();

		$message = `Souhaitez vous supprimer : ${$('#nom').val()} ${$('#prenom').val()}`;
		alertify.confirm("Suppresion du client", $message,
			function() {
				$.ajax({
					type: "POST",
					url: 'suppression.php',
					data: {
						'id': $selection
					},
					dataType: "json",
					success: function(data) {
						if (data.REPONSE === "OK") {
							$msg = `Le client ${$('#nom').val()} ${$('#prenom').val()} a été supprimé`;
							alertify.warning($msg);

							Affichage_Client();

							$("#form").trigger("reset");
						}
					}
				});
			},
			function() {}).set('labels', {
			ok: 'Supprimer',
			cancel: 'Annuler'
		});


		$('#creation').show();
		$('#modifier').hide();
		$('#supprimer').hide();
		$('#prise_rdv').hide();

		$("#form").trigger("reset");

	})

	$("#prise_rdv").click(function(e) {
		e.preventDefault();
		$('#rdv-modal').show();
	})

	$("#modal_close").click(function(e) {
		e.preventDefault();
		$('#rdv-modal').hide();
	})

	$('#intervenant').on("change", function() {	
		$nro_intervenant = $(this).find(':checked').val();
	})

	$("#validation_rdv").click(function(e) {
		e.preventDefault();
		$date_rdv = $('#date_rdv').val();
		$heure_debut_rdv = $('#heure-debut').val();
		$heure_fin_rdv = $('#heure-fin').val();
		$id_client = $('#num_client').val();

		$.ajax({
			type: "POST",
			url: 'insertion_rdv.php',
			data: {
				'date_rdv': $date_rdv,
				'heure_debut_rdv': $heure_debut_rdv,
				'heure_fin_rdv': $heure_fin_rdv,
				'nro_intervenant': $nro_intervenant,
				'id_client': $id_client
			},
			dataType: "json",
			success: function(data) {
				alertify.success("Le RDV a bien été enregistré");
				$("#rdv_form").trigger("reset");
				$('#rdv-modal').hide();
			}
		});

	});
</script>

</html>