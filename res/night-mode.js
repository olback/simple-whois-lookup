const path = "./res/night-mode.css";
const d = new Date();
const hour = d.getHours();

function loadcss(url) {
    const head = document.getElementsByTagName('head')[0],
    link = document.createElement('link');
    link.type = 'text/css';
    link.rel = 'stylesheet';
    link.href = url;
    head.appendChild(link);
    return link;
}

if (hour > 20 || hour < 9) {
    loadcss(path);
}