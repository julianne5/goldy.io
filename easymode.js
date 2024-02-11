const aiLogicEasy = (board) => {

    const emptyTiles = board.reduce((acc, value, index) => (value === '' ? [...acc, index] : acc), []);
    const randomIndex = Math.floor(Math.random() * emptyTiles.length);
    return emptyTiles[randomIndex];
  };
  
  
  export default aiLogicEasy;
  
  // aiLogicHard.js
  const aiLogicHard = (board) => {
    for (let i = 0; i < board.length; i++) {
      if (board[i] === '') {
        const tempBoard = [...board];
        tempBoard[i] = 'O';
        if (isWinningMove(tempBoard, 'O')) {
          return i; 
        }
      }
    }
  
    for (let i = 0; i < board.length; i++) {
      if (board[i] === '') {
        const tempBoard = [...board];
        tempBoard[i] = 'X';
        if (isWinningMove(tempBoard, 'X')) {
          return i;
        }
      }
    }
  
    return aiLogicEasy(board);
  };
  
  const isWinningMove = (board, player) => {
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
  
  export default aiLogicHard;
  
  // aiLogicExpert.js
  const aiLogicExpert = (board) => {
  
    for (let i = 0; i < board.length; i++) {
      if (board[i] === '') {
        const tempBoard = [...board];
        tempBoard[i] = 'O';
        if (isWinningMove(tempBoard, 'O')) {
          return i; 
        }
      }
    }
  
  
    for (let i = 0; i < board.length; i++) {
      if (board[i] === '') {
        const tempBoard = [...board];
        tempBoard[i] = 'X';
        if (isWinningMove(tempBoard, 'X')) {
          return i; 
        }
      }
    }
  
    // Prioritize the sides if available
    const sideIndices = [1, 2, 5, 7, 12, 19, 23, 25, 28]; 
    for (const sideIndex of sideIndices) {
      if (board[sideIndex] === '') {
        return sideIndex;
      }
    }
  
    return aiLogicHard(board);
  };
  
  export default aiLogicExpert;