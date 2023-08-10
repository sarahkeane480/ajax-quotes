<html>

<head>
  <title>AJAX Quotes</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');
    
    /* CSS to hide the quote container initially and apply fade-in animation */
    #quoteContainer {
        display: none;
    }

    /* CSS for the fade-in animation */
    .fade-in {
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
  </style>
</head>

<body>
  <h1>AJAX Quotes</h1>
  <p>Below is an example of using AJAX to retrieve random quotes from a PHP server side page every 5 seconds.</p>

<p>If you go to <a href="https://ajax-quotes.sarahkeane480.repl.co/random_quotes.php">https://ajax-quotes.sarahkeane480.repl.co<strong>/random_quotes.php</strong></a>, you'll see a single randomly chosen quote displayed in plain text. It won't change, but the main page (the one you are reading now!) loads a random quote from that php page, and then alters the font style afterwards.</p>

<p>Then, the setInterval() function allows us to display a new quote in the same way every 5 seconds. Additionally, a counter increases each time a quote is displayed, and that is used to cycle between various font styles for variety!</p>


  <div id="quoteContainer">Quote goes here</div>
  <script>

    var counter = 0;
    
    function getRandomQuote() {

      var fonts = ['Qwitcher Grypen', 'Tulpen One', 'Shadows Into Light'];
      
      var xhr = new XMLHttpRequest();

      xhr.open('GET', 'random_quotes.php', true);
      xhr.onload = function () {
        //code on return of data goes here
        if (xhr.status >= 200 && xhr.status < 300) {//good data returned, show it!
          // document.querySelector("#quoteContainer").innerText = xhr.responseText;

          var quoteContainer = document.querySelector("#quoteContainer");
          quoteContainer.innerText = xhr.responseText;
          quoteContainer.style.display = "block";

          quoteContainer.style.fontFamily = fonts[counter % fonts.length];
          counter++;

          quoteContainer.style.textShadow = '4px 4px 4px #aaa';

          quoteContainer.style.fontSize = "xx-large";
          
          quoteContainer.classList.add("fade-in");

          setTimeout(function(){
            quoteContainer.classList.remove("fade-in");
          }, 1000);

        } else {// something went wrong, give feedback
          document.querySelector("#quoteContainer").innerText = "Failed to fetch quote: " + xhr.status;
        }
      };

      xhr.onerror = function () {
        //code on error goes here
        alert("Oops, all errors! (just one, actually)")
      }

      xhr.send();
    }

    function displayRandomQuote() {
      //initial page load
      getRandomQuote();

      //run again at intervals
      setInterval(getRandomQuote, 5000);
    }

    //run on page load
    displayRandomQuote();
  </script>
</body>

</html>