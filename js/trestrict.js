function manage(c)
{
    if(c.id.slice(-1) == 'B')
    {
        var a = document.getElementById(c.id.slice(0,-1))
    }
    else
    {
        var a = document.getElementById(c.id+'B');
    }    
    var b = document.getElementById('upload');
    if(c.value !='')
    {    	
    	a.required = true;
    	b.disabled = false;
    }
    else
    {
    	a.required = false;
    	b.disabled = true;
    } 	  
}

function check(a)
{
    if(a.id.slice(-1) == 'B')
    {
        var b = document.getElementById(a.id.slice(0,-1))
    }
    else
    {
        var b = document.getElementById(a.id+'B');
    }
    
    if(a.value.length > 0)
    {
        b.required = true;
    }
    else
    {
        b.required = false;
    }
}