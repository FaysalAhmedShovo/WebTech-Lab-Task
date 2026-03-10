document.getElementById("formBox").addEventListener("submit", addData);
 
document.getElementById("nameInput").addEventListener("input", checkField);
 
document.getElementById("searchBox").addEventListener("input", searchStudent);
 
document.getElementById("sortButton").addEventListener("click", sortList);
 
document.getElementById("topHighlight").addEventListener("click", highlightTop);
 
let totalStudent = 0;
let presentStudent = 0;
 
 
function checkField(){
 
let name = document.getElementById("nameInput").value;
 
if(name === ""){
document.getElementById("addStudentBtn").disabled = true;
}
else{
document.getElementById("addStudentBtn").disabled = false;
}
 
}
 
 
function addData(e){
 
e.preventDefault();
 
let roll = document.getElementById("rollInput").value;
let name = document.getElementById("nameInput").value;
 
if(roll === "" || name === ""){
alert("Enter roll and name");
return;
}
 
let li = document.createElement("li");
li.classList.add("studentCard");
 
let span = document.createElement("span");
span.textContent = roll + " - " + name;
 
 
let check = document.createElement("input");
check.type = "checkbox";
 
check.addEventListener("change", function(){
 
if(check.checked){
li.classList.add("presentStyle");
presentStudent++;
}
else{
li.classList.remove("presentStyle");
presentStudent--;
}
 
updateAttendance();
 
});
 
 
let edit = document.createElement("button");
edit.textContent = "Edit";
edit.classList.add("editBtn");
 
edit.addEventListener("click", function(){
 
let parts = span.textContent.split(" - ");
 
let newRoll = prompt("Edit Roll", parts[0]);
let newName = prompt("Edit Name", parts[1]);
 
if(newRoll !== null && newName !== null){
span.textContent = newRoll + " - " + newName;
}
 
});
 
 
let del = document.createElement("button");
del.textContent = "Delete";
del.classList.add("deleteBtn");
 
del.addEventListener("click", function(){
 
let confirmDelete = confirm("Delete this student?");
 
if(confirmDelete){
 
if(li.classList.contains("presentStyle")){
presentStudent--;
}
 
li.remove();
totalStudent--;
 
updateTotal();
updateAttendance();
 
}
 
});
 
 
li.appendChild(span);
li.appendChild(check);
li.appendChild(edit);
li.appendChild(del);
 
document.getElementById("listArea").appendChild(li);
 
totalStudent++;
 
updateTotal();
updateAttendance();
 
document.getElementById("rollInput").value="";
document.getElementById("nameInput").value="";
 
}
 
 
function updateTotal(){
 
document.getElementById("totalCount").textContent =
"Total students: " + totalStudent;
 
}
 
 
function updateAttendance(){
 
let absent = totalStudent - presentStudent;
 
document.getElementById("attendanceCount").textContent =
"Present: " + presentStudent + " , Absent: " + absent;
 
}
 
 
function searchStudent(){
 
let text = document.getElementById("searchBox").value.toLowerCase();
 
let students = document.querySelectorAll(".studentCard");
 
students.forEach(function(item){
 
let value = item.textContent.toLowerCase();
 
if(value.includes(text)){
item.style.display = "flex";
}
else{
item.style.display = "none";
}
 
});
 
}
 
 
function sortList(){
 
let ul = document.getElementById("listArea");
 
let items = Array.from(ul.children);
 
items.sort(function(a,b){
 
let A = a.textContent.toLowerCase();
let B = b.textContent.toLowerCase();
 
if(A > B) return 1;
if(A < B) return -1;
return 0;
 
});
 
items.forEach(function(li){
ul.appendChild(li);
});
 
}
 
 
function highlightTop(){
 
let students = document.querySelectorAll(".studentCard");
 
students.forEach(function(s){
s.classList.remove("highlightTop");
});
 
if(students.length > 0){
students[0].classList.add("highlightTop");
}
 
}