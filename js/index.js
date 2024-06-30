function handleClick(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            var response = JSON.parse(this.responseText)[0];
            var id = document.querySelector("#portfolioModal #book-id");
            id.value = response["id"];
            document.querySelector("#portfolioModal #book-name").innerHTML = response.title;
            document.querySelector("#portfolioModal #cat-name").innerHTML = response["name"];
            var img = document.querySelector("#portfolioModal #book-img");
            img.src = response["img"];
            document.querySelector("#portfolioModal #description").innerHTML = response["description"];
            document.querySelector("#portfolioModal #author").innerHTML = "<strong>author:  </strong>" + response["author"];
            document.querySelector("#portfolioModal #price").innerHTML = "<strong>price:  </strong>" + response["price"] + "$";
            var stock = document.querySelector("#portfolioModal #book-stock");
            stock.max = response["stock"];
            document.querySelector("#portfolioModal #stock").innerHTML = "<strong>stock:  </strong>" + response["stock"];
        }
    };
    xhttp.open("GET", `http://localhost/Book_Store/testAPI.php/${id}`, true);
    xhttp.send();
}

document.addEventListener("DOMContentLoaded", function(){
    var dropdownElementList = [].slice.call(document.querySelectorAll(".dropdown-toggle"));
    var dropdownList = dropdownElementList.map(function(element){
        return new bootstrap.Dropdown(element)
    });
});
