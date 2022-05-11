let a = document.URL.split('/')[5].split('.php')[0];
let b = document.getElementById('back');
let c = 'http://127.0.0.1/srms/teacher/'
if ( a == "dashboard")
{
	b.remove();
}

if ( a == "update_common")
{
	b.setAttribute('href', c + 'moredetails.php?'+ document.URL.split('?')[1].split('&')[0]);
}

if ( a == "moredetails" )
{
	b.setAttribute('href', c + 'dashboard.php');
}