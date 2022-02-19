


function rem(e) {
	event.preventDefault();

	if (e.id=="") {
			document.getElementById("sp").innerHTML=document.querySelectorAll('.elements')[0].value;
		}
	else{
		for (var i = 0; i <= 2; i++) {
			var vall=document.querySelectorAll('.elements')[i+1].value;

				if (e.id=="bt"+i) {
					if (e.id=="bt2"  ) {
						var email=vall;
						var pattern  = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
						if (pattern .test(email)) {
							if (vall!="") {
							    document.getElementById("sp"+i).innerHTML+=vall+"<br/>";
							    
						    }
						  } else {
						    alert("Email nodurust");
						  }
					}
					else{
						if (vall!="") {
							    document.getElementById("sp"+i).innerHTML+=vall+"<br/>";
							    
						    }
						
					}
				}

			}
		}
	
}

$("#f1").submit(function(event) {
      event.preventDefault();
      name=document.getElementById('sp').innerHTML;
      tel=document.getElementById('sp0').innerHTML;
      adres=document.getElementById('sp1').innerHTML;
      email=document.getElementById('sp2').innerHTML;

        $.ajax({
        url:     "./js/insert.php", 
        type:     "POST", 
        dataType: "html",
        data: {'name':name,'tel':tel,'adres':adres,'email':email,'zapros':'insert'},  

        success: function(response) { 
          result = $.parseJSON(response);
          if (result.res=='true') {
          	
          	if (document.getElementById("show_list").innerHTML=='<h3 style="display:block;text-align:center;">Нест</h3>') {document.getElementById("show_list").innerHTML="";}
           //document.getElementById("show_list").innerHTML+='<div class="col-md-3" id="d'+result.id_user+'"><div class="item_user"><label id="'+result.id_user+'" class="delete" onclick="deletes(this)">x</label><div class="foto_user"></div><div class="info_user"><label class="fio">'+result.name+'</label><label class="fio">'+result.tel+'</label><label class="fio">'+result.adres+'</label><label class="fio">'+result.email+'</label><button id="'+result.id_user+'" class="but" onclick="show_user(this)">Посмотреть</button></div></div></div>';
          	document.getElementById("show_list").innerHTML=result.content;
          	document.getElementById('sp').innerHTML="";
		    document.getElementById('sp0').innerHTML="";
		    document.getElementById('sp1').innerHTML="";
		    document.getElementById('sp2').innerHTML="";
          }
          else{
            
          alert("Хатоги кадоме аз малумотхо нодуруст.");
                       
          }
         // 
          },
          error: function(response) { 
             alert("Хатоги малумот ба сервер равона нашуд.");
           
               
          }
       });
    });

function deletes(e){
	
	 $.ajax({
        url:     "./js/insert.php", 
        type:     "POST", 
        dataType: "html",
        data: {'zapros':'delete','id':e.id},  

        success: function(response) { 
          result = $.parseJSON(response);
          if (result.res=='true') {
           	document.getElementById('d'+e.id).classList.add('deleted');
           	setTimeout(function(){
	           	$("#d"+e.id).remove();
	        },1000);
          }
          else{
            
          	alert("сервер дастнорас");
                       
          }
         // 
          },
          error: function(response) { 
             alert("Хатоги малумот ба сервер равона нашуд.");
           
               
          }
       });
}

function closes(){
	document.getElementById('modal').classList.remove('show');
}
function show_user(e){
	document.getElementById('modal').classList.add('show');
	$.ajax({
        url:     "./js/insert.php", 
        type:     "POST", 
        dataType: "html",
        data: {'zapros':'show','id':e.id},  

        success: function(response) { 
          result = $.parseJSON(response);
          if (result.res=='true') {
           	document.getElementById('info_u').innerHTML='<h4>Имя</h4><p>'+result.name+'</p><h4>Телефон</h4><p>'+result.tel+'</p><h4>Адрес</h4><p>'+result.adres+'</p><h4>Почта</h4><p>'+result.email+'</p>';
          	document.getElementById('dbut').innerHTML='<button id="'+e.id+'" onclick="update(this)">Редактировать</button>';
          }
          else{
            
          	alert("сервер дастнорас");
                       
          }
         // 
          },
          error: function(response) { 
             alert("Хатоги малумот ба сервер равона нашуд.");
           
               
          }
       });

}

function update(e){
	document.getElementById('info_u').innerHTML='<h4>Имя</h4><textarea id="uname">'+result.name+'</textarea><h4>Телефон</h4><textarea id="utel">'+result.tel+'</textarea><h4>Адрес</h4><textarea id="uadres">'+result.adres+'</textarea><h4>Почта</h4><textarea id="uemail">'+result.email+'</textarea>';
	document.getElementById('dbut').innerHTML='<button id="'+e.id+'" class="submit" onclick="save(this)">сохранить</button>';
}

function save(e){
	nm=$("#uname").val();
	tl=$("#utel").val();
	ad=$("#uadres").val();
	ml=$("#uemail").val();
	$.ajax({
        url:     "./js/insert.php", 
        type:     "POST", 
        dataType: "html",
        data: {'zapros':'save','id':e.id,'name':nm,'tel':tl,'adres':ad,'email':ml},  

        success: function(response) { 
          result = $.parseJSON(response);
          if (result.res=='true') {
           	document.getElementById('info_u').innerHTML='<h4>Имя</h4><p>'+result.name+'</p><h4>Телефон</h4><p>'+result.tel+'</p><h4>Адрес</h4><p>'+result.adres+'</p><h4>Почта</h4><p>'+result.email+'</p>';
          	document.getElementById('dbut').innerHTML='<button id="'+e.id+'" onclick="update(this)">Редактировать</button>';
          }
          else{
            
          	alert("сервер дастнорас");
                       
          }
         // 
          },
          error: function(response) { 
             alert("Хатоги малумот ба сервер равона нашуд.");
           
               
          }
       });
}

function search(e){
	text=e.value;
	
		$.ajax({
	        url:     "./js/insert.php", 
	        type:     "POST", 
	        dataType: "html",
	        data: {'zapros':'search','text':text},  

	        success: function(response) { 
	          result = $.parseJSON(response);
	          if (result.res=='true') {
	           	document.getElementById('show_list').innerHTML=result.content;
	          }
	          if (result.content=="") {
	          	document.getElementById('show_list').innerHTML="<h3 style='display:block;text-align:center;'>Нест</h3>";
	          }
	        
	         // 
	          },
	          error: function(response) { 
	             alert("Хатоги малумот ба сервер равона нашуд.");
	           
	               
	          }
	       });
	
}


