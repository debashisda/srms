let href = document.URL.split('/')[5].split('.php')[0];

if ( href == "dashboard")
{
	document.getElementById('back').remove();
}

if ( href == "update" ||  href == "insert")
{
	document.getElementById('back').setAttribute('href','http://127.0.0.1/srms/teacher/moredetails.php?'+ document.URL.split('?')[1]);
}

if ( href == "moredetails" )
{
	document.getElementById('back').setAttribute('href','http://127.0.0.1/srms/teacher/dashboard.php');
}

function manage(c)
{
    var a = document.getElementById(c.id+'B');
    var b = document.getElementById('update');
    if(c.value !='')
    {    	
    	a.disabled = false;
    	a.required = true;
    	b.disabled = false;
    }
    else
    {
    	a.disabled = true;
    	a.required = false;
    	b.disabled = true;
    } 	  
}