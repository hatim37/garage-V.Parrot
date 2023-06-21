/**
 * 
 * Cette fonction empêche que le formulaire soit actualisé
 */
filters.onsubmit = (e) => {
    e.preventDefault();
  }
  
  const FiltersForm = document.querySelector("#filters");
  
      //soumission du formulaire en ajax avec la methode "click" sur bouton
      //on boucle sur les bouton de soumission des champs du formulaires
          document.querySelectorAll("#valide" ).forEach(input =>{
     //const input = document.querySelector("......");
          input.addEventListener("click", () => {
             // Ici on intercepte les clics
              // On récupère les données du formulaire
              const Form = new FormData(FiltersForm);
              console.log(Form);
             
              // On fabrique la "queryString"
              const Params = new URLSearchParams();
  
              Form.forEach((value, key) => {
                  Params.append(key, value);
              });
  
              // On récupère l'url active
              const Url = new URL(window.location.href);
      
              // On lance la requête ajax
              fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
                  headers: {
                      "X-Requested-With": "XMLHttpRequest"
                  }
              }).then(response => 
                  response.json()
              ).then(data => {
                  // On va chercher la zone de contenu
                  const content = document.querySelector("#content");
  
                  // On remplace le contenu
                  content.innerHTML = data.content;
  
                  // On met à jour l'url
                  history.pushState({}, null, Url.pathname + "?" + Params.toString());
              }).catch(e => alert(e));
          });
      });
  
  
      //Même opération de soumission du formulaire en ajax mais avec sur les champs select et avec la methode "change"
      //on boucle sur les select du formulaire
      document.querySelectorAll("#sortBy").forEach(select =>{
          //const input = document.querySelector("#valide");
               select.addEventListener("change", () => {
                  // Ici on intercepte les clics
                   // On récupère les données du formulaire
                   const Form = new FormData(FiltersForm);
       
                   // On fabrique la "queryString"
                   const Params = new URLSearchParams();
       
                   Form.forEach((value, key) => {
                       Params.append(key, value);
                   });
  
                   // On récupère l'url active
              const Url = new URL(window.location.href);
      
              // On lance la requête ajax
              fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
                  headers: {
                      "X-Requested-With": "XMLHttpRequest"
                  }
              }).then(response => 
                  response.json()
              ).then(data => {
                  // On va chercher la zone de contenu
                  const content = document.querySelector("#content");
  
                  // On remplace le contenu
                  content.innerHTML = data.content;
  
                  // On met à jour l'url
                  history.pushState({}, null, Url.pathname + "?" + Params.toString());
              }).catch(e => alert(e));
          });
      });