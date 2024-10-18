/*******************************************
 * Kaosweaver Expert Breadcrumbs           *
 * by Paul Davis http://www.kaosweaver.com * 
 * Copyright 2003 all rights reserved      *
 *******************************************/
var KW_uTitle=document.title
function KW_breadcrumbs(o,m,n,r,f,q,v) { // v1.3.0
	d=document;l=window.location.toString();s=l.split("/");d1=" <span class='kwspan'>"+m+"</span> "
	if (f!=-1) if (l.indexOf(f)!=-1){sNew = new Array(); for (i=0;i<s.length-1;i++) {sNew[i] = s[i]};
	s = sNew;};i=q;	h="<a href='"+KW_jTrail(l,i)+f+"' class='kwhref'>"+o+"</a>";
	t="<span class='kwtitle'>"+KW_uTitle+"</span>";if (s.length==q) {h=t;d1=""}	w=(r==1)?h+d1:t;
	d.write(w);if (n&&!r) d.write("<br>");if (r==1) for (i=v;i<s.length;i++) {d.write("<a href='");
	d.write(KW_jTrail(l,i)+f+"' class='kwhref'>"+KW_fName(s[i-1])+"</a> <span class='kwspan'>"+m+"</span> ")
	l=window.location.toString();} else for (i=s.length;i>v;i--) {d.write(" <span class='kwspan'>"+m)
	d.write("</span> <a href='"+KW_jTrail(l,i-1)+f+"' class='kwhref'>"+KW_fName(s[i-2])+"</a>");
	l=window.location.toString();}if (n && r) d.write("<br>");w=(r==1)?t:d1+h;if (s.length!=q) d.write(w)
}
function KW_jTrail(l,i){ // v1.3.0
	p=0;for (z=0;z<i;z++)p=l.indexOf("/",p)+1;return l.substring(0,p)
}
function KW_fName(a) { // v1.3.0
	a=unescape(a); g=a.split(' '); for (l=0;l<g.length;l++)	
	g[l]=g[l].toUpperCase().slice(0,1)+g[l].slice(1);retVal=g.join(" "); 
	nList= new Array("about","About the Anglican Church","accp","Presentation to the Anglican Consultative Council","cogs","Council of General Synod","arwg","Anti-Racism Working Group","highlights","COGS Highlights","committees","Committees and Councils of General Synod","acip","Anglican Council of Indigenous Peoples","sc2000","Anglican Indigenous Sacred Circle 2000","sc2005","The Fifth Anglican Indigenous Sacred Circle","circ","Communications and Information Resources Committee","cn","Council of the North","fwmc","Faith","corporations","Corporations of General Synod","pensions","Pension Office Corporation","departments","Departments of General Synod","cir","Communications and Information Resources","posters","Library Posters","video","Anglican Video","fmd","Financial Management & Development","fwm","Faith","gso","General Secretary's Office","archives","General Synod Archives","partnerships","Partnerships Department","pensions","Pension Office Corporation","framework","The Framework","faith","faith & worship","cd","Healthy Parishes","education","Theological Education","hcc","Huron College Conference","hsrg","A Resource Guide for Discussions on Human Sexuality","wmc","The Whole Message Conference ","hs","Human Sexuality","hcc","Huron College Conference","hsrg","A Resource Guide for Discussions on Human Sexuality","identity","Anglican Identity ","baptised","The Ministry of all the Baptized ","om","Ordered Ministries","ordered","Ordered Ministries","wellness","Wellness in Ministry","relationships","Ecumenical & Interfaith Relationships","Financial-Ministries","Financial Ministries","ldtn","Letting Down the Nets","news","News","reports","Reports","about","About the Anglican Church","highlights","COGS Highlights","video","Anglican Video","reports","Reports","im","Indigenous Ministries","newagape","new agape project","info","Info! News from General Synod","1","Issue 1 - March 2008","2","issue 2 - april 2008","info","Info! News from General Synod","2","issue 2 - april 2008","3","issue 3 - may 2008","4","Issue 4 - June 2008","jobs","Job Listings","mission","Mission and Justice","about","About the Anglican Church","news","News","ourwork","Our Work","partners","Partners","wherewework","Where we work","youcanhelp","You can help","action","Areas of Action","anglicancommunion","Anglican Communion in Mission","ecology","Ecology and Economy","ij","Indigenous Justice","mdg","Millenium Development Goals","networking","Education","programs","Progams","ccdp","Canadian Companion Diocese Program","dov","Decade to Overcome Violence","globalrelations","Global Relations","reports","Reports","justicecamps","Justice Camps","people","Partnership Visits and People Exchange","tiii","Theological Students International Internship","students","Students","vim","Volunteers in Mission","christmas","A Christmas Greeting","video","Anglican Video","posters","Library Posters","news","News","news","News","ourwork","Our Work","news","News","reports","Reports","windsor","The Anglican Covenant","fm","Financial Ministries","giftplanning","Gift Planning","mps","Pastoral support for military members and their families")
	for (var x=0;x<nList.length;x=x+2) 	if (a==nList[x]) {retVal=nList[x+1];break;}	
	return retVal;
}