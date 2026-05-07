function loadData() {
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "data.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);

            document.getElementById("result").innerHTML =
                "Name: " + data.name + "<br>" +
                "Age: " + data.age + "<br>" +
                "City: " + data.city;
        }
    };

    xhr.send();
}