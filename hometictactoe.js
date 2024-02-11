document.getElementById('start').addEventListener('click', () => {
    document.querySelector('.homepage').style.display = 'none';
    document.querySelector('.background').style.display = 'block';
});

document.getElementById('instructionsButton').addEventListener('click', () => {
    document.getElementById('instructions-container').style.display = 'block';
    showInstruction(1); 
});

document.getElementById('closeInstructions').addEventListener('click', () => {
    document.getElementById('instructions-container').style.display = 'none';
});

let currentInstruction = 1;

function showInstruction(instructionNumber) {
    const instructionContent = document.getElementById('instruction-content');
    const prevButton = document.getElementById('prevInstruction');
    const nextButton = document.getElementById('nextInstruction');

    switch (instructionNumber) {
        case 1:
            instructionContent.innerHTML = "<p>Objective: Achieve a sequence of five 'X' or 'O' symbols in a row, column, or diagonal on the 5x6 board.</p>";
            prevButton.style.display = 'none';
            nextButton.style.display = 'inline';
            break;
        case 2:
            instructionContent.innerHTML = "<p>Gameplay: Choose difficulty and players. Players take turns placing their symbols. First to 5 wins.</p>";
            prevButton.style.display = 'inline';
            nextButton.style.display = 'inline';
            break;
        case 3:
            instructionContent.innerHTML = "<p>Scoring: Win a round: +1 point. First to 5 points wins.</p>";
            prevButton.style.display = 'inline';
            nextButton.style.display = 'inline';
            break;
        case 4:
            instructionContent.innerHTML = "<p>Reset: 'Clear' button resets the game. 'Start Game' resets scores.</p>";
            prevButton.style.display = 'inline';
            nextButton.style.display = 'inline';
            break;
        case 5:
            instructionContent.innerHTML = "<p>NOTE: AI player makes automatic moves in AI vs Human mode. Enjoy the game!</p>";
            prevButton.style.display = 'inline';
            nextButton.style.display = 'none';
            break;
        default:
            break;
    }
}

function prevInstruction() {
    if (currentInstruction > 1) {
        currentInstruction--;
        showInstruction(currentInstruction);
    }
}

function nextInstruction() {
    if (currentInstruction < 5) {
        currentInstruction++;
        showInstruction(currentInstruction);
    }
}