function validateForm() {
				
				var vprenom =document.forms["form-row"]["prenom"].value;
				var vmdp = document.forms["form-row"]["password"].value;
				var vmdp2= document.forms["form-row"]["password"].value;
				var vmail = document.forms["form-row"]["mail"].value;
				

				
				if (vprenom == ""){
					alert("Le champ Prénom est obligatoire.");
					return false;
				}
				if (vmdp == ""){
					alert("Le champ Mot de passe est obligatoire.");
					return false;
				}
				if (vmdp!=vmdp2){
					alert("Les mots de passe ne correspondent pas.");
					return false;
				}
				
				
				
				if (vmail == ""){
					alert("Le champ Email est obligatoire.");
					return false;
				}else {
					
					var re = /\S+@\S+\.\S+/;
  					if(!re.test(vmail)){
  						alert("Le champ mail doit être au format text@text.text");
						return false;
  					}
				}
			}

let group_form = document.querySelector(".form-row");
let input = group_form.password;
let chiffre = document.querySelector(".chiffre");
let majuscule = document.querySelector(".majuscule");
let minuscule = document.querySelector(".minuscule");
let generique = document.querySelector(".generique");

input.addEventListener("input", function(){
    validation(this);

    if(!this.value){
        remove();
    }
})

function validation(password){
    
    if(/[0-9]{2}/.test(password.value)){
        input.classList.remove("invalide");
        chiffre.classList.remove("error");

        input.classList.add("succes");
        chiffre.classList.add("succes");
    }
    else{
        input.classList.remove("succes");
        chiffre.classList.remove("succes");

        input.classList.add("invalide");
        chiffre.classList.add("error");
    }

    if(/[A-Z]{1}/.test(password.value)){
        input.classList.remove("invalide");
        majuscule.classList.remove("error");

        input.classList.add("succes");
        majuscule.classList.add("succes")
    }
    else{
        input.classList.remove("succes");
        majuscule.classList.remove("succes");

        input.classList.add("invalide");
        majuscule.classList.add("error");
    }

    if(/[a-z]{1}/.test(password.value)){
        input.classList.remove("invalide");
        minuscule.classList.remove("error");

        input.classList.add("succes");
        minuscule.classList.add("succes")
    }
    else{
        input.classList.remove("succes");
        minuscule.classList.remove("succes");

        input.classList.add("invalide");
        minuscule.classList.add("error");
    }
    
    if(password.value.length >= 8){
        generique.classList.remove("error");
        generique.classList.add("succes");
    }
    else{
        generique.classList.add("error");
        generique.classList.remove("succes");
    }
}
function remove(){

    input.classList.remove("invalide");
    input.classList.remove("succes");

    chiffre.classList.remove("error");
    chiffre.classList.remove("succes");

    majuscule.classList.remove("succes");
    majuscule.classList.remove("error");

    minuscule.classList.remove("succes");
    minuscule.classList.remove("error")

    generique.classList.remove("succes")
    generique.classList.remove("error");
}
