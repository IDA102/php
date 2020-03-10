<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
	  <body >
	  <table>
	<?php
	ini_set('max_execution_time', 300);
	$gen=fsockopen("192.168.0.113",5025);
	$switch=fsockopen("192.168.0.116",5025);
	$oscil=fsockopen("192.168.0.114",5025);

	$file = fopen("12.txt","r+");
	$file1 = fopen("34.txt","r+");
	$file2=fopen("1.csv","r+");
	for ($i=40000000;$i<=50000000;$i=$i+100000)
	{
	$st1=":FREQ2"." ".$i;
	$st2=$st1."\n";
	fwrite($gen,$st2);
		///////////////////////////////////////////////////////////
		echo $i;
		echo "<br>";
		$close="ROUT:CLOS (@115,116)\n";
		fwrite($switch,$close);
		$scan="ROUT:SCAN (@115,116)\n";
		fwrite($switch,$scan);
		for ($j=115;$j<117;$j++)
		{	
			$ac="CONF:VOLT:DC (@$j)\n";
			fwrite($switch,$ac);
			$read="READ?\n";
			fwrite($switch,$read); $r=(float) fgets($switch,128);
			//fwrite($file, $r);
			//fwrite ($file,"\n");
			fwrite($file2, $r);
			fwrite ($file2,";");
			
			echo (float)$r; 
			echo "<br>";
		}
		$chan1=":MEAS:VAV? CHAN2\n";
		fwrite($oscil,$chan1); $ch1= (float) fgets($oscil,128);
		echo $ch1;
		//fwrite($file1, $ch1);  fwrite ($file1,"\n");
		fwrite($file2, $ch1);  fwrite ($file2,";");
		echo "<br>";
		$chan2=":MEAS:VAV? CHAN3\n";
		fwrite($oscil,$chan2); $ch2= (float) fgets($oscil,128);
		echo $ch2;
		//fwrite($file1, $ch2); fwrite ($file1,"\n");
		fwrite($file2, $ch2); fwrite ($file2,";"); fwrite ($file2,";\n");
		///////////////////////////////////////////////////////
		echo "<br>";
		echo "<br>";
	}
	$open="ROUT:OPEN (@115,116)\n";
	fwrite($switch,$open);
	fclose($gen); 
	fclose($switch);  
	fclose($oscil); 
	?>
</table>
 </body>
</html>