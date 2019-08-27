function toggle(divToShow) 
{
	if (document.getElementById) 
	{
		if (divToShow.value == 'Y')
		{	  
		document.getElementById('withdiv4').style.display = 'block';
		} 
		else
		{	
		document.getElementById('withdiv4').style.display = 'none';
		}
	}
}