<?php
$needlogin = 1;
$title = "WOWMeter - Settings";
include_once($_SERVER['DOCUMENT_ROOT']."/header.php");
	/* 	
		background types
		normal = 1
		8bit = 2
		neko = 3
		flandre = 4
		weed = 5
		tt = 6
	*/
switch($row['sig_bg']){
	case "2":
		$bg_name = "2";
		$bg_namee = "8-bit doge";
		break;
	case "3":
		$bg_name = "3";
		$bg_namee = "Neko doge";
		break;
	case "4":
		$bg_name = "4";
		$bg_namee = "Flandre Scarlet doge";
		break;
	case "5":
		$bg_name = "5";
		$bg_namee = "Snoop Dogge";
		break;
	case "6":
		$bg_name = "6";
		$bg_namee = "Toontown doge";
		break;
	default:
		$bg_name = "1";
		$bg_namee = "Normal doge";
		break;
}
switch($row['sig_font']){
	case "2":
		$font_namee = "Hand of Sean";
		break;
	default:
		$font_namee = "Comic Sans";
		break;
}
switch($row['bg_color']){
	case "red":
		$bg_color = "Red";
		break;
	case "lime":
		$bg_color = "Lime";
		break;
	case "aqua":
		$bg_color = "Aqua";
		break;
	case "blue":
		$bg_color = "Blue";
		break;
	case "fuchsia":
		$bg_color = "Fuchsia";
		break;
	case "purple":
		$bg_color = "Purple";
		break;
	default:
		$bg_color = "Orange";
		break;
}
require_once($_SERVER['DOCUMENT_ROOT']."/geoip/geoipcity.inc");
require_once($_SERVER['DOCUMENT_ROOT']."/geoip/geoip.inc");
$gi = geoip_open($_SERVER['DOCUMENT_ROOT']."/geoip/GeoLiteCity.dat", GEOIP_STANDARD);
?>
<link rel="stylesheet" href="/css/colpick.css" type="text/css" />
<script src="/js/colpick.js"></script>
	<script type="text/javascript">
	var bgg = '<?=$bg_name?>';
	var fontt = <?=$row['sig_font']?>;
	var bgcolorr = '<?=$bg_color?>';
	function change_bg(bg, name){
		bgg = bg;
		$('#'+bg).prop('checked', true);
		$('#selected_bg').attr('src', '/sig/<?=$username?>?mask=1&bg='+bg+'&font='+fontt+'&bgcolor='+bgcolorr);
		$('#selected_bg_name').html(name);
		$(".fa-spinner").show();
	}
	function change_bgcolor(color){
		bgcolorr = color;
		$('#bgcolor_'+color).prop('checked', true);
		$('#selected_bg').attr('src', '/sig/<?=$username?>?mask=1&bg='+bgg+'&font='+fontt+'&bgcolor='+bgcolorr);
		$('#selected_bgcolor').html(color.charAt(0).toUpperCase() + color.slice(1));
		$(".fa-spinner").show();
	}
	function change_font(font, warning, name){
		fontt = font;
		$('#font_'+font).prop('checked', true);
		$('#selected_font_name').html(name);
		//$('#selected_font').css('background-position', '0px '+ ((24 * font) - 24) + 'px');
		$('#selected_bg').attr('src', '/sig/<?=$username?>?mask=1&bg='+bgg+'&font='+fontt+'&bgcolor='+bgcolorr);
		if(warning){
			$('.font-warning code').html(warning);
			$('.font-warning').show();
		}else{
			$('.font-warning').hide();
		}
		$(".fa-spinner").show();
	}
	$(document).ready(function (){
		$('#selected_bg').load(function(){
			//when bg finishes loadin
			$(".fa-spinner").hide();
		});
		$('#picker').colpick({
			layout:'hex',
			submit:0,
			color: "<?=$row['usrname_color']?>",
			colorScheme:'light',
			onChange:function(hsb,hex,rgb,el,bySetColor) {
				$(el).css({'border-color' : '#'+hex, 'border-width' : ''});
				$("#usrname_color").css('background','#'+hex);
				if(!bySetColor) $(el).val(hex);
			}
		}).keyup(function(){
			$(this).colpickSetColor(this.value);
		});
<?php 
			switch($row['sig_font']){
			case 2:
				echo "$('.font-warning code').html('Greek, Japanese, Turkish');$('.font-warning').show();";
				break;
			} 
		?>
	if(window.outerWidth > 765)$(".account, .signature").css('min-height', Math.max($(".account").outerHeight(), $(".signature").outerHeight()));
	$("ul.dropdown-menu").each(function(){
            var parentWidth = $(this).parent().innerWidth();
            var menuWidth = $(this).innerWidth();
            var margin = (parentWidth / 2 ) - (menuWidth / 2);
            margin = margin - 2 + "px";
            $(this).css("margin-left", margin);
        });
});
$(window).load(function(){
	if(window.outerWidth > 765)$(".account, .signature").css('min-height', Math.max($(".account").outerHeight(), $(".signature").outerHeight()));
});
	</script>
	<style type="text/css">

	</style>
	<div id="preload">
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=1"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=2"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=3"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=4"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=5"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=6"/>
	</div>
	<div class="box small no-title headline">
		<h2>Settings</h2>
	</div>
	<?php
	switch($_GET['alert']){
		case "error":
		echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> An error occurred while updating your settings. :(</div>';
		break;
		case "success":
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your settings are successfully saved. :)</div>';
		break;
		case "no":
		echo '<div class="alert alert-info"><a href="#" class="close" data-dismiss="alert">&times;</a>no</div>';
		break;
	}

	?>
	<form action="process.php?action=update" method="POST">
	<div class="row">
	<div class="box col-md-4 account">
	<div class="title">Account</div>
	<style>
	.member-card{
		border: solid 1px;
		border-radius: 5px;
	}
	.member-card table{
		width: 100%;
	}
	.dropdown-menu img{
		width: 138px;
	}
	</style>
	<div class="member-card">
	<table>
		<tr><td colspan="3" style="border-bottom:solid 1px #eee"><h4 style="margin:5px">User <?=$username?></h4></td></tr>
		<tr><td style="border-right:solid 1px #eee;border-bottom:solid 1px #eee">E-mail</td>
		<td style="color:#424854;border-bottom:solid 1px #eee" colspan="2"><?=$row['email']?></td></tr>
		<tr><td style="border-right:solid 1px #eee;border-bottom:solid 1px #eee">Username</td>
		<td style="color:#424854;border-right:solid 1px #eee"><?=$username?></td>
		<td><a href="process.php?action=changeusrname" style="border-bottom:solid 1px #eee">Change</a></td></tr>
		<tr><td style="border-right:solid 1px #eee;border-bottom:solid 1px #eee">Password</td>
		<td style="color:#424854;border-right:solid 1px #eee;border-bottom:solid 1px #eee">●●●●●●●●●</td>
		<td><a href="process.php?action=changepasswd">Change</a></td></tr>
		<tr><td style="border-right:solid 1px #eee;border-bottom:solid 1px #eee">Reg. Date</td>
		<td style="color:#424854;border-bottom:solid 1px #eee" colspan="2"><?=date('Y-m-d', strtotime($row['regdate']));?></td></tr>
		<tr><td style="border-right:solid 1px #eee">Country</td>
		<td style="color:#424854" colspan="2"><?php $rsGeoData = geoip_record_by_addr($gi, $row['ip']);echo "<img src='/images/flags/".strtolower($rsGeoData->country_code).".gif' title='".$rsGeoData->country_name."' alt='".$rsGeoData->country_name."'/> ".$rsGeoData->country_name;?></td></tr>
	</table>
	</div>
	</div>
	<div class="box col-md-4 col-md-offset-4 signature">
	<i class='fa fa-spinner fa-spin fa-2x' style="color:cyan;position:absolute;top:5px;right:6px;z-index:1;display:none"></i>
	<div class="title">Signature</div>
		<div class="member-card">
	<table>
		<tr><td colspan="3" style="border-bottom:solid 1px #eee;position:relative">
			<img src="/sig/<?=$username?>?mask=1&bg=<?=$bg_name?>" style="position: relative;width:240px;height:66px;z-index: 1;" id="selected_bg"/>
			<div style="position: absolute;top: 0;left: 5px;width: 96%;height: 20px;background: #<?=$row['usrname_color'];?>" id="usrname_color"></div>
		</td></tr>
		<tr><td style="border-right:solid 1px #eee;border-bottom:solid 1px #eee">
		Background
		</td>
		<td style="color:#424854;border-bottom:solid 1px #eee" colspan="2"><div class="btn-group" style="width:100%"><button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" style="width:100%">
    <span id="selected_bg_name"><?=$bg_namee?></span> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="javascript:change_bg(1, 'Normal doge');void(0)" title="Normal doge"><img src="/images/bg/1.png" alt="Normal doge"/><br/>Normal doge</a></li>
    <li><a href="javascript:change_bg(2, '8-bit doge');void(0)" title="8-bit doge"><img src="/images/bg/2.png" alt="8-bit doge"/><br/>8-bit doge</a></li>
    <li><a href="javascript:change_bg(3, 'Neko doge');void(0)" title="Neko doge"><img src="/images/bg/3.png" alt="Neko doge"/><br/>Neko doge</a></li>
    <li><a href="javascript:change_bg(4, 'Flandre Scarlet doge');void(0)" title="Flandre Scarlet doge"><img src="/images/bg/4.png" alt="Flandre Scarlet doge"/><br/>Flandre Scarlet doge</a></li>
    <li><a href="javascript:change_bg(5, 'Snoop Dogge');void(0)" title="Snoop Dogge"><img src="/images/bg/5.png" alt="Snoop Dogge"/><br/>Snoop Dogge</a></li>
    <li><a href="javascript:change_bg(6, 'Toontown doge');void(0)" title="Toontown doge"><img src="/images/bg/6.png" alt="Toontown doge"/><br/>Toontown doge</a></li>
  </ul>
