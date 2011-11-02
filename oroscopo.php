<?php 

class Oroscopo {

	
	public function mostra($segno) {
	
		 $pagina = "";
		 //$img_segno = "<img src=\"http://oroscopo.leonardo.it/canali/oroscopo/".$segno.".gif\" />";
		 //echo "<img src=\"http://oroscopo.leonardo.it/canali/oroscopo/".$segno.".gif\" />";
		
			 
		$html = "http://oroscopo.leonardo.it/oroscopo-giorno.php?s=".substr($segno,0,3);

		
		
		 $fp = fopen ($html, "r");
		 while (! feof($fp))
		   {
		       $riga = fgets($fp,1024);
		       $pagina .= $riga;
		   }
		 $pagina = utf8_encode ( $pagina );
	
		 
		 $pagina = explode("<!-- GIORNO -->",$pagina);
		
		 $pagina = explode("Ivana Raffa",$pagina[1]);
		 
		 $testo = explode("</div>",$pagina[0]);
		
		 print "<h2>".strip_tags($testo[0])."</h2><p>".strip_tags($testo[2])."</p>";		
	}
	
		
}
	
function giorno($segno) {
	$oros=new Oroscopo();

	$oros->mostra($segno);
} 

?>




