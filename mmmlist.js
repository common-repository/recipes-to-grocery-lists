function mmm_Place_link()
{
	//window.parent.mmm_Place_link_main('Krishna');
	//alert('hello');
	var chkBox=1;
	if( document.getElementById('mmmlist_check1').checked)
	{
		chkBox=0;
	}
	var txt;
	txt = document.getElementById('mmmlist_text').value;
	window.parent.mmm_Place_link_main(chkBox,txt);
}
