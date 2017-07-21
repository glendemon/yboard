
<script type="application/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/awesomechart.js"></script>

<canvas id="canvas1" width="300" height="300">
    Your web-browser does not support the HTML 5 canvas element.
</canvas>

<canvas id="canvas2" width="300" height="300">
    Your web-browser does not support the HTML 5 canvas element.
</canvas>

<canvas id="canvas3" width="300" height="300">
    Your web-browser does not support the HTML 5 canvas element.
</canvas>

<? 


//var_dump($registrations);



?>


 <script type="application/javascript">
   function drawMyChart(){
     if(!!document.createElement('canvas').getContext){ //check that the canvas
                                                        // element is supported
         var mychart1 = new AwesomeChart('canvas1');
         mychart1.title = "Новых регистрации за последний периуд";
         mychart1.data = <?=$chart[0]['data']?>;
         mychart1.labels = <?=$chart[0]['label']?>;
         mychart1.draw();
         
         
         
         var mychart2 = new AwesomeChart('canvas2');
         mychart2.title = "Созданно объявлений";
         mychart2.data = <?=$chart[1]['data']?>;
         mychart2.labels = <?=$chart[1]['label']?>;
         mychart2.draw();
         
         var mychart3 = new AwesomeChart('canvas3');
         mychart3.title = "Сообщений между пользователями";
         mychart3.data = <?=$chart[2]['data']?>;
         mychart3.labels = <?=$chart[2]['label']?>;
         mychart3.draw();
     }
   }

   window.onload = drawMyChart;
 </script>

