function showColor(show) {
    const colors = ["赤", "青", "黄", "緑", "白"];
    const color = colors[Math.floor(Math.random() * colors.length)];
    document.getElementById(show).innerHTML = color;
};