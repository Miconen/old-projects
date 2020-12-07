function setRank() {
document.querySelector('.profileStatLine b').innerHTML = '<a href="https://osu.ppy.sh/help/wiki/Performance_Points">Performance</a>: '+ pp +'pp (#'+ rank +')';
var flag = document.querySelector('.profileStatLine > span > a').innerHTML;
document.querySelector('.profileStatLine > span').innerHTML = flag + "#" + countryRank;
};
var pp = prompt("PP?");
var rank = prompt("Rank?");
var countryRank = prompt("Country rank?");
setRank();