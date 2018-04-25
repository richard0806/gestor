<!DOCTYPE html>
<html>
<head>
	<title>WOWSlider</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="WOWSlider" />
	
	<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
	<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->


<style>
.instuction {
	font-family: sans-serif, Arial;
	display: block;
	margin: 0 auto;
	max-width: 820px;
	width: 100%;
	padding: 0 70px;
	color: #222;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.instuction h1 img {
	max-width: 170px;
	vertical-align: middle;
	margin-bottom: 10px;
}
.instuction h1 {
	color: #2F98B3;
	text-align: center;
}
.instuction h2 {
	position: relative;
	font-size: 1.1em;
	color: #2F98B3;
	margin-bottom: 20px;
	margin-top: 40px;
}
.instuction h2 span.num {
	position: absolute;
	left: -70px;
	top: -18px;
	display: inline-block;
	vertical-align: middle;
	font-style: italic;
	font-size: 1.1em;
	width: 60px;
	height: 60px;
	line-height: 60px;
	text-align: center;
	background: #2F98B3;
	color: #fff;
	border-radius: 50%;
}
.instuction .mono {
	color: #000;
	font-family: monospace;
	font-size: 1.3em;
	font-weight: normal;
}
.instuction li.mono {
	font-size: 1.5em;
}

.instuction ul {
	font-size: 0.9em;
	margin-top: 0;
	padding-left: 0;
	list-style: none;
}
.instuction .note {
	color: #A3A3B2;
	font-style: italic;
	padding-top: 10px;
}
.instuction p.note {
	text-align: center;
	padding-top: 0;
	margin-top: 4px;
}
.instuction textarea {
	font-size: 0.9em;
	min-height: 60px;
	padding: 10px;
	margin: 0;
	overflow: auto;
	max-width: 100%;
	width: 100%;
}
.instuction a,
.instuction a:visited {
	color: #2F98B3;
}
</style>


</head>
<body style="margin:auto">

<br>

<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
<div id="wowslider-container1">
<div class="ws_images"><ul>
		<li><img src="data1/images/siemens.jpg" alt="INFRAESTRUCTURA DE CIUDADES" title="INFRAESTRUCTURA DE CIUDADES" id="wows1_0"/>Innovaciones al alcance de tus manos.</li>
		<li><img src="data1/images/slide1.jpg" alt="Gestor de Mantenimiento" title="Gestor de Mantenimiento" id="wows1_1"/>Avanzando para un futuro mejor.</li>
		<li><a href="http://wowslider.com"><img src="data1/images/slide31.jpg" alt="wordpress slider" title="Siemens " id="wows1_2"/></a>Ayudando al crecimiento para forjar nuevos horizontes.</li>
		<li><img src="data1/images/slide41.jpg" alt="A Nivel Gral" title="A Nivel Gral" id="wows1_3"/>Todo tipo de servicios a tu comodidad.</li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title="INFRAESTRUCTURA DE CIUDADES"><span><img src="data1/tooltips/siemens.jpg" alt="INFRAESTRUCTURA DE CIUDADES"/>1</span></a>
		<a href="#" title="Gestor de Mantenimiento"><span><img src="data1/tooltips/slide1.jpg" alt="Gestor de Mantenimiento"/>2</span></a>
		<a href="#" title="Siemens "><span><img src="data1/tooltips/slide31.jpg" alt="Siemens "/>3</span></a>
		<a href="#" title="A Nivel Gral"><span><img src="data1/tooltips/slide41.jpg" alt="A Nivel Gral"/>4</span></a>
	</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">free jquery slider</a> by WOWSlider.com v7.5</div>
<div class="ws_shadow"></div>
</div>	
<script type="text/javascript" src="engine1/wowslider.js"></script>
<script type="text/javascript" src="engine1/script.js"></script>
<!-- End WOWSlider.com BODY section -->


<div class="instuction">
	<p class="note">HTML code for the slider <a href="file:///C:/xampp/htdocs/almacen_siemens/global/CarrouselMain.php">C:/xampp/htdocs/almacen_siemens/global/CarrouselMain.php</a></p>

	<h1>
		How to add this slider to HTML page
	</h1>

	<h2><span class="num">1</span> Upload these folders to your server</h2>
	<ul>
		<li class="mono">data1/</li>
		<li class="mono">engine1/</li>
		<li class="note">Current location: <a href="file:///C:/xampp/htdocs/almacen_siemens/global">C:/xampp/htdocs/almacen_siemens/global</a>. <br>These folders should be located in the same folder as your html page</li>
	</ul>

	<h2><span class="num">2</span> Paste this code to your page between the tags <span class="mono">&lt;head&gt;&lt;/head&gt;</span></h2>
	<textarea onclick="this.select()">&lt;!-- Start WOWSlider.com HEAD section --&gt;
