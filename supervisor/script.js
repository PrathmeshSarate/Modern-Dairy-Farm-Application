const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
const customer = document.getElementsByClassName('customer');

// alert(customer);
// customer.style.display = "none";

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
			

		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

document.addEventListener("DOMContentLoaded", function() {
	var loader = document.querySelector(".loader");
	var content = document.querySelector("#content main");

	loader.classList.add("show");

	setTimeout(function() {
		loader.style.opacity = "0"; // Set the opacity to 0 after 10 seconds
		setTimeout(function() {
			loader.style.display = "none"; // Hide the loader after the transition
			content.style.opacity = "1"; // Show the content with smooth transition
		}, 500); // Hide loader after the transition duration (1 second)
	}, 500); // Start hiding loader after 10 seconds
});



