function arrows(){var e=document.getElementById("fade-enabled").scrollTop,t=document.getElementById("fade-enabled").scrollHeight-document.getElementById("fade-enabled").offsetHeight;document.getElementById("arrow-down").style.opacity=t<=e?"0%":"100%",document.getElementById("arrow-up").style.opacity=0>=e?"0%":"100%"}document.getElementById("fade-enabled").addEventListener("scroll",arrows,!1),window.addEventListener("resize",arrows,!1),window.addEventListener("DOMContentLoaded",arrows,!1);