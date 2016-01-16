<?php

$user_id="4053";
$service_id="1374";
$adresas="http://jusu-saitas.lt";

// toliau redaguoti nereikia

$info=get_data($user_id."/".$service_id."/about");
$ProjektoPavadinimas=$info['title'];
$trumpas=$info['title2'];
$ilgas=$info['title3'];
		
$services=get_data($user_id."/".$service_id."/services");
for ($i=0; $i<=count($services['count']); $i++) {
	// $id=$services['services'][$i][$i+1][id];
	foreach ($services['services'][$i][$i+1] as $k => $v) {
		// $sr[$id][$k]=$v;
		$sr[$i][$k]=$v;
	}
	$max=$i;
}


function get_data($url) {
	$minehost="http://beta.minehost.lt/sms/";
	$url=$minehost.$url;
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$array = json_decode($data, true);
	return $array;
	// return $data;
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href=favicon.ico">

    <title><?php echo $ProjektoPavadinimas; ?> | MineHost.LT SMS sistema</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://MineHost.LT"><?php echo $ProjektoPavadinimas; ?> | MineHost.LT SMS sistema</a>
        </div>
       
      </div>
    </div>

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1><?php echo $trumpas; ?></h1>
        <p><?php echo $ilgas; ?></p>
        <p><a href="<?php echo $adresas; ?>" class="btn btn-primary btn-lg" role="button">Svetainė</a></p>
      </div>


      <div class="page-header">
        <h1>Jūsų slapyvardis serveryje</h1>
      </div>
      <div class="row">
        <div class="col-sm-12">
          
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Slapyvardis</h3>
            </div>
            <div class="panel-body">
			  <div class="form-signin" >
        <input id="nick" type="text" class="form-control" placeholder="Nick" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" onclick="javascript:toliau()">Toliau</button>
      </div>
            </div>
          </div>
		  
        </div><!-- /.col-sm-4 -->
       
       
      </div>
	  <div id=paslaugos style="display:none;">
	 <div class="page-header">
        <h1>Paslaugos</h1>
      </div>
      <div class="row">
<?php 
	for ($i=0; $i<=$max; $i++) {
		$info_sms=$info_sms."
		$('#paslaugosID".$sr[$i]['id']."').html('Siųskite SMS žinutę.<br>	Tekstas: <font color=green><b><big>".$sr[$i]['text']." '+nick+'</big></b></font>, numeris: <font color=green><b><big>".$sr[$i]['number']."</big></b></font><br> 		Kaina: ".$sr[$i]['price_eur']." €,');
		";
		?>
		<div class="col-sm-4">
          
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $sr[$i]['service']; ?></h3>
            </div>
            <div class="panel-body"><?php echo $sr[$i]['about']; ?>
				<ul class="list">
					<?php 
					for ($j=1; $j<=10; $j++) { 
						$p='p'.$j;
					if (!empty($sr[$i][$p])) { echo "<li>".$sr[$i][$p]."</li>"; }
					} 
					?>
					
				</ul>
				<center><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#<?php echo "paslauga".$sr[$i]['id']; ?>">Pirkti dabar</button></center>
            </div>
          </div>
		  
        </div>

<div class="modal fade" id="<?php echo "paslauga".$sr[$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="paslauga1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Paslaugos <?php echo $sr[$i]['title']; ?> užsakymas</h4>
      </div>
      <div class="modal-body">
	  <div class="alert alert-info">
        <strong></strong> Paslauga yra aktyvuojama per 5 minutes.
      </div>
		<div id=paslaugosID<?php echo $sr[$i]['id']; ?>>
        
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
      </div>
    </div>
  </div>
</div>
		<?php
	}
?>        
		
		
		
		
	
       
       
      </div>
	</div>





<script>
	function toliau () {
		var nick = document.getElementById('nick').value;
		if (nick == '') { alert('Įrašykite savo slapyvardį žaidime'); }
		if (nick != '') {
			document.getElementById('paslaugos').style.display = "block";
			<?php echo $info_sms; ?>
		}
		
		<!-- alert(z2); -->
	}
</script>	  
	  




    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="assets/js/docs.min.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48171656-1', 'minehost.lt');
  ga('send', 'pageview');

</script>
  </body>
</html>
