const tbody = document.getElementById("members-row");
const members = [{
    name: "山田太郎", age: 42, hobby: "ギター"
}, {
    name: "斎藤すぐる", age: 46, hobby: "車"
}, {
    name: "田中よしお", age: 32, hobby: "旅行、カメラ"
}, {
    name: "高橋とおる", age: 25, hobby: "絵を書くこと"
}];

function membersInfo() {
    tbody.innerHTML = "";
    members.forEach((member)=> {
        tbody.insertAdjacentHTML("afterbegin", "<tr><td>"+member.name+"</td><td>"+member.age+"</td><td>"+member.hobby+"</td></tr>");
    });
}

function membersInfoSortAge(age) {
    tbody.innerHTML = "";
    members.forEach((member)=> {
        if (age <= member.age && member.age < age+10) {
            tbody.insertAdjacentHTML("afterbegin", "<tr><td>"+member.name+"</td><td>"+member.age+"</td><td>"+member.hobby+"</td></tr>");            
        } else {
            return;
        }
    });
}