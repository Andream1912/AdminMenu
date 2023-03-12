<?php
include "./connection.php";
session_start();

if (empty($_SESSION['username']) || empty($_SESSION['level'])) {
	header("Location:index.php");
	exit();
}

$user = $_SESSION['username'];
$ruolo = $_SESSION['level'];

if ($ruolo != 'admin') {
	header("Location:index.php");
	exit();
}

if (!empty($_GET['delete'])) {
	$del_prod = $_GET['delete'];
	$category = $_GET['category'];
	$deletedb = $dbh->prepare("DELETE FROM $category WHERE product_name=?");
	$deletedb->execute([$del_prod]);
	header("Location:./admin-page.php");
	exit();
}

if (!empty($_GET['add']) && $_GET['add'] === 'true') {
	$category = $_GET['category'];
	$product = $_GET['name'];
	$descr = $_GET['descr'];
	$price = $_GET['price'];
	$insert = $dbh->prepare("INSERT INTO $category (product_name, price, descrizione) VALUES (?,?,?)");
	$insert->execute([$product, $price, $descr]);
	
}

if(!empty($_GET['edit']) && $_GET['edit'] == true){
    $old_name = $_GET['old_name'];
    $new_name = $_GET['new_name'];
    $new_price = $_GET['new_price'];
    $new_descr = $_GET['new_descr'];
    $category = $_GET['category'];
    $sql = "UPDATE $category SET product_name=?,price=?,descrizione=? where product_name=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$new_name,$new_price,$new_descr,$old_name]);
    header("Location:./admin-page.php");
    
}
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tabella Responsive</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./css/admin-page.css">
	<script src="./js/admin-page.js"></script>
	</head>

<body>
	<h1>Pagina Admin</h1>
	<?php
	$category = $dbh->prepare("SELECT table_name from information_schema.tables where TABLE_SCHEMA = 'id20289518_unica'");
	$category->execute();
	while ($row = $category->fetch()) {
		if ($row['table_name'] == 'USER') {
			continue;
		}
		$table_name = $row['table_name'];
	?>
		<table id="<?php echo $table_name ?>">
			<thead>
				<tr class="toggle-header">
					<th style="text-align:center;"><?php echo $table_name ?></th>
				</tr>
				<tr class="toggle-body">
					<td colspan="4">
						<table>
							<thead>
								<tr>
									<th>Nome</th>
									<th>Descrizione</th>
									<th>Prezzo</th>
									<th>Operazioni</th>
								</tr>
							</thead>
							<?php
							$stmt = $dbh->prepare("SELECT * FROM $table_name order by product_name");
							$stmt->execute();
							while ($row = $stmt->fetch()) {
							?>
								<form method="post" onsubmit="ValidateForm()" class="form-table" id="<?php echo $table_name ?>">
									<tr>
										<td><input type='text' name='product_name' value="<?php echo $row['product_name'] ?>" disabled /></td>
										<td><input type='text' name='description' value="<?php echo $row['descrizione'] ?>" disabled /></td>
										<td><input type='text' name='price' value="<?php echo "€" . $row['price'] ?>" disabled /></td>
										<td>
											<div class="btn-group">
												<button type="button" class='btn btn-primary' onClick="editButton(this)" >Modifica</button>
												<button type="button" class='btn btn-danger' onClick="deleteButton(this)">Rimuovi</button>
												<button type="button" class='btn btn-success' onClick="confirmButton(this)" style="display:none">Conferma</button>
												<button type="button" class='btn btn-danger' onClick="window.location.reload()" style="display:none">Annulla</button>
											</div>
										</td>
									</tr>
								</form>
							<?php } ?>
						</table>
						<button id="aggiungi-riga" class="btn btn-success" onClick="addRecord(<?php echo "$table_name"?>)">Aggiungi Riga</button>
					</td>
				</tr>
			</thead>
		</table>
	<?php } ?>
</body>

</html>