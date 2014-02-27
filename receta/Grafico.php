<?php
	require_once('Ingrediente.php');

class Graph
{
	public function crearGraph($paramReceta){
		/* Create and populate the pData object */
		foreach ($paramReceta as $receta => $value) {
			$arrayReceta[$value->getIngNom()] = $value->getNumRec();
		}
		//print_r($arrayReceta);
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
			$MyData->addPoints($cant, $nom);
			//$MyData->addPoints(90, 'ingredientes');
		}
		//$MyData->addPoints($arrayReceta,"Recetas");
		// foreach ($arrayReceta as $nomReceta => $valor) {
		// 	$MyData->SetSerieName($nomReceta,$valor);
		// }
		$MyData->setAxisName(0,"Número de recetas");
		$MyData->setSerieDescription("Receta","Receta");
		$MyData->setAbscissa("Receta");

		/* Create the pChart object */
		$myPicture = new pImage(600,300,$MyData);

		/* Turn of Antialiasing */
		$myPicture->Antialias = FALSE;

		/* Add a border to the picture */
		// $myPicture->drawGradientArea(0,0,860,400,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		// $myPicture->drawGradientArea(0,0,860,400,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
		$myPicture->drawRectangle(0,0,600,300,array("R"=>0,"G"=>0,"B"=>0));

		/* Set the default font */
		$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

		/* Define the chart area */
		$myPicture->setGraphArea(60,40,600,300);

		/* Draw the scale */
		$scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
		$myPicture->drawScale($scaleSettings);

		/* Write the chart legend */
		$myPicture->drawLegend(50,10,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		/* Turn on shadow computing */ 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		/* Draw the chart */
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
		$settings = array("Surrounding"=>-30,"InnerSurrounding"=>30);
		$myPicture->drawBarChart($settings);

		/* Render the picture (choose the best way) */
		$myPicture->autoOutput("recetas.png");
	}

	public function crearPie($paramReceta)
	{
	  foreach ($paramReceta as $receta => $value) {
			$arrayReceta[$value->getIngNom()] = $value->getNumRec();
		}
	

		/* Create and populate the pData object */
		$MyData = new pData();
		foreach ($arrayReceta as $ing => $cant) {
			$MyData->addPoints($cant,"Recetas");  
			$MyData->addPoints($ing,"Ingredientes");
		}
		/* pData object creation */
		$MyData->setAbscissa("Ingredientes");

		/* Create the pChart object */
		$myPicture = new pImage(300,150,$MyData);

		/* Draw a gradient background */
		$myPicture->drawGradientArea(0,0,300,300,DIRECTION_HORIZONTAL,array("StartR"=>220,"StartG"=>220,"StartB"=>220,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));

		/* Add a border to the picture */
		$myPicture->drawRectangle(0,0,299,149,array("R"=>0,"G"=>0,"B"=>0));

		/* Create the pPie object */ 
		$PieChart = new pPie($myPicture,$MyData);

		/* Enable shadow computing */ 
		$myPicture->setShadow(FALSE);

		/* Set the default font properties */ 
		$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));

		/* Draw a splitted pie chart */ 
		$PieChart->draw3DPie(150,100,array("Radius"=>80,"DrawLabels"=>TRUE,"DataGapAngle"=>10,"DataGapRadius"=>6,"Border"=>TRUE));

		/* Render the picture (choose the best way) */
		$myPicture->autoOutput("pie.png");

	}

	public function crearGrafico($paramReceta)
	{
		$MyData = new pData();  
		$MyData->addPoints(array(4,VOID,VOID,12,8,3),"Frontend #1");
		$MyData->addPoints(array(3,12,15,8,5,5),"Frontend #2");
		$MyData->addPoints(array(2,7,5,18,19,22),"Frontend #3");
		$MyData->setAxisName(0,"Average Usage");
		$MyData->addPoints(array("Jan","Feb","Mar","Apr","May","Jun"),"Labels");
		$MyData->setSerieDescription("Labels","Months");
		$MyData->setAbscissa("Labels");

		/* Create the pChart object */
		$myPicture = new pImage(700,230,$MyData);
		$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		$myPicture->drawGradientArea(0,0,700,230,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));

		/* Set the default font properties */
		$myPicture->setFontProperties(array("FontName"=>"pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

		/* Draw the scale and the chart */
		$myPicture->setGraphArea(60,20,680,190);
		$myPicture->drawScale(array("DrawSubTicks"=>TRUE,"Mode"=>SCALE_MODE_ADDALL_START0));
		$myPicture->setShadow(FALSE);
		$myPicture->drawStackedBarChart(array("Surrounding"=>-15,"InnerSurrounding"=>15));

		/* Write the chart legend */
		$myPicture->drawLegend(480,210,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		/* Render the picture (choose the best way) */
		$myPicture->autoOutput("pictures/example.drawStackedBarChart.shaded.png");
			}
}
?>