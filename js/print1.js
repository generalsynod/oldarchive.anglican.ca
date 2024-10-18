// JavaScript Document
/* call user engagement gif */

function usrActionReg(which,action) 
{
	if (action == 20) {
         window.print ();  
      }
      else if (action == 19) {
      	location.href='mailto:?subject='+encodeURIComponent(document.title)+'&body='+encodeURIComponent(location.href);
      }
}