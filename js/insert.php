<?php
	date_default_timezone_set('Asia/Dushanbe');
	include_once("../con_db.php");
	include_once("modul.php");
	$zap=$_POST['zapros'];
	if ($zap=="insert") {
		// code...
	
		$name=my_htmlentities(str_replace('<br>','; ',$_POST['name']));
		$tel=my_htmlentities(str_replace('<br>','; ',$_POST['tel']));
		$adres=my_htmlentities(str_replace('<br>','; ',$_POST['adres']));
		$email=my_htmlentities(str_replace('<br>','; ',$_POST['email']));
		$date=date('Y-m-d H:i:s');
		// proverka karda nashishtam
		// echo $name.$tel.$adres.$email;
		$insert=$connect->query("INSERT INTO users (name,tel,adres,email,date) VALUES('".$name."','".$tel."','".$adres."','".$email."','".$date."')");

		if ($insert) {
			$select=$connect->query("select * from users order by date desc");
			$countselect=mysqli_num_rows($select);
			$cont="";
			while ($masselect=mysqli_fetch_assoc($select)) {
				$cont.='<div class="col-md-3 " id='."d".$masselect['id_user'].'>
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
			$res=array('res' =>'true' ,'content'=>$cont);
		}
		else {
			$res=array('res' =>'false'  );
		}
		
		
	}
	elseif ($zap=="delete") {

		$delete=$connect->query("DELETE FROM users WHERE id_user='".$_POST['id']."'");
		if ($delete) {
			$res=array('res' =>'true');
		}
		else{
			$res=array('res' =>'false');
		}
	}
	elseif ($zap=="show") {

		$select=$connect->query("select * from users where id_user='".$_POST['id']."'");
			$countselect=mysqli_num_rows($select);
			while ($masselect=mysqli_fetch_assoc($select)) {
				$res=array('res' =>'true' ,'id_user'=>$masselect['id_user'],'name'=>$masselect['name'],'tel'=>$masselect['tel'],'adres'=>$masselect['adres'],'email'=>$masselect['email'] );
			}
		
	}
	elseif ($zap=="save") {
		$nm=$_POST['name'];
		$tl=$_POST['tel'];
		$ad=$_POST['adres'];
		$ml=$_POST['email'];
		$id=$_POST['id'];
		$update=$connect->query("UPDATE users SET name='".$nm."',tel='".$tl."',adres='".$ad."',email='".$ml."' WHERE id_user='".$id."'");

		if ($update) {
			$res=array('res' =>'true' ,'id_user'=>$id,'name'=>$nm,'tel'=>$tl,'adres'=>$ad,'email'=>$ml);
		}
		else{
			$res=array('res' =>'false');
		}
	}
	elseif ($zap=="search") {
		$text=$_POST['text'];
		if ($text!="") {
			$search=$connect->query("SELECT * FROM users WHERE name LIKE '%".$text."%'");
			$countsearch=mysqli_num_rows($search);
			$cont="";
			while ($massearch=mysqli_fetch_assoc($search)){
				$cont.='<div class="col-md-3 " id='."d".$massearch['id_user'].'>
							<div class="item_user">
								<label id='.$massearch['id_user'].' class="delete" onclick="deletes(this)">x</label>
								<div class="foto_user"></div>
								<div class="info_user">
									<label class="fio">'.$massearch['name'].'</label>
									<label class="fio">'.$massearch['tel'].'</label>
									<label class="fio">'.$massearch['adres'].'</label>
									<label class="fio">'.$massearch['email'].'</label>
									<button id="'.$massearch['id_user'].'" class="but" onclick="show_user(this)">Посмотреть</button>
								</div>
							</div>
						</div>';
						
			}
		}
		else{
			$search=$connect->query("SELECT * FROM users order by date desc");
			$countsearch=mysqli_num_rows($search);
			$cont="";
			while ($massearch=mysqli_fetch_assoc($search)){
				$cont.='<div class="col-md-3 " id='."d".$massearch['id_user'].'>
							<div class="item_user">
								<label id='.$massearch['id_user'].' class="delete" onclick="deletes(this)">x</label>
								<div class="foto_user"></div>
								<div class="info_user">
									<label class="fio">'.$massearch['name'].'</label>
									<label class="fio">'.$massearch['tel'].'</label>
									<label class="fio">'.$massearch['adres'].'</label>
									<label class="fio">'.$massearch['email'].'</label>
									<button id="'.$massearch['id_user'].'" class="but" onclick="show_user(this)">Посмотреть</button>
								</div>
							</div>
						</div>';
						
			}
		}
		
		
		$res=array('res' =>'true' ,'content'=>$cont);
	}


	echo json_encode($res);
?>