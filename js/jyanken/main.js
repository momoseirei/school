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

//じゃんけんコード
    const myHand = parseInt(prompt("「0：グー」、「1：チョキ」、「2：パー」どれかを数字で入力してください。"));
    const partnerHand = Math.floor(Math.random() * 3);  //0-3の整数

    if ( myHand === partnerHand ){
      document.write('引き分けです');
    }else if( (myHand === 0 && partnerHand === 1) || (myHand === 1 && partnerHand === 2) || (myHand === 2 && partnerHand === 0)){
      document.write('勝ちです！');
    }else {
      document.write('負けです。。');
    };
