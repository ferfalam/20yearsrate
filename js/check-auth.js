window.onload = function() { // can also use window.addEventListener('load', (event) => {
        code = prompt('Confirmez votre accès à cette page');
        if (!code) {
            window.location.href="/"
        }else{
            var txt = '';
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
              if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
                txt = xmlhttp.responseText;
                if (txt != code) {
                    alert("ERREUR DE CODE")
                    window.location.href="/"
                }
              }
            };
            xmlhttp.open("GET","code.txt",true);
            xmlhttp.send();
        }
      };