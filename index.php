<!-- GET TO WORK JAJAJAJAJA -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rapid Serial Visual Presentation</title>
    </head>


<body>
    <h1>Read thing go fast</h1>
    <div id="inputText">
        <!-- Make this div shrink after submitting to leave room for the rsvp -->
        <p>Insert the text you want to read here</p>
        <textarea id="textToRead"></textarea>
        <button id="submitBtn">Help me read this</button>
    </div>
    <button id="expand">V</button>

<div id="rsvpBox">
    <div id="progressBar">
    </div>


    <div id="wordDisplay">

    </div>

    <div id="speed">
    </div>
</div>


<script>

let text = document.getElementById("textToRead");
let submit = document.getElementById("submitBtn");
let inputText = document.getElementById("inputText");
let expand = document.getElementById("expand");
let rsvpBox = document.getElementById("rsvpBox");
let readSpeed = 1000;

//on submit
submit.addEventListener("click", function() {
    let words = text.value.split(" ");
    let toread = words.map(highlightMiddle);
    inputText.style.display = "none";
    rsvpBox.style.display = "block";

    displayWords(toread);
    })
//expand/close the input box
expand.addEventListener("click", function() {
    if (inputText.style.display === "none") {
        inputText.style.display = "block";
        expand.textContent = "^";
    } else {
        inputText.style.display = "none";
        expand.textContent = "V";
    }
})

//turn the middle letter of a word red
function highlightMiddle(word) {
    if (word.length > 2) {
        let middleIndex = Math.floor(word.length/2);
        let highlighted = word.substring(0, middleIndex) + "<span style='color: red;'>" + word[middleIndex] + "</span>" + word.substring(middleIndex+1);
        return highlighted;
    }
    return word;
}

//display the words one by one, ADD ACCELERATION
function displayWords(words) {
    let index= 0;

    setTimeout()//use setTimeout to create a shortening delay up to a certain speed


}

</script>



</body>

</html>