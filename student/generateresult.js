var a = c.split('|');	
var cs = 0;
var cps = 0;
var sgpa = 0;

function gm(l)
{
    switch(l)
    {
       	case 'O' : return 10;
        case 'E' : return 9;
        case 'A' : return 8;
        case 'B' : return 7;
        case 'C' : return 6;
        case 'D' : return 5;
        default  : return 4;
    }
}

var t1 = document.getElementById("rs-1");

for(var i=0; i<a.length; i++)
{	
	var b = a[i].split(':');
	var r = t1.insertRow(-1);
	var n = gm(b[1]);                   
	r.insertCell(0).innerHTML = b[0];
	r.insertCell(1).innerHTML = d[b[0]];
	r.insertCell(2).innerHTML = b[1];
	r.insertCell(3).innerHTML = n;
	r.insertCell(4).innerHTML = b[2];
	r.insertCell(5).innerHTML = (n*b[2]);
	cs+=parseInt(b[2]);
	cps+=parseInt(n*b[2]);
}

var r = t1.insertRow(-1);
r.insertCell(0).innerHTML = "";
r.insertCell(1).innerHTML = "";
r.insertCell(2).innerHTML = "";
r.insertCell(3).innerHTML = "<strong>Total</strong>";
r.insertCell(4).innerHTML = cs;
r.insertCell(5).innerHTML = cps;

sgpa = parseFloat(cps/cs).toFixed(2);
var t2 = document.getElementById("rs-2");
var r = t2.insertRow(-1);
r.insertCell(0).innerHTML = "SGPA";
r.insertCell(1).innerHTML = sgpa;
var r = t2.insertRow(-1);
r.insertCell(0).innerHTML = "Result";
r.insertCell(1).innerHTML = (sgpa>=5.6)?"Pass":"Fail";