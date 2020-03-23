function membersInfo() {
    const members = [{
        name: "山田太郎", age: 42, hobby: "ギター"
    }, {
        name: "斎藤すぐる", age: 46, hobby: "車"
    }, {
        name: "田中よしお", age: 32, hobby: "旅行、カメラ"
    }, {
        name: "高橋とおる", age: 25, hobby: "絵を書くこと"
    }];

    let age_20 = [];
    let age_30 = [];
    let age_40 = [];

    members.forEach((member)=> {
        if (20 <= member.age && member.age < 30) {
            age_20.push(member);
        } else if (30 <= member.age && member.age < 40) {
            age_30.push(member);
        } else if (40 <= member.age && member.age < 50) {
            age_40.push(member);
        } else {
            console.log("出力対象外");
        }
    });

    console.log("-----20代-----");
    age_20.forEach((member)=> {
        console.log(member.name);
        console.log(member.age + "歳");
        console.log(member.hobby);
    });
    console.log("-----30代-----");
    age_30.forEach((member)=> {
        console.log(member.name);
        console.log(member.age + "歳");
        console.log(member.hobby);
    });
    console.log("-----40代-----");
    age_40.forEach((member)=> {
        console.log(member.name);
        console.log(member.age + "歳");
        console.log(member.hobby);
    });
}