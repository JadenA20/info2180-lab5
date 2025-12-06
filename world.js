document.addEventListener("DOMContentLoaded", function(){

  const lookupButton = document.getElementById("lookup");
  const userInput = document.getElementById("country");
  const queryResult = document.getElementById("result");

  //AJAX Request
  function lookupListener(){
    console.log("Button clicked");
    const userRequest = new XMLHttpRequest();
    const userQuery = userInput.value

    userRequest.open('GET', `world.php?country=${encodeURIComponent(userQuery)}`, true);
    userRequest.onreadystatechange = function() {
      if (userRequest.readyState === XMLHttpRequest.DONE) {
        if (userRequest.status === 200) {
          let response = userRequest.responseText;
          queryResult.innerHTML = response;
        }
        else {
          alert('There was an issue with the request receieved');
          console.log(userRequest.status, userRequest.responseText)
        }
      }
    }
    userRequest.send()
  };

 lookupButton.addEventListener('click', lookupListener);
    
});
