<?php include_once("con_db.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>
<body>
	<div class="div_forma">
		<h1>Форма</h1>
		<form name="f1" id="f1" method="post" enctype="multipart/form-data" action="">
			<div class="df_elements row">
				
					<div  class="col-md-6"><input class="elements" type="text" name="name_users" placeholder="Имя" onfocusout="rem(this)"></div>
					<div class="col-md-6 text_elem"><b>Имя</b><span id="sp"></span></div>

					<div  class="col-md-6"><input class="elements" type="tel" name="tel_users" placeholder="Номер телефона" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="9"   required pattern="([0-9]{9,12})" title="**-***-**-**">
						<button id ="bt0" onclick="rem(this)">Добавить</button>
					</div>
					<div class="col-md-6 text_elem"><b>Телефон</b><span id="sp0"></span></div>

					<div class="col-md-6"><input class="elements" type="text" name="adres_users" placeholder="Адрес">
						<button id ="bt1" onclick="rem(this)">Добавить</button>
					</div>
					<div class="col-md-6 text_elem"><b>Адрес</b><span id="sp1"> </span></div>

					<div  class="col-md-6"><input class="elements" type="email" name="email_users" placeholder="Емайл" required pattern="\S+@[a-z]+.[a-z]+" title="***@***.**"> <button id ="bt2" onclick="rem(this)">Добавить</button></div>
					<div class="col-md-6 text_elem"><b>Почта</b><span id="sp2"></span></div>
				
					<input type="submit" name="fg" value="Сохранить" class="submit">
					
				
			</div>
		</form>
	</div>
	<div class="list_users">
		<div class="modal row" id="modal" >
			<span  style="text-align: center;z-index: 999;" class="delete" onclick="closes()">x</span>
			<div class="foto_u col-md-6"></div>
			<div class="col-md-6">
				<div class="info_u" id="info_u">
					<h4>Имя</h4>
					<p>Aliev Vali</p>
					<h4>Телефон</h4>
					<p>9999999999</p>
					<h4>Адрес</h4>
					<p>Худжанд</p>
					<h4>Почта</h4>
					<p>ali@mail.com</p>
				</div>
			</div>
			<div id="dbut"></div>
			
		</div>
		<h1>Список контактов</h1>
		<div class="search"><input type="text" name="s_name"  onkeyup="search(this)" placeholder="Поиск"></div>
		<div class="row" id="show_list">
			<?php
				$select=$connect->query("select * from users order by date desc");
				$countselect=mysqli_num_rows($select);
				while ($masselect=mysqli_fetch_assoc($select)) {
					echo '<div class="col-md-3 " id='."d".$masselect['id_user'].'>
						<div class="item_user">
							<label id='.$masselect['id_user'].' class="delete" onclick="deletes(this)">x</label>
							<div class="foto_user"></div>
							<div class="info_user">
								
								<label class="fio">'.$masselect['name'].'</label>
								<label class="fio">'.$masselect['tel'].'</label>
								<label class="fio">'.$masselect['adres'].'</label>
								<label class="fio">'.$masselect['email'].'</label>
								<button id="'.$masselect['id_user'].'" class="but" onclick="show_user(this)">Посмотреть</button>
							</div>
						</div>
					</div>';
					
					
					
					
					 
				}
			?>
			
		</div>

	</div>




<script src="js/main.js"></script>
</body>
</html>