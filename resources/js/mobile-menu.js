let mobileMenuButton = document.querySelector('#mobile-menu-button');

mobileMenuButton.addEventListener('click', toggleMobileMenu);

function toggleMobileMenu(){
    const mobileMenu = document.getElementById("mobile-content");
    const openIcon = document.getElementById("openIcon");
    const closeIcon = document.getElementById("closeIcon");
    
    if(mobileMenu.style.display === "none"){
        mobileMenu.style.display = "block";
        openIcon.style.display = "none";
        closeIcon.style.display = "block";
    } else {
        mobileMenu.style.display = "none";
        openIcon.style.display = "block";
        closeIcon.style.display = "none";
    }
}