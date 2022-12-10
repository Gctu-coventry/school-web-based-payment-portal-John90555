<html>
    <head>
        <title>
UNAUTHORIZED
        </title>
        <link rel="stylesheet" href="../styles/unauthorized.scss" />

    </head>
    <body>
        
    <div class='grid' data-columns>
<section class='block'>
  <p><span class='b0'></span></p>
  <p><span class='b1'></span></p>
</section>
<section class = 'block'>
  <p><span class='b1'></span></p>
  <p><span class='b4'></span></p>
  <p><span class='b5'></span></p>
</section>
<section class = 'block'>
  <p><span class='b1'></span></p>
  <p><span class='b4'></span></p>
  <p><span class='b5'></span></p>
</section>
<section class='block'>
  <p><span class='b4'></span></span></p>
  <p><span class='b1'></span></p>
  <p><span class='b1'></span></p>
</section>
<section class='block'>
  <p><span class='b1'></span></p>
  <p><span class='b4 indent6'></span></p>
</section>
<section class='block'>
  <p><span class='b0'></span></p>
  <p><span class='b1'></span></p>
</section>
<section class = 'block'>
  <p><span class='b1'></span></p>
  <p><span class='b4'></span></p>
  <p><span class='b5'></span></p>
</section>
<section class = 'block'>
  <p><span class='b1'></span></p>
  <p><span class='b4'></span></p>
  <p><span class='b5'></span></p>
</section>
<section class='block'>
  <p><span class='b4'></span></span></p>
  <p><span class='b1'></span></p>
  <p><span class='b1'></span></p>
</section>
<section class='block'>
  <p><span class='b1'></span></p>
  <p><span class='b4 indent6'></span></p>
</section>
<section class='block'>
  <p><span class='b0'></span></p>
  <p><span class='b1'></span></p>
</section>
<section class = 'block'>
  <p><span class='b1'></span></p>
  <p><span class='b4'></span></p>
  <p><span class='b5'></span></p>
</section>
<section class = 'block'>
  <p><span class='b1'></span></p>
  <p><span class='b4'></span></p>
  <p><span class='b5'></span></p>
</section>
<section class='block'>
  <p><span class='b4'></span></span></p>
  <p><span class='b1'></span></p>
  <p><span class='b1'></span></p>
</section>
<section class='block'>
  <p><span class='b1'></span></p>
  <p><span class='b4'></span></p>
</section>
</div>

<section class='err'>
  <div id="str"></div>
</section> 
<img src="../images/unauth.png" style="width:30px">
    </body>
</html>
<script>
    var $ = function(id) {
  return document.getElementById(id);
};
var el = $("str");
var s = "--ERROR: 401_[UNAUTHORIZED]-- "; 
var s1 = "-YOU ARE NOT PERMITTED TO VIEW THIS PAGE-";
setInterval("shuffle(s  + s1 )",50);
var t = 0;
var o = 0.5;
function shuffle(str){
	var caps = str.toUpperCase();
	var char = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	var calc;
		for(n = 0; n < caps.length; n++){
			calc = Math.floor(Math.random()*char.length);
			if(n == 0)el.innerHTML = (t >= 0) ? caps.charAt(0) : char.charAt(calc);
			if(n >= 1)el.innerHTML += (t >= 0 + n * 2) ? caps.charAt(n) : char.charAt(calc);
		}
	o += 1 / (0 + caps.length * 2);
	el.style.opacity = o;
	t++;
}
//click text to reload
function reload() {
  window.location.href = window.location.href;
}
$('str').onclick = reload;

</script>
