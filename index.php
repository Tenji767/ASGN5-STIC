<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RSVP Speed Reader</title>
    <style>
        body { font-family: 'Inter', sans-serif; text-align: center; background-color: #121212; color: white; }
        #wordDisplay { font-size: 4rem; font-weight: bold; margin: 15vh 0; height: 100px; display: flex; justify-content: center; align-items: center; }
        #progressBar { height: 6px; background-color: #ff4d4d; width: 0%; transition: width 0.1s linear; }
        textarea { width: 80%; height: 150px; border-radius: 10px; padding: 10px; background: #222; color: #fff; border: 1px solid #444; }
        #speedDisplay { font-family: monospace; color: #888; margin-top: 10px; }
        .red { color: #ff4d4d; }
        .hidden { display: none; }
    </style>
</head>

<body>
    <h1>RSVP Engine</h1>

    <div id="inputSection">
        <p>Paste your text below to start rapid reading.</p>
        <textarea id="textToRead" placeholder="Enter text..."></textarea><br><br>
        <button id="submitBtn">Start Reading</button>
    </div>

    <div id="rsvpContainer" class="hidden">
        <div id="progressBar"></div>
        <div id="wordDisplay"></div>
        <div id="speedDisplay">Current Speed: <span id="wpmValue">0</span> WPM</div>
        <p style="color: #555; font-size: 0.8rem;">Press 'Space' to Pause/Resume</p>
    </div>

<script>
    const textInput = document.getElementById("textToRead");
    const startBtn = document.getElementById("submitBtn");
    const inputSection = document.getElementById("inputSection");
    const rsvpContainer = document.getElementById("rsvpContainer");
    const wpmLabel = document.getElementById("wpmValue");

    let isPaused = false;
    let words = [];
    let currentIndex = 0;
    let currentDelay = 500;
    const minDelay = 150;
    const acceleration = 10;

    // Toggle pause with Spacebar
    window.addEventListener("keydown", (e) => {
        if (e.code === "Space") {
            isPaused = !isPaused;
            if (!isPaused) runEngine(); // Resume if it was paused
        }
    });

    startBtn.addEventListener("click", () => {
        const rawText = textInput.value.trim();
        if (!rawText) return;

        words = rawText.split(/\s+/).map(highlightMiddle);
        currentIndex = 0;
        currentDelay = 500; // Reset speed
        
        inputSection.classList.add("hidden");
        rsvpContainer.classList.remove("hidden");
        
        runEngine();
    });

    /**
     * Standard RSVP highlighting: Focus on the middle character
     */
    function highlightMiddle(word) {
        if (word.length < 2) return word;
        let mid = Math.floor(word.length / 2);
        return word.slice(0, mid) + `<span class="red">${word[mid]}</span>` + word.slice(mid + 1);
    }

    /**
     * Recursive engine to handle display and acceleration
     */
    function runEngine() {
        if (currentIndex >= words.length || isPaused) return;

        // Display word and update progress
        document.getElementById("wordDisplay").innerHTML = words[currentIndex];
        document.getElementById("progressBar").style.width = ((currentIndex + 1) / words.length * 100) + "%";

        // Calculate and show WPM
        const currentWPM = Math.round(60000 / currentDelay);
        wpmLabel.innerText = currentWPM;

        currentIndex++;
        currentDelay = Math.max(minDelay, currentDelay - acceleration);

        setTimeout(runEngine, currentDelay);
    }
</script>
</body>
</html>