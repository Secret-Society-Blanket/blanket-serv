const colors = ['r', 'o', 'y', 'g', 'tq', 'lb', 'db', 'dp', 'lp', 'p'];

const rainbowClass = 'rainbow';
const floatClass = 'rainbow-float';
const colorClass = 'rainbow-color';

const rainbowLinkClass = 'rainbow-link';
const linkFloatClass = 'rainbow-link-float';
const linkColorClass = 'rainbow-link-color';

const colorPrefix = 'rain-';


document.addEventListener('DOMContentLoaded', rainbowifyAll);
document.addEventListener('swup:contentReplaced', rainbowifyAll);  

function rainbowifyAll() {
	let rainbow = document.querySelectorAll(`.${rainbowClass}`);
	rainbow.forEach(e => rainbowify(e, floatClass, colorClass));

	let rainbowLinks = document.querySelectorAll(`.${rainbowLinkClass}`);
	rainbowLinks.forEach(e => rainbowify(e, linkFloatClass, linkColorClass));
}

function rainbowify(e, floatClass, colorClass) {
	if(e.children.length > 0) {
		e.children.forEach(rainbowify);
		return;
	}

	let letters = e.innerText.split('');
	let curColorId = 0;
	let rainbowHTML = '';

	letters.forEach(l => {
		let curColor = colorPrefix + colors[curColorId % colors.length];
		if (l.trim().length == 0) {
			rainbowHTML += ' ';
		} else {
			rainbowHTML += `<span class="${floatClass} ${curColor}"><span class="${colorClass} ${curColor}">${l}</span></span>`;
			curColorId++;
		}
	});

	e.innerHTML = rainbowHTML;
}