</div></td></tr>
		<tr><td style="border-right:solid 1px #eee;border-bottom:solid 1px #eee">
		Font
		</td>
		<td style="color:#424854;border-bottom:solid 1px #eee" colspan="2"><div class="btn-group" style="width:100%"><button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" style="width:100%">
    <span id="selected_font_name"><?=$font_namee?></span> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="javascript:change_font(1, 'Japanese', 'Comic Sans');void(0)" title="Comic Sans"><div style="width:145px;height:24px;background:url(/images/fonts.png);background-position:-75px 0"></div></a></li>
				<li><a href="javascript:change_font(2, 'Greek, Japanese, Turkish', 'Hand of Sean');void(0)" title="Hand of Sean"><div style="width:145px;height:24px;background:url(/images/fonts.png);background-position:-75px 24px"></div></a></li>
  </ul>
</div></td></tr>
		<tr><td style="border-right:solid 1px #eee;border-bottom:solid 1px #eee">
		Username color
		</td>
		<td style="color:#424854;border-bottom:solid 1px #eee" colspan="2">#<input type="text" id="picker" name="usrname_color" value="<?=$row['usrname_color'];?>" readonly style="<?php if($row['usrname_color'] != "ffffff"){ echo "border-color: #".$row['usrname_color']; } else { echo "border-color: inherit;border-width:1px"; } ?>"></input></td></tr>
		<tr><td style="border-right:solid 1px #eee">
		Background color
		</td>
		<td style="color:#424854" colspan="2"><div class="btn-group" style="width:100%"><button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" style="width:100%">
    <span id="selected_bgcolor"><?=$bg_color?></span> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="javascript:change_bgcolor('orange');void(0)" title="Orange"><div style="background:#F5D68F;padding:1px 3px;color:#fff;border:solid 1px #CCB178;border-radius:2px;width:100%">Orange</div></a></li>
    <li><a href="javascript:change_bgcolor('red');void(0)" title="Red"><div style="background:#F5928F;padding:1px 3px;color:#fff;border:solid 1px #CC7978;border-radius:2px;width:100%">Red</div></a></li>
    <li><a href="javascript:change_bgcolor('lime');void(0)" title="Lime"><div style="background:#D0F58F;padding:1px 3px;color:#fff;border:solid 1px #AFCC78;border-radius:2px;width:100%">Lime</div></a></li>
    <li><a href="javascript:change_bgcolor('aqua');void(0)" title="Aqua"><div style="background:#8FF2F5;padding:1px 3px;color:#fff;border:solid 1px #78CBCC;border-radius:2px;width:100%">Aqua</div></a></li>
    <li><a href="javascript:change_bgcolor('blue');void(0)" title="Blue"><div style="background:#8FAEF5;padding:1px 3px;color:#fff;border:solid 1px #7893CC;border-radius:2px;width:100%">Blue</div></a></li>
    <li><a href="javascript:change_bgcolor('fuchsia');void(0)" title="Fuchsia"><div style="background:#F58FE1;padding:1px 3px;color:#fff;border:solid 1px #CC78BD;border-radius:2px;width:100%">Fuchsia</div></a></li>
    <li><a href="javascript:change_bgcolor('purple');void(0)" title="Purple"><div style="background:#B48FF5;padding:1px 3px;color:#fff;border:solid 1px #9578CC;border-radius:2px;width:100%">Purple</div></a></li>
  </ul>
