function mostLog(login){
    login.style.display="block";
}
function oculLog(login){
    login.style.display="none";
}

/*Comrpobar user y pass con ajax*/
function comprobar(email, pass){
    
    var xmlhttp;
    
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function(){
        
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        if(xmlhttp.responseText!=""){
            document.getElementById('msg').innerHTML= xmlhttp.responseText;
            }else{
                document.getElementById('msg').innerHTML="";
                document.getElementById('submit').disabled=false;
            }
        }else{

        }


    }
    
    /*Unimos email y pass en una misma variable separadas por un _*/
    eyp= email+ "_" +pass;
    xmlhttp.open("POST","_include/comprobacion.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("e="+eyp);
    
    
}
/* Rellenar DATALIST Barra Buscar*/

function BarraBuscar(nomb){
    var xmlhttp;
    
    if(window.XMLHttpRequest){
        xmlhttp= new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function(){
        
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
       document.getElementById('busqueda').innerHTML= xmlhttp.responseText;

    }
    
    }
    
    xmlhttp.open("POST","_include/busqueda.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("search="+nomb);
}

