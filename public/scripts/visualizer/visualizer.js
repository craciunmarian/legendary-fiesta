// ugly and deprecated but it reloads the page when the user uses the browser back button
if (performance.navigation.type == 2) {
    location.reload(true);
}

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
let dateInputs = document.getElementsByClassName("start-date");

for (let i = 0; i < dateInputs.length; i++) {
    dateInputs.item(i).setAttribute("max", today);
}

// adding event listeners for different forms
let categoryBtns = document.getElementsByClassName("category-btn");

for (let i = 0; i < categoryBtns.length; i++) {
    if (categoryBtns.item(i).id == "general")
        categoryBtns.item(i).checked = true;
    else
        categoryBtns.item(i).checked = false;

    categoryBtns.item(i).addEventListener('input', (e) => {
        let formId = e.target.id + "-form";

        let formIds = document.getElementsByTagName("form");

        for (let j = 0; j < formIds.length; j++) {
            if (formIds.item(j).id.localeCompare(formId)) {
                if (!formIds.item(j).classList.contains("hidden"))
                    formIds.item(j).classList.add("hidden");
            }
            else formIds.item(j).classList.remove("hidden");
        }

        document.getElementById("export-btn").setAttribute("form", formId);
    });
}

// making sure buttons from different categories uncheck
let exclusiveBtns = document.querySelectorAll('[data-exclusive]');

exclusiveBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        exclusiveBtns.forEach((otherBtn) => {
            if (otherBtn.getAttribute('data-exclusive') != e.target.getAttribute('data-exclusive'))
                otherBtn.checked = false;
        })
    })
})

let titles = document.getElementsByTagName("title");
for (let i = 0; i < titles.length; i++) {
    if (titles[i].parentElement.nodeName == "path") {
        fetch('/api/query?' + 'from-json=false' + '&start-date=' + today + '-01' + '&counties[]=' + titles[i].id)
            .then(response => {
                return response.json();
            })
            .then(jsonResponse => {
                titles[i].innerHTML += ": " + jsonResponse[0].nr_total + " șomeri în ultima lună";
                return jsonResponse[0].nr_total;
            });
    }
}