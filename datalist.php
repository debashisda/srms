<html>
<head>
	<title>Searching</title>
	<script type="text/javascript">
		function search_subject()
		{	
			var url = "ajaxlist.php?sub_name=" + document.form1.sub.value;
			var reqObj = new XMLHttpRequest();
			if(reqObj)
			{
				reqObj.onreadystatechange = function ()
				{
					if(reqObj.readyState == 4 && reqObj.status == 200)
					{
						document.getElementById('subject_list').innerHTML = reqObj.responseText;
					}
				}
				reqObj.open("GET",url,true);
				reqObj.send();
			}
		}
	</script>
	<style type="text/css">
		input[type='text']{
			border-radius: 15px;
			padding: 5px;
			padding-left: 15px;
		}
	</style>
</head>
<body>
	<form name="form1" method="post">		
		<table align="center" cellpadding="3">
			<tr>				
				<td><input type="text" name="sub" list="subject_list" onkeyup="search_subject()" size="50" placeholder="Search Subjects..."></td>
			</tr>
		</table>
		<datalist id="subject_list"></datalist>
	</form>
</body>
</html>