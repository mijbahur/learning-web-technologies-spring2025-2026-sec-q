const cells = document.querySelectorAll(".cell");
const statusText = document.getElementById("status");
const resetBtn = document.getElementById("reset");


let currentPlayer = "X";
let board = ["", "", "", "", "", "", "", "", ""];
let gameActive = true;

const winConditions = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
];

cells.forEach(function (cell, index) {
    cell.addEventListener("click", function () {
        handleCellClick(cell, index);
    });
});

function handleCellClick(cell, index) {

    if (board[index] !== "" || !gameActive) {
        return;
    }

    board[index] = currentPlayer;
    cell.textContent = currentPlayer;

    checkWinner();

    //changing the player after every win check
    if (gameActive) {
        if (currentPlayer == "X") {
            currentPlayer = "O";
        } else {
            currentPlayer = "X";
        }

        statusText.textContent = "Player " + currentPlayer + " Turn";
    }

}

function checkWinner() {

    let roundWon = false;

    for (let condition of winConditions) {

        let a = board[condition[0]];
        let b = board[condition[1]];
        let c = board[condition[2]];

        if (a === "" || b === "" || c === "") {
            continue;
        }

        if (a === b && b === c) {

            cells[condition[0]].classList.add("win");
            cells[condition[1]].classList.add("win");
            cells[condition[2]].classList.add("win");

            statusText.textContent = "Player " + currentPlayer + " Wins!";
            gameActive = false;
            roundWon = true;
            break;
        }
    }

    if (roundWon) {
        return;
    }

    if (!board.includes("")) {
        statusText.textContent = "It's a Draw!";
        gameActive = false;
    }
}

resetBtn.addEventListener("click", resetGame);

function resetGame() {

    board = ["", "", "", "", "", "", "", "", ""];
    currentPlayer = "X";
    gameActive = true;

    cells.forEach(function (cell) {
        cell.textContent = "";
        cell.classList.remove("win");
    });

    statusText.textContent = "Player X Turn";
}