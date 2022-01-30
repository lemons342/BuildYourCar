function total() {
    var price = document.getElementById("partPrice").value;
    if (price.length >= 4) {
        price = price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    if (price.length > 6) {
        //price = price.slice(0, 6);//max 6 characters
    }

    if (price != "") {
        document.getElementById("price").innerHTML = "+$" + price;
    } else {
        document.getElementById("price").innerHTML = "";
    }
}