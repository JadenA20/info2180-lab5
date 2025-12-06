document.addEventListener("DOMContentLoaded", function(){

  const lookupButton = document.getElementById("lookup");
  const userInput = document.getElementById("country");
  const queryResult = document.getElementById("result");

  //AJAX Request
  function lookupListener(){
    const userRequest = new XMLHttpRequest();
    const userQuery = userInput

    userRequest.onreadystatechange = function() {
      if (userRequest.readyState === XMLHttpRequest.DONE) {
        if (userRequest.status === 200) {
          let response = userRequest.responseText;
          result.innerHTML = response;
        }
        else {
          alert('There was an issue with the request receieved');
        }
      }
    }
    userRequest.open('GET', `world.php?country=${encodeURIComponent(userQuery)}`, true);
    userRequest.send()
  }




    
}