&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;engine1/style.css&quot; /&gt;
&lt;script type=&quot;text/javascript&quot; src=&quot;engine1/jquery.js&quot;&gt;&lt;/script&gt;
&lt;!-- End WOWSlider.com HEAD section --&gt;</textarea>


	<h2><span class="num" style="top: -8px;">3</span> Paste this code to your page between the tags <span class="mono">&lt;body&gt;&lt;/body&gt;</span> in the place that you want the slider to appear</h2>
	<textarea onclick="this.select()" rows="15">&lt;!-- Start WOWSlider.com BODY section --&gt;
&lt;div id=&quot;wowslider-container1&quot;&gt;
&lt;div class=&quot;ws_images&quot;&gt;&lt;ul&gt;
		&lt;li&gt;&lt;img src=&quot;data1/images/siemens.jpg&quot; alt=&quot;INFRAESTRUCTURA DE CIUDADES&quot; title=&quot;INFRAESTRUCTURA DE CIUDADES&quot; id=&quot;wows1_0&quot;/&gt;Innovaciones al alcance de tus manos.&lt;/li&gt;
		&lt;li&gt;&lt;img src=&quot;data1/images/slide1.jpg&quot; alt=&quot;Gestor de Mantenimiento&quot; title=&quot;Gestor de Mantenimiento&quot; id=&quot;wows1_1&quot;/&gt;Avanzando para un futuro mejor.&lt;/li&gt;
		&lt;li&gt;&lt;a href=&quot;http://wowslider.com&quot;&gt;&lt;img src=&quot;data1/images/slide31.jpg&quot; alt=&quot;wordpress slider&quot; title=&quot;Siemens &quot; id=&quot;wows1_2&quot;/&gt;&lt;/a&gt;Ayudando al crecimiento para forjar nuevos horizontes.&lt;/li&gt;
		&lt;li&gt;&lt;img src=&quot;data1/images/slide41.jpg&quot; alt=&quot;A Nivel Gral&quot; title=&quot;A Nivel Gral&quot; id=&quot;wows1_3&quot;/&gt;Todo tipo de servicios a tu comodidad.&lt;/li&gt;
	&lt;/ul&gt;&lt;/div&gt;
	&lt;div class=&quot;ws_bullets&quot;&gt;&lt;div&gt;
		&lt;a href=&quot;#&quot; title=&quot;INFRAESTRUCTURA DE CIUDADES&quot;&gt;&lt;span&gt;&lt;img src=&quot;data1/tooltips/siemens.jpg&quot; alt=&quot;INFRAESTRUCTURA DE CIUDADES&quot;/&gt;1&lt;/span&gt;&lt;/a&gt;
		&lt;a href=&quot;#&quot; title=&quot;Gestor de Mantenimiento&quot;&gt;&lt;span&gt;&lt;img src=&quot;data1/tooltips/slide1.jpg&quot; alt=&quot;Gestor de Mantenimiento&quot;/&gt;2&lt;/span&gt;&lt;/a&gt;
		&lt;a href=&quot;#&quot; title=&quot;Siemens &quot;&gt;&lt;span&gt;&lt;img src=&quot;data1/tooltips/slide31.jpg&quot; alt=&quot;Siemens &quot;/&gt;3&lt;/span&gt;&lt;/a&gt;
		&lt;a href=&quot;#&quot; title=&quot;A Nivel Gral&quot;&gt;&lt;span&gt;&lt;img src=&quot;data1/tooltips/slide41.jpg&quot; alt=&quot;A Nivel Gral&quot;/&gt;4&lt;/span&gt;&lt;/a&gt;
	&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;ws_script&quot; style=&quot;position:absolute;left:-99%&quot;&gt;&lt;a href=&quot;http://wowslider.com&quot;&gt;free jquery slider&lt;/a&gt; by WOWSlider.com v7.5&lt;/div&gt;
&lt;div class=&quot;ws_shadow&quot;&gt;&lt;/div&gt;
&lt;/div&gt;	
&lt;script type=&quot;text/javascript&quot; src=&quot;engine1/wowslider.js&quot;&gt;&lt;/script&gt;
&lt;script type=&quot;text/javascript&quot; src=&quot;engine1/script.js&quot;&gt;&lt;/script&gt;
&lt;!-- End WOWSlider.com BODY section --&gt;</textarea>

<br><br>
<h2>Also you can try the <a href="http://wowslider.com/help/add-wowslider-to-page-2.html" target="_blank">Insert-To-Page wizard</a>, to add the slider visually, without touching the code!</h2>
<p>
	<a href="http://wowslider.com/help/add-wowslider-to-page-2.html" target="_blank">Click here</a> for the detailed info.
</p>
</div>

<br><br>
</body>
</html>