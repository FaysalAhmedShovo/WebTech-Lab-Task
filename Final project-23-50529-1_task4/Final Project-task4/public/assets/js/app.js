// 🔍 SEARCH
function searchProducts(){

let q = document.getElementById("search").value;
let min = document.getElementById("min").value || 0;
let max = document.getElementById("max").value || 999999;

if(isNaN(min) || isNaN(max) || min < 0 || max < 0){
alert("Invalid price");
return;
}

fetch(`../../api/products/search.php?q=${q}&min=${min}&max=${max}`)
.then(res => res.json())
.then(data => {

let html = "";

data.forEach(p => {
html += `
<div class="card">
<h4>${p.name}</h4>
<p>💰 ${p.price} ৳</p>
<img src="../../public/uploads/products/${p.image_path}">
<br>
<a href="product_details.php?id=${p.id}">View</a><br>
<button onclick="addToCart(${p.id})">Add to Cart</button>
</div>
`;
});

document.getElementById("product-list").innerHTML = html;

});
}


// 🛒 ADD TO CART
function addToCart(id){
fetch("../../api/cart/add.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${id}`
})
.then(res => res.json())
.then(d => {
if(d.error){
alert(d.error);
}else{
alert("✅ Added to cart");
}
});
}


// 🔄 UPDATE CART
function updateCartLive(id, qty){

qty = parseInt(qty);

if(isNaN(qty) || qty <= 0){
alert("Invalid quantity");
return;
}

fetch("../../api/cart/update.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${id}&qty=${qty}`
})
.then(() => {

let price = parseFloat(document.getElementById(`price-${id}`).innerText);
let sub = price * qty;

document.getElementById(`sub-${id}`).innerText = sub;

updateTotal();

});
}


// ❌ REMOVE
function removeItemLive(id){
fetch("../../api/cart/remove.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${id}`
})
.then(()=>location.reload());
}


// 💰 TOTAL
function updateTotal(){
let subs = document.querySelectorAll("[id^='sub-']");
let total = 0;

subs.forEach(s => {
total += parseFloat(s.innerText);
});

document.getElementById("total").innerText = total;
}


// ⭐ REVIEW
function addReview(product_id){

let c = document.getElementById("comment").value;

if(c.trim()=="" || c.length > 200){
alert("Invalid comment");
return;
}

fetch("../../api/reviews/add.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${product_id}&comment=${c}`
})
.then(()=>location.reload());
}


// ❌ DELETE REVIEW
function deleteReview(id){
fetch("../../api/reviews/delete.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`id=${id}`
})
.then(()=>location.reload());
}


// 🧾 ORDER
function placeOrder(){

let method = document.getElementById("method").value;

fetch("../../api/order/place.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`method=${method}`
})
.then(res => res.json())
.then(d => {
if(d.error){
alert(d.error);
}else{
window.location = "order_success.php";
}
});
}