</div></td></tr>
		</td>
		</table>
	</div>
<div style="display:none">
<input type="radio" name="bg" id="1" value="1"<?php if($row['sig_bg'] == 1)echo" checked";?>>
<input type="radio" name="bg" id="2" value="2"<?php if($row['sig_bg'] == 2)echo" checked";?>>
<input type="radio" name="bg" id="3" value="3"<?php if($row['sig_bg'] == 3)echo" checked";?>>
<input type="radio" name="bg" id="4" value="4"<?php if($row['sig_bg'] == 4)echo" checked";?>>
<input type="radio" name="bg" id="5" value="5"<?php if($row['sig_bg'] == 5)echo" checked";?>>
<input type="radio" name="bg" id="6" value="6"<?php if($row['sig_bg'] == 6)echo" checked";?>>

<input type="radio" name="font" id="font_1" value="1"<?php if($row['sig_font'] == 1)echo" checked";?>>
<input type="radio" name="font" id="font_2" value="2"<?php if($row['sig_font'] == 2)echo" checked";?>>

<input type="radio" name="bgcolor" id="bgcolor_orange" value="orange"<?php if($row['bg_color'] == "orange")echo" checked";?>>
<input type="radio" name="bgcolor" id="bgcolor_red" value="red"<?php if($row['bg_color'] == "red")echo" checked";?>>
<input type="radio" name="bgcolor" id="bgcolor_lime" value="lime"<?php if($row['bg_color'] == "lime")echo" checked";?>>
<input type="radio" name="bgcolor" id="bgcolor_aqua" value="aqua"<?php if($row['bg_color'] == "aqua")echo" checked";?>>
<input type="radio" name="bgcolor" id="bgcolor_blue" value="blue"<?php if($row['bg_color'] == "blue")echo" checked";?>>
<input type="radio" name="bgcolor" id="bgcolor_fuchsia" value="fuchsia"<?php if($row['bg_color'] == "fuchsia")echo" checked";?>>
<input type="radio" name="bgcolor" id="bgcolor_purple" value="purple"<?php if($row['bg_color'] == "purple")echo" checked";?>>
</div>
	
	</div>
	</div>
	<div class="box no-title">
	<div class="alert alert-danger font-warning" style="display:none;padding: 5px;margin: 0 0 10px"><strong>Warning!</strong> The font you have selected<br>is not available on these languages:<br><code></code></div>
	<button type="submit" name="submit" class="button cosmo ico-save">Save</button>
	<!--<a href="process.php?action=deleteacc" class="button red ico-cross">Delete my account</a>-->
	<a href="/" class="button blue ico-right">Go back</a>
	</div>
	</form>
	</div>
<?php $noprofile_n_shit = 1; include_once($_SERVER['DOCUMENT_ROOT']."/main.php"); ?>