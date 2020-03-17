function countStr(text, result, warning) {
    const len = document.getElementById(text).value.replace(/\s/g,"").length;
    const war = document.getElementById(warning);
    const res = document.getElementById(result);
    war.innerText = "";
    res.innerText = len;

    if (len > 10) {
        war.innerText = "10文字以内にしてください";    
        res.classList.add("text-danger");   
    } else {
        res.classList.remove("text-danger");
    }
};