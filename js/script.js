
afficherList();



//on defini ce qui va se passer quand nous allons cliquer sur le bouton ayant l'id valid
document.getElementById("valid").addEventListener("click", function(){
    ajoutMessage();
})

document.getElementById("valid").addEventListener("keypress", verifEntree)

//On crée la fonction ajourMessage
function ajoutMessage(){
   let message = document.getElementById("texte").value

   //on va vérifier si il y a une valeur et en fonction de la réponse on va faire qqch
   if(message != ""){
       let xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("reponse").innerHTML="Votre message a bien été ajouté"
            document.getElementById("texte").value = ""
        }
        else{
            document.getElementById("reponse").innerHTML="Votre message n'a pas pu être ajouté" 
        }
       }
    
       //On ouvrir notre requête
       xmlhttp.open("POST", "php/ajoutMessage.php?message="+message)

       //on envoi la requête
       xmlhttp.send();

   }
  



}

setInterval(afficherList, 1000)

lastId = 0

function afficherList(){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
         
            var messages = JSON.parse(this.response)
            console.log(messages)
            let discussion = document.getElementById("discussion")
            discussion.innerHTML=""
            let oneMessage = ""

            for (let i = 0; i < messages.length; i++) {
                discussion.innerHTML  += "<p>"+messages[i].message+"</p>"
                discussion.scrollTop = discussion.scrollHeight;
                console.log(oneMessage)
                //lastId = messages[i].id 
            }
        }
       
     

    }
    xmlhttp.open("GET", "php/list.php")
    xmlhttp.send();
}


function verifEntree(e){
    if(e.key == "Enter"){
    console.log(e.key);
    ajoutMessage();
    }
    }

