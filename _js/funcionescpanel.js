function desplegar(elem,menu){
    if(document.getElementById(menu).classList.contains('oculto')){
        for(i=2;i<=4;i++){
        document.getElementById('nav'+i+'').classList.add('oculto');
        }
        document.getElementById(menu).classList.remove('oculto'); 
    }else{
        document.getElementById(menu).classList.add('oculto'); 
    }
    
    
        for(i=1;i<=3;i++){
        document.getElementById('enla'+i+'').classList.remove('active');
        }
        elem.classList.add('active'); 
   
    
}

function desplegar2(elem){
    for(i=1;i<=9;i++){
        document.getElementById('subenla'+i+'').classList.remove('active');
        }
        elem.classList.add('active'); 
}



function desplegarProfe(elem,menu){
    if(document.getElementById(menu).classList.contains('oculto')){
        for(i=2;i<=3;i++){
        document.getElementById('nav'+i+'').classList.add('oculto');
        }
        document.getElementById(menu).classList.remove('oculto'); 
    }else{
        document.getElementById(menu).classList.add('oculto'); 
    }
    
    
        for(i=1;i<=2;i++){
        document.getElementById('enlace'+i+'').classList.remove('active');
        }
        elem.classList.add('active'); 
   
    
}

function desplegar2Profe(elem){
    for(i=1;i<=5;i++){
        document.getElementById('subenlace'+i+'').classList.remove('active');
        }
        elem.classList.add('active'); 
}





/* Script para comprobar si existe el email (AJAX)*/



function comprobarEmail(str){
    var xmlhttp;
    if(str == ''){
       
       document.getElementById("errEmail").innerHTML="No puedes dejar el campo en blanco";
        exit();
    }
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        
        
        
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            if(xmlhttp.responseText == '0'){
                document.getElementById("errEmail").style.display="none";
                document.getElementById("errEmail").innerHTML="";
                document.getElementById('boton').disabled=false;
            }else{
                document.getElementById("errEmail").style.display="block";
                document.getElementById("errEmail").innerHTML="Email no disponible";
                document.getElementById("errEmail").classList.add('rojo');
            }
            
            
        }
        
        
        
    }
    xmlhttp.open("POST","_include/comp_email.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("q="+str);
    
}

/* fin Script para comprobar si existe el email */


function comprobarPass (pass1, pass2){
    if (document.getElementById(pass1).value == pass2){
        document.getElementById('errPass').innerHTML="";
        document.getElementById('boton').disabled=false;
        }else{
           document.getElementById('errPass').style.display="block";
           document.getElementById('errPass').innerHTML="Las contraseñas no coinciden";
           document.getElementById("errPass").classList.add('rojo');
            
        }
}

//Funcion barra progresiva conteo de proyectos.

function move() {
    var elem = document.getElementById("myBar"); 
    var width = 0;
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
            document.getElementById('myProgress').classList.add('ocul');
            document.getElementById('titbar').classList.add('ocul');
            document.getElementById('grafics').classList.remove('ocul');
            document.getElementById('textbar').classList.remove('ocul');
        } else {
            width++; 
            elem.style.width = width + '%'; 
            elem.innerHTML = width * 1 + '%';
        }
    }
    
    
}


//Funcion para recuperar los participantes de un proyecto concreto AJAX

function obtenParticipantes(idProy){
    var xmlhttp;
    
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function(){
        
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
        document.getElementById('iusuario').innerHTML = xmlhttp.responseText;
        document.getElementById('iusuario').focus();

    }
    
    }
    
    xmlhttp.open("POST","_include/participantes.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("i="+idProy);
}


//Funcion para recuperar los alumnos que no participan en un proyecto concreto AJAX

function obtenNoParticipantes(idProyec){
    var xmlhttp;
    
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function(){
        
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
        document.getElementById('iusuario').innerHTML = xmlhttp.responseText;
        document.getElementById('iusuario').focus();

    }
    
    }
    
    xmlhttp.open("POST","_include/noParticipantes.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("q="+idProyec);
}

function ponerselect(opt){
    document.getElementById('opt').getElementsByTagName('option').optSelected='selected';
}


//codigo select multiple 
$().ready(function() 
	{
		$('.pasar').click(function() { return !$('#iusuario option:selected').remove().appendTo('#iusuario2'); });  
		$('.quitar').click(function() { return !$('#iusuario2 option:selected').remove().appendTo('#iusuario'); });
		$('.pasartodos').click(function() { $('#iusuario option').each(function() { $(this).remove().appendTo('#iusuario2'); }); });
		$('.quitartodos').click(function() { $('#iusuario2 option').each(function() { $(this).remove().appendTo('#iusuario'); }); });
		$('.submit').click(function() { $('#iusuario2 option').prop('selected', 'selected'); });
        

        
	});








