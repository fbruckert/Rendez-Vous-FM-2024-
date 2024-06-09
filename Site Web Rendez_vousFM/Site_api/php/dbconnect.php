<script>

//    DEFINITION DE L'URL DE FILEMAKER SERVEUR ET STOCKAGE POUR LES AUTRES PAGES

// RENSEIGNER L'URL DE FILEMAKER SERVEUR ICI ---->>>
                                  var url = "https://172.20.20.2";
                                  sessionStorage.setItem("url", url );

//  DEFINITION DE LA DEMANDE DE CONNEXION
var request = "/fmi/data/vLatest/databases/RendezVousFM_FB_demo/sessions" ;

var url_requested = url + request ;

// ENTETE
var myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");
myHeaders.append("Authorization", "Basic d2ViOndlYg==" );

var requestOptions = {
  method: 'POST',
  headers: myHeaders,

};

// FETCH FONCTION
fetch( url_requested , requestOptions)
  .then(response => response.json())
  .then(result => {
      console.log(result);
      //STOCKAGE DU TOKEN EN VARIABLE DE SESSION
      sessionStorage.setItem("token", result.response.token);
  })
  .catch(error => console.log('error', error));


</script>
