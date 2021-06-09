// ugly and deprecated but it reloads the page when the user uses the browser back button
if (performance.navigation.type == 2) {
    location.reload(true);
}

// updating max date dynamically
let today = new Date();
let mm = today.getMonth() + 1; //January is 0!
let yyyy = today.getFullYear();

if (mm == 1) {
    mm = 12;
    yyyy--;
}
else mm--;

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