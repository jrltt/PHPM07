<?php
	require_once('Receta.php');

class Graph
{
	function crearGraph($paramReceta){
		/* Create and populate the pData object */
		foreach ($paramReceta as $receta => $value) {
			$arrayReceta[$value->getRecNom()] = $value->getNumIng();
		}
		// print_r($arrayReceta);
		// $i = 0;
		// foreach ($paramReceta as $receta) {
		// 	$array['receta'][$i] = $receta->getRecNom();
		// 	$array['ing'][$i] = $receta->getNumIng();
		// 	$i++;
		// }
		// print_r($array);
		$MyData = new pData();
 
		foreach ($arrayReceta as $nom => $cant) {
			$MyData->addPoints($cant, 'ingredientes');
		}
		//$MyData->addPoints($arrayReceta,"Recetas");
		// foreach ($arrayReceta as $nomReceta => $valor) {
		// 	$MyData->SetSerieName($nomReceta,$valor);
		// }
		$MyData->setAxisName(0,"Número de ingredientes");
		$MyData->setSerieDescription("Receta","Receta");
		$MyData->setAbscissa("Receta");

		/* Create the pChart object */
		$myPicture = new pImage(800,600,$MyData);

		/* Turn of Antialiasing */
		$myPicture->Antialias = FALSE;

		/* Add a border to the picture */
		$myPicture->drawGradientArea(0,0,600,400,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		$myPicture->drawGradientArea(0,0,600,400,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
		$myPicture->drawRectangle(0,0,600,400,array("R"=>0,"G"=>0,"B"=>0));

		/* Set the default font */
		$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

		/* Define the chart area */
		$myPicture->setGraphArea(60,40,600,400);

		/* Draw the scale */
		$scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
		$myPicture->drawScale($scaleSettings);

		/* Write the chart legend */
		$myPicture->drawLegend(580,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		/* Turn on shadow computing */ 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		/* Draw the chart */
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
		$settings = array("Surrounding"=>-30,"InnerSurrounding"=>30);
		$myPicture->drawBarChart($settings);

		/* Render the picture (choose the best way) */
		$myPicture->autoOutput("recetas.png");
	}
}
?>