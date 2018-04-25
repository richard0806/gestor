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
		<li><img src="data1/images/slide1.jpg" alt="slide1" title="slide1" id="wows1_0"/></li>
		<li><a href="http://wowslider.com"><img src="data1/images/slide31.jpg" alt="slider wordpress" title="slide31" id="wows1_1"/></a></li>
		<li><img src="data1/images/slide41.jpg" alt="slide41" title="slide41" id="wows1_2"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title="slide1"><span><img src="data1/tooltips/slide1.jpg" alt="slide1"/>1</span></a>
		<a href="#" title="slide31"><span><img src="data1/tooltips/slide31.jpg" alt="slide31"/>2</span></a>
		<a href="#" title="slide41"><span><img src="data1/tooltips/slide41.jpg" alt="slide41"/>3</span></a>
	</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">slideshow html</a> by WOWSlider.com v7.5</div>
<div class="ws_shadow"></div>
</div>	
<script type="text/javascript" src="engine1/wowslider.js"></script>
<script type="text/javascript" src="engine1/script.js"></script>
<!-- End WOWSlider.com BODY section -->


<div class="instuction">
	<p class="note">HTML code for the slider <a href="file:///C:/xampp/htdocs/almacen_siemens/global/Sliders/Slider1.php">C:/xampp/htdocs/almacen_siemens/global/Sliders/Slider1.php</a></p>

	<h1>
		How to add this slider to HTML page
	</h1>

	<h2><span class="num">1</span> Upload these folders to your server</h2>
	<ul>
		<li class="mono">data1/</li>
		<li class="mono">engine1/</li>
		<li class="note">Current location: <a href="file:///C:/xampp/htdocs/almacen_siemens/global/Sliders">C:/xampp/htdocs/almacen_siemens/global/Sliders</a>. <br>These folders should be located in the same folder as your html page</li>
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
		&lt;li&gt;&lt;img src=&quot;data1/images/slide1.jpg&quot; alt=&quot;slide1&quot; title=&quot;slide1&quot; id=&quot;wows1_0&quot;/&gt;&lt;/li&gt;
		&lt;li&gt;&lt;a href=&quot;http://wowslider.com&quot;&gt;&lt;img src=&quot;data1/images/slide31.jpg&quot; alt=&quot;slider wordpress&quot; title=&quot;slide31&quot; id=&quot;wows1_1&quot;/&gt;&lt;/a&gt;&lt;/li&gt;
		&lt;li&gt;&lt;img src=&quot;data1/images/slide41.jpg&quot; alt=&quot;slide41&quot; title=&quot;slide41&quot; id=&quot;wows1_2&quot;/&gt;&lt;/li&gt;
	&lt;/ul&gt;&lt;/div&gt;
	&lt;div class=&quot;ws_bullets&quot;&gt;&lt;div&gt;
		&lt;a href=&quot;#&quot; title=&quot;slide1&quot;&gt;&lt;span&gt;&lt;img src=&quot;data1/tooltips/slide1.jpg&quot; alt=&quot;slide1&quot;/&gt;1&lt;/span&gt;&lt;/a&gt;
		&lt;a href=&quot;#&quot; title=&quot;slide31&quot;&gt;&lt;span&gt;&lt;img src=&quot;data1/tooltips/slide31.jpg&quot; alt=&quot;slide31&quot;/&gt;2&lt;/span&gt;&lt;/a&gt;
		&lt;a href=&quot;#&quot; title=&quot;slide41&quot;&gt;&lt;span&gt;&lt;img src=&quot;data1/tooltips/slide41.jpg&quot; alt=&quot;slide41&quot;/&gt;3&lt;/span&gt;&lt;/a&gt;
	&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;ws_script&quot; style=&quot;position:absolute;left:-99%&quot;&gt;&lt;a href=&quot;http://wowslider.com&quot;&gt;slideshow html&lt;/a&gt; by WOWSlider.com v7.5&lt;/div&gt;
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