function submitForm(){
    let name=document.getElementById("name").value;
    let email=document.getElementById("email").value;
    let message=document.getElementById("message").value;

    if(name===""||email===""||message===""){
        alert("Please fill all fields"); return;
    }

    document.getElementById("output").innerHTML=
    "✅ Thank you "+name+", message sent!";

    document.getElementById("name").value="";
    document.getElementById("email").value="";
    document.getElementById("message").value="";
}

// Scroll Reveal
window.addEventListener("scroll", function(){
    let reveals=document.querySelectorAll(".reveal");

    reveals.forEach(function(el){
        let windowHeight=window.innerHeight;
        let elementTop=el.getBoundingClientRect().top;

        if(elementTop < windowHeight - 100){
            el.classList.add("active");
        }
    });
});
