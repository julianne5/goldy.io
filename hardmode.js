document.addEventListener('DOMContentLoaded', () => {
    const tiles = Array.from(document.querySelectorAll('.tile'));
    const resetButton = document.querySelector('#reset');
    const announcer = document.querySelector('.announcer');
    const scoreDisplay = document.getElementById('score');
    const playersSelect = document.getElementById('players');

    let board = Array(5 * 6).fill('');
    let currentPlayer = 'X';
    let isGameActive = true;
    let score = { X: 0, O: 0 };

    const POINTS_TO_WIN = 5;

    const winningConditions = [
        //horizontal
        [0, 1, 2, 3, 4, 5],
        [6, 7, 8, 9, 10, 11],
        [12, 13, 14, 15, 16, 17],
        [18, 19, 20, 21, 22, 23],
        [24, 25, 26, 27, 28, 29],
        //vertical
        [0, 6, 12, 18, 24],
        [1, 7, 13, 19, 25],
        [2, 8, 14, 20, 26],
        [3, 9, 15, 21, 27],
        [4, 10, 16, 22, 28],
        [5, 11, 17, 23, 29]
    ];

    const PLAYERX_WON = 'PLAYERX_WON';
    const PLAYERO_WON = 'PLAYERO_WON';
    const TIE = 'TIE';

    const announce = (type) => {
        switch (type) {
            case PLAYERX_WON:
                announcer.innerHTML = 'Player <span class="playerO">O</span> Won';
                break;
            case PLAYERO_WON:
                announcer.innerHTML = 'Player <span class="playerX">X</span> Won';
                break;
            case TIE:
                announcer.innerText = 'Tie';
        }
        announcer.classList.remove('hide');
    };

    const updateScore = () => {
        if (score[currentPlayer] === POINTS_TO_WIN) {
            setTimeout(() => {
                const winner = currentPlayer === 'X' ? 'O' : 'X';
                const resetConfirmed = confirm(`Player ${winner} has won the game! Do you want to reset the game and scores?`);
                if (resetConfirmed) {
                    resetGame();
                } else {
                    resetBoard();
                }
            }, 100);
        } else {
            announce(currentPlayer === 'X' ? PLAYERO_WON : PLAYERX_WON);
            isGameActive = false;
        }
    };

    const handleResultValidation = () => {
        let roundWon = false;
                let winningCells = [];

                for (let i = 0; i < winningConditions.length; i++) {
                    const winCondition = winningConditions[i];
                    const cells = winCondition.map(index => board[index]);
                    if (cells.every(cell => cell === 'X') || cells.every(cell => cell === 'O')) {
                        roundWon = true;
                        break;
                    }
                }

                if (!roundWon) {
                    // Check for diagonal victory
                    if (checkDiagonalVictory()) {
                        roundWon = true;
                    }
                }

                if (roundWon) {
                    score[currentPlayer]++;
                    scoreDisplay.innerText = `X: ${score.X} / O: ${score.O}`;
                    updateScore();
                    announce(currentPlayer === 'X' ? PLAYERO_WON : PLAYERX_WON);
                    isGameActive = false;
                    return;
                }

                if (!board.includes('') && !roundWon)
                    announce(TIE);
            };

            const checkDiagonalVictory = () => {
                const diagonals = [
                // top-left to bottom-right
                    [0, 7, 14, 21, 28],
                    [1, 8, 15, 22, 29],
                    [2, 9, 16, 23],
                    [3, 10, 17],
                    [4, 11],
                    [18, 25],
                    [12, 19, 26],
                    [6, 13, 20, 27],
                    

                // top-right to bottom-left
                    [1,6],
                    [2, 7, 12],
                    [3,  8, 13, 18],
                    [4, 9, 14, 19, 24],
                    [5, 10, 15, 20, 25],
                    [11, 16, 21, 26],
                    [17, 22, 27],
                    [23, 28]

                ];

                for (const diagonal of diagonals) {
                    const cells = diagonal.map(index => board[index]);
                    if (cells.every(cell => cell === 'X') || cells.every(cell => cell === 'O')) {
                        return true;
                    }
                }

                return false;
            };

    const isValidAction = (tile) => {
        if (tile.innerText === 'X' || tile.innerText === 'O') {
            return false;
        }

        return true;
    };

    const updateBoard = (index) => {
        board[index] = currentPlayer;
        handleResultValidation();    };

    const changePlayer = () => {
        currentPlayer = currentPlayer === 'X' ? 'O' : 'X';    };

    const userAction = (tile, index) => {
        if (isValidAction(tile) && isGameActive) {
            tile.innerText = currentPlayer;
            tile.classList.add(`player${currentPlayer}`);
            updateBoard(index);
            changePlayer();
        }    };

    const resetGame = () => {
        resetBoard();
        score = { X: 0, O: 0 };
        scoreDisplay.innerText = 'X: 0 / O: 0';
        isGameActive = true;
    
        if (score.X === POINTS_TO_WIN || score.O === POINTS_TO_WIN) {
            score = { X: 0, O: 0 };
            scoreDisplay.innerText = `X: ${score.X} / O: ${score.O}`;
            resetBoard();
        }    };

    playersSelect.addEventListener('change', () => {
        if (playersSelect.value === 'human' || playersSelect.value === 'ai') {
            resetGame();
        }
    }); 
    categorySelect.addEventListener('change', () => 
    {
        resetGame(); 
       });

    const resetBoard = () => {
        board = Array(5 * 6).fill('');
        isGameActive = true;
        announcer.classList.add('hide');

        tiles.forEach(tile => {
            tile.innerText = '';
            tile.classList.remove('playerX');
            tile.classList.remove('playerO');
        });

        currentPlayer = 'X';    };

    tiles.forEach((tile, index) => {
        tile.addEventListener('click', () => userAction(tile, index));
    });

    resetButton.addEventListener('click', resetBoard);

    // AI functionality
    const aiPlayer = () => {
        if (isGameActive && playersSelect.value === 'ai' && currentPlayer === 'O') {
            const emptyTiles = tiles.filter(tile => tile.innerText === '');
            const selectedTile = getAIDecision(emptyTiles);
    
            if (selectedTile) {
                userAction(selectedTile, tiles.indexOf(selectedTile));
            }
        }
    };
    
    const getAIDecision = (emptyTiles) => {
        switch (categorySelect.value) {
            case 'easy':
                // Easy mode: The player can easily win
                return getRandomEmptyTile(emptyTiles);
            case 'hard':
                // Hard mode: The player has a 30% chance to win
                return Math.random() < 0.7 ? getRandomEmptyTile(emptyTiles) : getWinningMove(emptyTiles);
            case 'expert':
                // Expert mode: The player is impossible to win
                return getWinningMove(emptyTiles);
            default:
                return getRandomEmptyTile(emptyTiles);
        }
    };
    
    const getRandomEmptyTile = (emptyTiles) => {
        // Choose a random empty tile
        const randomIndex = Math.floor(Math.random() * emptyTiles.length);
        return emptyTiles[randomIndex];
    };
    
    const getWinningMove = (emptyTiles) => {
        // Check each empty tile for a winning move
        for (const tile of emptyTiles) {
            const index = tiles.indexOf(tile);
            const originalContent = tile.innerText;
    
            // Simulate making a move on this tile
            tile.innerText = currentPlayer;
            const isWinningMove = checkForWin(index);
    
            // Restore the original content
            tile.innerText = originalContent;
    
            if (isWinningMove) {
                return tile;
            }
        }
    
        // If no winning move is found, return a random empty tile
        return getRandomEmptyTile(emptyTiles);
    };
    const checkForWin = (index) => {
        // Check if the move at the given index results in a win
        const currentBoard = [...board];
        currentBoard[index] = currentPlayer;

        // Check for horizontal, vertical, and diagonal wins
        return winningConditions.some(condition =>
            condition.every(cell => currentBoard[cell] === currentPlayer)
        );
    };

    setInterval(aiPlayer, 10);
});