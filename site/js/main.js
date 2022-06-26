function arrows() {
	var scrollTop = document.getElementById('fade-enabled').scrollTop;
	var scrollHeight = document.getElementById('fade-enabled').scrollHeight;
	var offsetHeight = document.getElementById('fade-enabled').offsetHeight;
	var contentHeight = scrollHeight - offsetHeight;
	if (contentHeight <= scrollTop) {
		document.getElementById("arrow-down").style.opacity = 0 + "%";
		document.getElementById("breadcrumb").style.opacity = 100 + "%";
		document.getElementById("breadcrumb").style.pointerEvents = "initial";
	} else {
		document.getElementById("arrow-down").style.opacity = 100 + "%";
		document.getElementById("breadcrumb").style.opacity = 0 + "%";
		document.getElementById("breadcrumb").style.pointerEvents = "none";
	}

	if (0 >= scrollTop) {
		document.getElementById("arrow-up").style.opacity = 0 + "%";
	} else {
		document.getElementById("arrow-up").style.opacity = 100 + "%";
	}
}

function toggleFit(){
	var state = document.getElementById('fit-page');
	if (state.checked){
		document.getElementById('page').classList.add('reader-image-height');
		document.getElementById('page').classList.remove('reader-image-width');
		document.getElementById('page-holder').style.width = "initial";
	}
	else{
		document.getElementById('page').classList.remove('reader-image-height');
		document.getElementById('page').classList.add('reader-image-width');
		document.getElementById('page-holder').style.width = 100 + "%";
	}
	arrows();
}


function init() {
	if (document.querySelector('#arrow-down') || document.querySelector('#arrow-up')) {
		arrows();
		document.getElementById('fade-enabled').addEventListener('scroll', arrows, false)
		window.addEventListener("resize", arrows, false)
		window.addEventListener("DOMContentLoaded", arrows, false)
		window.addEventListener("load", arrows, false)
		if (document.getElementById('fit-page') != null)
			document.getElementById('fit-page').addEventListener('change', toggleFit);
	}
}

function unload() {
	if (document.querySelector('#arrow-down') || document.querySelector('#arrow-up')) {
		document.getElementById('fade-enabled').removeEventListener('scroll', arrows)
		window.removeEventListener("resize", arrows)
		window.removeEventListener("DOMContentLoaded", arrows)
	}
}

const swup = new Swup();

// run once 
init();

// this event runs for every page view after initial load
swup.on('contentReplaced', init);

swup.on('willReplaceContent', unload);

swup.on('clickLink', () => document.getElementById("swup").style.pointerEvents = "none");
swup.on('transitionEnd', () => document.getElementById("swup").style.pointerEvents = "initial");
swup.on('contentReplaced', () => document.getElementById("swup").style.pointerEvents = "none");