function arrows() {
	var scrollTop = document.getElementById('fade-enabled').scrollTop;
	var scrollHeight = document.getElementById('fade-enabled').scrollHeight; // added
	var offsetHeight = document.getElementById('fade-enabled').offsetHeight;
	// var clientHeight = document.getElementById('box').clientHeight;
	var contentHeight = scrollHeight - offsetHeight; // added
	if (contentHeight <= scrollTop) // modified
	{
		document.getElementById("arrow-down").style.opacity = 0 + "%";
	} else {
		document.getElementById("arrow-down").style.opacity = 100 + "%";
	}

	if (0 >= scrollTop) {
		document.getElementById("arrow-up").style.opacity = 0 + "%";
	} else {
		document.getElementById("arrow-up").style.opacity = 100 + "%";
	}
}

document.getElementById('fade-enabled').addEventListener('scroll', arrows, false)
window.addEventListener("resize", arrows, false)
window.addEventListener("DOMContentLoaded", arrows, false)