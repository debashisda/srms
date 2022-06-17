let a = document.URL.split('/')[5].split('.php')[0];
let b = document.getElementById('back');
let c = window.location.origin + '/srms/teacher/'

if ( a == "result")
{
	b.setAttribute('href', c + 'moredetails.php?'+ document.URL.split('?')[1].split('&')[0]);
}

if ( a == "moredetails" )
{
	b.setAttribute('href', c + 'dashboard.php');
}