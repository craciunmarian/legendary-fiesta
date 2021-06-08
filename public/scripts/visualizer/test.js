let btn = document.getElementById("aa");
btn.addEventListener("click", () => {
    fetch('/api/query?' + '&from-json=false' + '&start-date=2012-07-01' + '&counties[]=iasi' + '&categories[]=age' + '&counties[]=botosani')
        .then(response => {
            return response.json();
        })
        .then(jsonResponse => {
            console.log(jsonResponse);
            console.log(jsonResponse[0].luna);
        });
})

let params = new URLSearchParams(location.search);
console.log(params.get("county1"));
console.log(params.getAll("education[]"));