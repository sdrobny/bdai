
//Manage menus
function setMenu() {
    var w = window.innerWidth;
    var h = window.innerHeight;

    var mobileMenu =  document.getElementById('menu-mobile');
    var mobileTopBar = document.getElementById('topbar-mobile');
    var desktopTopBar = document.getElementById('topbar-desktop');
    mobileMenu.style.display = 'none';


    if (w > 768) {
        //Desktop
        mobileTopBar.style.display = 'none';
        desktopTopBar.style.display = 'block';

    } else {
        mobileTopBar.style.display = 'block';
        desktopTopBar.style.display = 'none';
    }
}

window.onload = function () {
    setMenu();
    var mobileButton = document.getElementById('mobile-menu-button');
    mobileButton.onclick = function () {
        toggleMenu();
    }

}

window.onresize = function () {
    setMenu();
}
//***********************************************************************

//Mobile menu button
function toggleMenu(){

    var mobileMenu =  document.getElementById('menu-mobile');
    var mobileButton = document.getElementById('mobile-menu-button');

    if (mobileMenu.style.display == 'none' ) {
        mobileMenu.style.display = 'block';
        mobileButton.setAttribute('value','Schowaj menu');
    } else {
        mobileMenu.style.display = 'none';
        mobileButton.setAttribute('value','Otwórz menu');
    }

}

//***********************************************************************

//Scroll 

function setSection() {

    var sections = [];
    var currentId = '';

    //add sections to array
    sections.push(document.getElementById('conference'));
    sections.push(document.getElementById('description'));
    sections.push(document.getElementById('events'));
    sections.push(document.getElementById('dates'));
    sections.push(document.getElementById('organizers'));

    for (var i = 0; i < sections.length; i++) {

        if (window.pageYOffset >= sections[i].offsetTop - (sections[i].offsetHeight/100) && window.pageYOffset < sections[i].offsetTop + sections[i].offsetHeight ) {
            currentId = sections[i].id;
        }

    }

    console.log(currentId);

    var desktopMenu = document.getElementById('desktop-menu').children;
	var mobileMenu = document.getElementById('mobile-menu').children;
    for (var i = 0; i < desktopMenu.length; i++) {

        desktopMenu[i].classList.remove('item-selected');
        mobileMenu[i].classList.remove('item-selected');

        if (desktopMenu[i].attributes.getNamedItem('data-target').value == currentId) {
            desktopMenu[i].classList.add('item-selected');
            mobileMenu[i].classList.add('item-selected');
            console.log(currentId);
        }
    }








}

document.onscroll = function () {

    var desktopTopBar = document.getElementById('topbar-desktop');

    if (window.pageYOffset > 100) {
        desktopTopBar.classList.add('topbar-desktop-fixed');
    } else {
        desktopTopBar.classList.remove('topbar-desktop-fixed');
    }

    setSection();

}

