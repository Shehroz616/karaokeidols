let menuToggle = document.querySelector(".menu-toggle")
let layoutMenu = document.querySelector("#layout-menu")
let appBrandLogo = document.querySelector(".full-logo")
let logoIcon = document.querySelector(".logo-icon")
let mobileArrow = document.querySelector(".mobile-arrow") 
let toggle = false

if (menuToggle) {
    menuToggle.addEventListener("click",(e)=>{
    
        if (!toggle) {
            layoutMenu.classList.add("collapsed")
            appBrandLogo.classList.add("hidding")
            setTimeout(() => {
                logoIcon.classList.add("show")
                logoIcon.classList.add("showing")
                appBrandLogo.classList.add("hide")
                appBrandLogo.classList.remove("show")
                appBrandLogo.classList.remove("hidding")
                setTimeout(() => {
                    logoIcon.classList.remove("showing")
                }, 300);
            }, 300);
            toggle = true
        }
        else{
            layoutMenu.classList.remove("collapsed")
            logoIcon.classList.add("hidding")
            setTimeout(() => {
                logoIcon.classList.add("hide")
                logoIcon.classList.remove("show")
                logoIcon.classList.remove("hidding")
                appBrandLogo.classList.add("show")
                appBrandLogo.classList.add("showing")
                setTimeout(() => {
                    appBrandLogo.classList.remove("showing")
                }, 300);
            }, 300);
            toggle = false
        }
    
    })
}

let toggle2 = false

mobileArrow.addEventListener("click",()=>{
    if (!toggle2) {
        layoutMenu.style.left="12px"
        mobileArrow.style.left = "112px"
        mobileArrow.firstElementChild.style.transform = "rotate(180deg)"
        toggle2 =true
    } else{
        layoutMenu.style.left="-112px"
        mobileArrow.style.left = "0px"
        mobileArrow.firstElementChild.style.transform = "rotate(0deg)"
        toggle2 =false
    }
})

function toggleDropdown() {
    var dropdown = document.getElementById("profile-dropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

document.addEventListener('click', function(event) {
    var dropdown = document.getElementById("profile-dropdown");
    var menuBtn = document.querySelector('.top-menu-btn');
    if (!menuBtn.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});