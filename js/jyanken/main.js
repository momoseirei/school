function fight() {
    const input = document.getElementById("number").value;
    const res = document.getElementById("result-txt");
    
    switch (input) {
        case "1":
            res.innerText = "負け";
            break;
        case "2":
            res.innerText = "勝ち";
            break;
        default:
            res.innerText = "あいこ";
            break;
    }

};