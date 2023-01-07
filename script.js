//icons menu

function myFunction(x) {
  x.classList.toggle("change");
}

//meni

function toggleNav() {
  navSize = document.getElementById("myNav").style.width;
  if (navSize == '250px') {
    return close();
  }
  return open();
}

function open() {
  document.getElementById("myNav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "80px";
  document.content.style.backgroundColor = "rgba(0,0,0,0)";
}

function close() {
  document.getElementById("myNav").style.width = "80px";
  document.getElementById("main").style.marginLeft = "80px";
  document.body.style.backgroundColor = "";
}

//baton

$(document).ready(function() {
  $('[data-toggle="toggle"]').click( function() {
    $(this).parents().next('.hide').toggle();});
	
});