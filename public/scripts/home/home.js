// updating max date dynamically
let today = new Date();
let mm = today.getMonth() + 1; //January is 0!
let yyyy = today.getFullYear();

for (let i = 0; i < 3; i++) {
    if (mm == 1) {
        mm = 12;
        yyyy--;
    }
    else mm--;
}

if (mm < 10) {
    mm = '0' + mm
}

today = yyyy + '-' + mm;

fetch('/api/query?' + 'from-json=false' + '&start-date=' + today + '-01' + '&counties[]=total')
    .then(response => {
        return response.json();
    })
    .then(jsonResponse => {
        document.getElementById("someri-counter").innerHTML = jsonResponse[0].nr_total;
    });
