<script>

var myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");
myHeaders.append("Authorization", "Basic d2ViOndlYg==" );

var raw = "";

var requestOptions = {
  method: 'POST',
  headers: myHeaders,
  body: raw,
  redirect: 'follow'
};

fetch("https://scmradiologie.fmcloud.fm/fmi/data/vLatest/databases/RendezVousFM_FB_demo/sessions", requestOptions)
  .then(response => response.json())
  .then(result => {
      console.log(result);
      var display = document.getElementById("resultDiv");
      display.innerHTML = 'test ok avec Token Rendez Vous FM: ' + result.response.token;
  })
  .catch(error => console.log('error', error));


</script>
