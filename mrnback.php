<!DOCTYPE html>
<html>
<head>
  <!-- roberto chalean 2017 robertchalean@gmail.com-->
  <meta charset="UTF-8">
  <title>Rapid Memory N-back!</title>

  <meta name="description" content="Loci N-back">
  <meta name="keywords" content="mental training, memory, working memory">

  <script src='scripts/jquery.min.js'></script>
  <script src="js/underscore-min.js"></script>
  <script src="js/jquery.cookie-dist.js" type="text/javascript"></script>

  <style type="text/css">
    .inp-num{
    text-align: center; 
   }
    table{
      table-layout: fixed;
    }
    td{
      font-size:33px;
      /*text-shadow: 2px 2px gray;*/
    }
    #canvas {
        height: 600px;
        display:table;
        width:100%;
        z-index: 500;
        
    }

    #canvas11 {

        height:100%;
        display:table-cell;
        vertical-align:middle;
        text-align:center;
        z-index: 1000;
        /*height: 60px;*/
        /*width: 60px;*/

    }
    #cnv {

        height:100%;
        display:table-cell;
        vertical-align:middle;
        text-align:center;
        z-index: 1000;
        /*height: 60px;*/
       
        /*width: 60px;*/

    }
    #controls-r{
       /* float:right; width:50px; margin-left: 0px; */
       position: fixed;
       right: 0px;
       top: 50px;

    }
    #controls-l{
       /*float: left; width:50px; */
        /* float:right; width:50px; margin-left: 0px; */
       position: fixed;
       left: 0px;
       top: 50px;


    }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 12px 16px;
           
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }


      </style>
  <script>
    
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45359665-6', 'auto');
  ga('send', 'pageview');

  </script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="loading"><h1>Loading...<span><img src="/img/loading.gif"></span></h1></div>

<!-- Controles -->
<div>
 <b>MR</b> 
 <a href="#" id="mas" style="text-decoration:none; color: #7D0552;"><b>+</b></a> 
 <span id="cantidadBack">2</span>
 <a href="#" id="menos"  style="text-decoration:none; color: #7D0552;"><b>-</b></a>
  &nbsp;
  Back&nbsp;

<span id="t1"></span> <input type="number" value="14" id="milis-val" class="inp-num" style="width: 50px;" step="2" onchange="perdidas=0; if(this.value%2!=0){ this.value++; } if(this.value<=1){ this.value=2; } if(this.value>=22){ this.value=22; } ">
<select id="preguntaTime" class="mySelect">
  <option value="50">.05</option>
  <option value="100">.1</option>
  <option value="150">.15</option>
  <option value="200">.2</option>
  <option value="250">.25</option>
  <option value="300" selected>.3</option>
  <option value="350">.35</option>
  <option value="400">.4</option>
  <option value="500">.5</option>
  <option value="600">.6</option>
  <option value="700">.7</option>
  <option value="800">.8</option>
  <option value="900">.9</option>
  <option value="1000">1</option>
</select>
<select id="preguntaTime1" class="mySelect">
  <option value="50">.05</option>
  <option value="100">.1</option>
  <option value="150">.15</option>
  <option value="200">.2</option>
  <option value="250">.25</option>
  <option value="300" selected>.3</option>
  <option value="350">.35</option>
  <option value="400">.4</option>
  <option value="500">.5</option>
  <option value="600">.6</option>
  <option value="700">.7</option>
  <option value="800">.8</option>
  <option value="900">.9</option>
  <option value="1000">1</option>
</select>
<select id="myDigits">
  <option value="1">2 digits</option>
  <option value="2">4 digits</option>
  <option value="3">6 digits</option>
  <option value="4"  selected>All</option>
</select>

<b>
 <a href="#" id="start" onclick="setTimeout(function(){play(0)},300);">Play</a>&nbsp;
 <a href="#" id="stop1">Stop&nbsp;</a>
</b> 
 <span style="">
 <span>
 <div class="dropdown">
  t: <input type="text" value="4000" id="timeValue" style="width: 30px;">&nbsp;<input type="text" value="3600" id="timeValue1" style="width: 28px;"></span>&nbsp;
  <div class="dropdown-content" style="width: 70px !important;">
    <select id="changeMainVel" onchange="$('#timeValue').val(this.value); $('#timeValue1').val(parseInt(parseInt(this.value)-400));" class="mySelect">
      <option value="2000">2</option>
      <option value="2500">2.5</option>
      <option value="3000">3</option>
      <option value="3500">3.5</option>
      <option value="4000" selected>4</option>
      <option value="4500">4.5</option>
      <option value="5000">5</option>
      <option value="5500">5.5</option>
      <option value="6000">6</option>
    </select>
  </div>
 </div>
 </span>
 c: <span id="pasadas">36</span>&nbsp;

 <span class="oke">ok: <span id="ok">0</span>&nbsp;</span>
 <span class="oke">E: <span id="error">0</span>&nbsp;</span>
&nbsp;

%: <input type="text" value="20" id="rndPorcentaje" style="width: 25px;">&nbsp; <!--deffault: 20-->
<a href="#" onclick="showCC();">Custom Config</a>
<a href="#" id="gray-btn" onclick="bGray=!bGray; if(bGray){ $('#canvas').css('background-color','gray'); $('body').css('background-color','gray'); $('select').css('background-color','gray'); $('.inp-num').css('background-color','gray'); $(':text').css('background-color','gray'); $('#gray-btn').html('white background');  }else{ $('#canvas').css('background-color','white'); $('body').css('background-color','white'); $('select').css('background-color','white'); $(':text').css('background-color','white'); $('.inp-num').css('background-color','white'); $('#gray-btn').html('gray background');  }"></a>
<script type="text/javascript"> bGray = 0; $('#gray-btn').html('gray background'); </script>
<? @include "otherNback.php"; ?>
<a href="#" onclick="alert('Rapid Memory N-Back\To learn the n-back trainning go to http://brainworkshop.sourceforge.net/tutorial.html\n%: is the probability of elements repetition\nThis software is experimental and may contain errors.\nRapid Memory N-back is licensed under the GNU General Public License v3.0\nSource Code: https://github.com/vernetit/rapidmemorynback/\nContact: robertchalean@gmail.com');">?</a>
&nbsp; <a href="http://atletismomental.blogspot.com.ar/2017/10/rapid-memory-n-back-de-memoria-rapida.html" target="_blank">Manual</a>
&nbsp;<div class="fb-share-button" data-href="http://competicionmental.appspot.com/mrnback" data-layout="button_count" style="float: right;"></div>
</div> <!-- Fin Controles -->
<br>
<!-- Canvas - Resultados -->
<div>
<div style=""   id="controls-l"></div>
<div id="cnv111">
  <div id="canvas" style=" height: 600px; background-color: white; z-index: 1000;"> <!-- #eee;" > -->
     <center>
       <table border="1" id="myTable">
         <tr style="height: 190px;">
           <td  style="width: 290px;"><div id="d00"></div></td>
           <td  style="width: 290px;"><div id="d10"></div></td>
           <td  style="width: 290px;"><div id="d20"></div></td>
         </tr>
          <tr style="height: 190px;">
           <td  style="width: 290px;"><div id="d01"></div></td>
           <td  style="width: 290px;"><div id="d11"></div></td>
           <td  style="width: 290px;"><div id="d21"></div></td>
         </tr>
          <tr style="height: 190px;">
           <td  style="width: 290px;"><div id="d02"></div></td>
           <td  style="width: 290px;"><div id="d12"></div></td>
           <td  style="width: 290px;"><div id="d22"></div></td>
         </tr>
       </table>
     </center>
  </div>
</div>
<div style="" id="controls-r"></div>
<!--
  <div id="resultsList"></div>
  <br><input type="button" name="" value="clear" id="clearResultsList">
</div>
-->
 <!-- Fin Canvas - Resultados -->
<div style="clear: both"></div>
<!-- Botonera -->
<br>
<center>
<div id="controls-div" style="width:700px;">
<input type="button" value="A: Loci Match" id="pm" style="font-size: 20px; zoom: 1.2;">


<input type="button" value="L: Number Match" id="sm" style="font-size: 20px; zoom: 1.2;">
<input type="button" value="N: Next" id="next-btn" style="display:none;">
</div>
</center>

<div style="clear: both"></div>
<div id="results"></div>
<br>
<div id="preload"></div>

<script type="text/javascript">

bShowCC=0;
bUseCC=0;
currentCC="";

function showCC(){
  bShowCC=!bShowCC;


  if(bShowCC){

    useCC="cc off";
    if(!bUseCC) useCC="cc on";
    currentCC=configApp;

    mostrar=`
    <textarea rows="4" cols="50" id="testCCValue">${configApp}</textarea><br>
    <input type="button" value="test" onclick="testCC()">
    <input type="button" value="putDefault" onclick="putDefaultCC()">
    <input type="button" value="save" onclick="saveCC()">
    <input type="button" value="${useCC}" id="useCCbtn" onclick=" bUseCC=!bUseCC; if(bUseCC){ $('#useCCbtn').val('cc off'); currentCC=$('#testCCValue').val(); }else{ $('#useCCbtn').val('cc on'); }">
    <input type="button" value="close" onclick="bShowCC=0; limpiar()">

    `;

    $("#d11").html(mostrar);

  }else{

  }

}


function saveCC(){ localStorage.setItem("mrnback", $("#testCCValue").val() ); }
function putDefaultCC(){ $("#testCCValue").val(testCCDefault); }

function testCC(){
  testCCValue=$("#testCCValue").val();
  console.log(testCCValue);

  x=0; a_num=[]; max=parseInt($("#milis-val").val());
  for(i=0;i<max;i++){

    a_num[i]=x;

    x++;
    if(x==10) x=0;

  }

  mostrar=eval('`'+testCCValue+'`');

  $("#d10").html("<center><b>"+mostrar+"</b></center>");

}


function selectTime(def,x){

  h=`
    <select id="tt${x}" class="mySelect">
      <option value="50">.05</option>
      <option value="100">.1</option>
      <option value="200">.2</option>
      <option value="300">.3</option>
      <option value="400">.4</option>
      <option value="500">.5</option>
      <option value="600">.6</option>
      <option value="700">.7</option>
      <option value="800">.8</option>
      <option value="900">.9</option>
      <option value="1000">1</option>
      <option value="1200">1.2</option>
      <option value="1400">1.4</option>
      <option value="1500">1.5</option>
      <option value="2000">2</option>
      <option value="3000">3</option>
      <option value="4000">4</option>
      <option value="5000">5</option>
      <option value="6000">6</option>
    </select>
  `;
  $("#t"+x).html(h);
  $("#tt"+x).val(def);
}

selectTime("1000","1");


imagenDimension=600;

$("#resultsList").hide();

$("#loading").hide();
//$("#controls-div").hide();
$("#stop1").hide();
$("#clearResultsList").hide();


function n(x){ return parseInt($("#"+x).val()); }

bMobile=0;
if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) ) {
  bMobile=1;
  $(".fb-share-button").hide();
} 

<? include "db/worldPositions.php"; ?>

arrayImages=[];
arrayImages1=[];
arrayImages2=[];
arrayPreloadImages=[];

zPreload=0;
imgLoadedCount=0;


bOnGame=0;

var tcAct=0;
var cAct=0, iAct=0, sAct=1;
var salidas = [], salidas1 = [],cantidadBack=2, pasadas=36, currentPasada=0;
var bIntroducir=0, bIntroducir1=0, bIntroducir2=0, bIntroducir3=0, bIntroducir4=0, bIntroducir5=0;
var ok=0, ok1=0, ok2=0, ok3=0, ok4=0, ok5=0;
var error=0 , error1=0, error2=0, error3=0, error4=0, error5=0, mismo=0,mismo1=0, mismo2=0,mismo3=0,mismo4=0,mismo5=0;
var killInterval,myInterval,killCamera;
var bOk=0,bOk1=0,bOk2=0,bOk3=0,bOk4=0,bOk5=0;
var arrayImagenes=[];
var acumuladorSuma=0;

function actualizarOk(){
  $("#ok").html(parseInt(ok)+parseInt(ok1)+parseInt(ok2)+parseInt(ok3));
}

function actualizarErrores(){
  $("#error").html(parseInt(error)+parseInt(error1)+parseInt(error2)+parseInt(error2));
}

var perdidas=0;
var cantidadElementos=3;
var cantidadLoci=2;

var bVariable=1;
var currentVariable=1;
var realCantidadBack=1;
var sel=0;
var max=0;
var kill2;
var kill3;
var time;
var bMismo=0;
var posibleMismo="";
var errorShow="";
var myDigits=0;

function play(_xxx){

  if(_xxx==0){

    if(bOnGame)
      return;

    limpiar();

    myDigits=n("myDigits");

    bVariable=n("isVariable");
    errorShow="";

    cantidadElementos=n("cantidadElementos");
    cantidadLoci=n("cantidadLoci");

    realCantidadBack=parseInt($("#cantidadBack").html());
    //console.log(realCantidadBack);

    cantidadBack=realCantidadBack;
    currentVariable=cantidadBack;

    $("#stop1").show();

    $("#resultsList").hide();
    
    bOnGame=1;

    imgLoadedCount=0;

    //$("#preload").show(); 
      //$("#loading").show(); 
      //$("#controls-div").hide();

      rndPorcentaje=parseInt($("#rndPorcentaje").val());

    salidas=[]; 
     salidas1=[]; 
  

    currentPasada=0;
    pasadas = 20 + (cantidadBack-1) * 6;  

    ok=0; ok1=0; ok2=0; ok3=0; ok4=0; ok5=0;
    error=0; error1=0; error2=0; error3=0; error4=0; error5=0;

    myInterval=parseInt($("#timeValue").val());
    myInterval1=parseInt($("#timeValue1").val());

    clearTimeout(killInterval); 
    
    clearInterval(kill2); 
    clearInterval(kill3); 

    bOk=0; bOk1=0; bOk2=0; bOk3=0; bOk4=0; bOk5=0;
    mismo=0; mismo1=0; mismo2=0; mismo3=0; mismo4=0; mismo5=0;

    arrayImages=[];
    arrayImages1=[];
    arrayPreloadImages=[];

    zPreload=0;
    imgLoadedCount=0;

    $("#error").html(parseInt(error)+parseInt(error1));
    $("#ok").html(parseInt(ok)+parseInt(ok1));
    $("#results").html(""); 

     arrayImages1=[0,1,2,3,4,5,6,7,8,9];

     t_ini = Date.now();

     max=n("milis-val");

  }//end x==0


  bOnGame=1; 

  bIntroducir=0; bIntroducir1=0; bIntroducir2=0; bIntroducir3=0; bIntroducir4=0; bIntroducir5=0;  

   //position match error
   if(currentPasada>cantidadBack && bOk==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1]){
        console.log("e pm");
         error++;
         $("#pm").css("color","red");

         actualizarErrores();
         setTimeout(function(){ $("#pm").css("color","black"); },300);
      }
   }
   bOk=0;

   //sound match error
   if(currentPasada>cantidadBack && bOk1==0){

      _s=currentPasada-1;
      _b=currentPasada-1-cantidadBack;

      if(salidas1[_s]==salidas1[_b]){
         error1++;

         errorShow += " &nbsp;"+ salidas1[currentPasada-1][0] + salidas1[currentPasada-1][1];
         $("#sm").css("color","red");
         actualizarErrores();
         setTimeout(function(){ $("#sm").css("color","black"); },300);
      }
   }
   bOk1=0;

  if(pasadas==0){
     $("#stop1").hide();
     //$("#resultsList").show();

      total_p = ok + error;
      total_s =  ok1 + error1;
      total_i = ok2 + error2;
      total_c = ok3 + error3;
      //tc  
      total_va = ok4 + error4;
      total_av = ok5 + error5;


      total_ps = total_p + total_s + total_i + total_c + total_va + total_av;
      total_ok = ok + ok1 + ok2 + ok3 + ok4 + ok5;

      if(total_ps==0)
        total_ps=1;

      porcentaje_ok = (total_ok * 100)/total_ps;
      porcentaje_ok = Math.round(porcentaje_ok);

      //agregarResultado(cantidadBack,porcentaje_ok);

      resta=0;
      recomendacion="Same level";
      if(porcentaje_ok>=75){
         recomendacion="Level augmented";
         cantidadBack++;
         pasadas = 20 + (cantidadBack-1) * 6;
         $("#cantidadBack").html(cantidadBack);
         $("#pasadas").html(pasadas);
         resta=1;
         perdidas=0;
      
      }
      if(porcentaje_ok<75 && porcentaje_ok>=50){
         recomendacion="Keep on the same level";
         
      }
      if(porcentaje_ok<50){
         perdidas++;
         recomendacion=" Low score count: " + perdidas; //decrease
      }

      //ok=1; ok1=1; ok2=1; ok3=1; error=1; error1=1; error2=1; error3=1;  

      positionTxt = ""; soundTxt = ""; imageTxt= ""; colorTxt=""; vaTxt=""; avTxt="";
      if(ok!=0 || error!=0){

        positionTxt="Position: "+ok+"-"+error;

      }
      if(ok1!=0 || error1!=0){

        soundTxt="Numbers: "+ok1+"-"+error1;

      }

       if(ok2!=0 || error2!=0){

        imageTxt="images: "+ok2+"-"+error2;
      }
      if(ok3!=0 || error3!=0){

        colorTxt = "colors: "+ok3+"-"+error3;
      }
      if(ok4!=0 || error4!=0){

        vaTxt = "vis & n-audio: "+ok4+"-"+error4;
      }
      if(ok5!=0 || error5!=0){

        avTxt = "audio & n-vis: "+ok5+"-"+error5;
      }
      sumaTxtTxt="";
      if(iAct==4){
        sumaTxtTxt=" Sum of numbers= " + acumuladorSuma + "<br>";
      }

      t_fin = Date.now();
      t_dif = t_fin - t_ini;

      txt="<h3>Rapid Memory " + (cantidadBack-resta) + "-back " +  $("#milis-val").val() + " digits span Results!</h3>"  + positionTxt + " " + soundTxt + " " + imageTxt + " " + colorTxt + " " + vaTxt + " " + avTxt + "<br>" + sumaTxtTxt +
         "Score: "+ porcentaje_ok + "% errors: " + errorShow + "<br>" + "time:" + getDuration(t_dif) + " <br> " + recomendacion;

      $("#results").html(txt);
      //$("#canvas").html(`<div id="canvas11">Hello!<br>Here the instructions of the original nback game to guide you in locinback: <a href="http://brainworkshop.sourceforge.net/tutorial.html">http://brainworkshop.sourceforge.net/tutorial.html</a></div>`);

      bOnGame=0;

      $("html, body").animate({ scrollTop: $(document).height() }, 1000);

      limpiar();

       clearTimeout(killInterval);
      clearTimeout(kill2);
      clearTimeout(kill3);

      return;

   }

   _r=_.random(1,100);
   //console.log(_r);

   //Position
   _txt="misma";
   if((currentPasada>cantidadBack && _r<=rndPorcentaje)/* || currentPasada==2 */){
      _poner = currentPasada-cantidadBack;
      __x=salidas[_poner][0];
      __y=salidas[_poner][1];
  
      mismo++;
     
   }else{
      _txt="random";
   

      for(;;){
       
         __x = _.random(0,2);
         __y = _.random(0,2);
         
         
         if(__x!=1 || __y!=1){
            if(currentPasada>cantidadBack){

               if(__x!=salidas[currentPasada-cantidadBack][0] && __y!=salidas[currentPasada-cantidadBack][1]){
                  break;
               }
            }else{

               /*
               if(currentPasada>0){
                   if(_x!=salidas[currentPasada-1][0] && _y!=salidas[currentPasada-1][1] && _z!=salidas[currentPasada-1][2])
                     break;

               }
               if(currentPasada==0)*/
                  break; 


            }
              
         }
         
       // break;
      }//for  
   }//currentPasada>cantidadBack

   //Image
  _r=_.random(1,100);;
  _txt="misma";

  if(currentPasada>cantidadBack && _r<=rndPorcentaje){

    _poner = currentPasada-cantidadBack;

    _myImagen1=salidas1[_poner];
      
    mismo1++; bMismo=1;

    //console.log("vis & n-vis: " + _myImagen + "-" + _myImagen2 + "-" + _myImagen3);   
   }else{//currentPasada>cantidadBack
      _txt="random";
      
      contador=0;

      bMismo=0;

      _pon = currentPasada-cantidadBack;

      if(currentPasada>cantidadBack){
        posibleMismo = salidas1[_pon];
      }else{
        if(myDigits==1 || myDigits==4)
          posibleMismo = _.random(0,9)+""+_.random(0,9);
        if(myDigits==2)
          posibleMismo = _.random(0,9)+""+_.random(0,9)+""+_.random(0,9)+""+_.random(0,9);
        if(myDigits==3)
          posibleMismo = _.random(0,9)+""+_.random(0,9)+""+_.random(0,9)+""+_.random(0,9)+""+_.random(0,9)+""+_.random(0,9);
        
      }


      for(;;){

        if(myDigits==1)
          _myImagen1=arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]; 
        if(myDigits==2)
           _myImagen1=arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]; 
        if(myDigits==3)
           _myImagen1=arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]+""+arrayImages1[_.random(0,9)]; 
        if(myDigits==4){
          _myImagen1="";
          for(_i=0;_i<max;_i++){
            _myImagen1+=""+arrayImages1[_.random(0,9)];

          }
        }

        //checkear
         if(currentPasada>cantidadBack){
            if(_myImagen1!=salidas1[currentPasada-cantidadBack])
               break;        
         }else{
               break;

         }
          
           //break;
      }//for  
   }//currentPasada>cantidadBack
  
   salidas[currentPasada]=[];

   console.log(salidas[currentPasada])

   salidas[currentPasada][0] = __x;
   salidas[currentPasada][1] = __y;

   //console.log(currentPasada+"-"+__x+"-"+__y+"-"+ salidas[currentPasada][1]);
   //console.log(salidas[currentPasada][1]);


   salidas1[currentPasada]=[];
  salidas1[currentPasada]=_myImagen1;

  bRespuesta=0;
  test=0;
  at=n("at-sel");
  //test=0;

  

  time=n("tt"+(test+1));

  p="+";

  $("#d"+ salidas[currentPasada][0] + "" + salidas[currentPasada][1] ).html("<center><b>"+p+"</b></center>");

  kill2=setTimeout(function(){ muestra(); },300);
    
   bIntroducir=1; bIntroducir1=1; bIntroducir2=1; bIntroducir3=1;  bIntroducir4=1;  bIntroducir5=1;
   pasadas--;

   $("#pasadas").html(pasadas);

  killInterval = setTimeout(function(){ currentPasada++; play(1);},myInterval);
  kill4=setTimeout(function(){ limpiar(); },myInterval1);
   

}//en play()

var kill4;
var poner1;
var poner;

function killAll(){
  
}

function muestra(){

  arraySel=[0,2,4,6,8,10,12,14,16,18,20,22,24];

  poner="";
  poner1="";

  /*
   if(time<1000){
    sel=_.random(0,max-1);
    }else{

      sel=_.random(0,max-1);
    }*/

  for(;;){

   // if(myDigits==1)
      sel=arraySel[_.random(0,arraySel.length-1)];
  //  else
   //   sel=arraySel[_.random(0,arraySel.length-1)];

    if(sel<max-1 && myDigits==1) break;
    if(sel<max-3 && myDigits==2) break;
    if(sel<max-5 && myDigits==3) break;
    if(myDigits==4) break;

  }

  for(;;){

    sel1=arraySel[_.random(0,arraySel.length-1)];

    if(sel1<max-1  && sel1!=sel && myDigits==1) break;
    if(sel1<max-1  && sel1!=sel && sel1!=sel+2 && myDigits==2) break;
    if(sel1<max-1  && sel1!=sel && sel1!=sel+2 && sel1!=sel+4 && myDigits==3) break;
    if( (max - (myDigits*2 )) >=2 ) break;
    if(myDigits==4) break;    
   
  }

  bTruculento=0;
  if(!bMismo && _.random(1,100)<20){bTruculento=1; console.log("truculento"); } 
  
  a_bin=[];
  a_num=[];

  _x=0;

  for(let i=0;i<max;i++){

    space="";    

    if(i%2==0 && i!=0) space="&nbsp;";

    if(i>9 && i%2==0){
      space="<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"

    }

    rnd=_.random(0,9);

    if(bTruculento && (i==sel1 || i==sel1+1) && (max - (myDigits*2 )) >=2 ){

       if(i==sel1){ rnd=posibleMismo[0]; }
       if(i==sel1+1){ rnd=posibleMismo[1]; }

    }else{
      if(myDigits==1){
        if(i==sel){ rnd=salidas1[currentPasada][0]; }
        if(i==sel+1){ rnd=salidas1[currentPasada][1]; }

      }
      if(myDigits==2){
        if(i==sel){ rnd=salidas1[currentPasada][0]; }
        if(i==sel+1){ rnd=salidas1[currentPasada][1]; }
        if(i==sel+2){ rnd=salidas1[currentPasada][2]; }
        if(i==sel+3){ rnd=salidas1[currentPasada][3]; }
      }
      if(myDigits==3){
        if(i==sel){ rnd=salidas1[currentPasada][0]; }
        if(i==sel+1){ rnd=salidas1[currentPasada][1]; }
        if(i==sel+2){ rnd=salidas1[currentPasada][2]; }
        if(i==sel+3){ rnd=salidas1[currentPasada][3]; }
        if(i==sel+4){ rnd=salidas1[currentPasada][4]; }
        if(i==sel+5){ rnd=salidas1[currentPasada][5]; }

      }
     
    }

    if(myDigits==4){
      rnd=salidas1[currentPasada][i];

    }
    
    poner+=(space+rnd);
    poner1+=""+rnd;

    a_num[_x]=rnd;

    _x++;
    //console.log(poner);
  }    

  if(max==16){
    poner=`
      ${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}
    `;
    
  }

  if(max==18){
    poner=`
      ${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[16]}${a_num[17]}
    `;
    
  }

  if(max==20){
    poner=`
      ${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}&nbsp;${a_num[16]}${a_num[17]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[18]}${a_num[19]}
    `;
    
  }

  if(max==22){
    poner=`
      ${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}&nbsp;${a_num[16]}${a_num[17]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[18]}${a_num[19]}&nbsp;${a_num[18]}${a_num[19]}
    `;
    
  }

  if(bUseCC){
    poner = eval('`' + currentCC + '`');
  }
  //console.log(salidas[currentPasada]);

  $("#d"+ salidas[currentPasada][0] + "" + salidas[currentPasada][1] ).html("<center><b>"+poner+"</b></center>");

  kill2=setTimeout(function(){
    $("#d"+ salidas[currentPasada][0] + "" + salidas[currentPasada][1]).html("");

    if(myDigits==4) return;

    kill3=setTimeout(function(){ pregunta(); },n("preguntaTime"));
    //pregunta();
  },time);


}


var sel=0;
var sel1=0;

function pregunta(){


  a_bin=[];
  a_num=[];

  _x=0;

  poner="";
  for(i=0;i<max;i++){
    space="";    
    if(i%2==0 && i!=0) space="&nbsp;";

    if(i>9 && i%2==0){
      space="<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"

    }

   
    if( (i!=sel && i!=sel+1 && myDigits==1) || (i!=sel && i!=sel+1 && i!=sel+2 && i!=sel+3 && myDigits==2) || (i!=sel && i!=sel+1 && i!=sel+2 && i!=sel+3 && i!=sel+4 && i!=sel+5 && myDigits==3)  ){
      poner+=space+"0";
      a_num[_x]=0;
    }
    else{
      poner+=space+"1";
      a_num[_x]=1;
    }

    _x++;

  }

  if(max==16){
    poner=`
      ${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}
    `;
    
  }
  if(max==18){
    poner=`
      ${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[16]}${a_num[17]}
    `;
    
  }
  if(max==20){
    poner=`
      ${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}&nbsp;${a_num[16]}${a_num[17]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[18]}${a_num[19]}
    `;
    
  }
  if(max==22){
    poner=`
      ${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}&nbsp;${a_num[16]}${a_num[17]}
      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[18]}${a_num[19]}&nbsp;${a_num[18]}${a_num[19]}
    `;
    
  }

  if(bUseCC){
    poner = eval('`' + currentCC + '`');
  }

  $("#d"+salidas[currentPasada][0]+salidas[currentPasada][1]).html("<center><b>"+poner+"</b></center>");
  
  at=1;
  if(at!=0){

    kill2=setTimeout(function(){

       console.log("limpiar");



       $("#d"+salidas[currentPasada][0]+salidas[currentPasada][1]).html("");

    },n("preguntaTime1"));
  }
}

function limpiar(){
  
  for(let i=0;i<3;i++){
    for(let j=0;j<3;j++){
      $(`#d${j}${i}`).html("");
    }
  }

}

$(document).keypress(function(e) {
  console.log("");

  //console.log("key" + e.which);

  if(!bOnGame) return;

   //Position match letter A
       if(e.which==97){

         if(bIntroducir){
            
            if(currentPasada+1>cantidadBack){
                console.log("A");
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

                if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1]){
                  bOk=1;
                  ok++;
                  $("#ok").html(ok);
                  actualizarOk();
                  $("#pm").css("color","green");
                  //console.log("ok");

                  
                }else{
                  $("#pm").css("color","red");

                  console.log("error");
                  error++;
                  bOk=1;
                  //$("#error").html(error);
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir=0;
         setTimeout(function(){ $("#pm").css("color","black"); },300);
       }//wich a


       //Number letter L
       if(e.which==108){

         if(bIntroducir1 && sAct>0){
            
            
            if(currentPasada+1>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

                if(salidas1[_s]==salidas1[_b]){
                  bOk1=1;
                  ok1++;
                  //$("#ok").html(parseInt(ok)+parseInt(ok1));
                  actualizarOk();
                  $("#sm").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#sm").css("color","red");

                  errorShow += " &nbsp;"+ salidas1[currentPasada][0] + salidas1[currentPasada][1]; 

                  //console.log("error-s");
                  error1++;
                  bOk1=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();


                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir1=0;
         setTimeout(function(){ $("#sm").css("color","black"); },300);
       }//wiich l

  //console.log(e.which);
});//on keypress

$("#mas").click(function(){
      cantidadBack++;
      pasadas = 20 + (cantidadBack-1) * 6;
      $("#cantidadBack").html(cantidadBack);
      $("#pasadas").html(pasadas);
      clearTimeout(killInterval);
      clearTimeout(kill2);
    clearTimeout(kill3);
      perdidas=0;
      

   });
   $("#menos").click(function(){
      if(cantidadBack==1)
         return;
       perdidas=0;
      cantidadBack--;
      pasadas = 20 + (cantidadBack-1) * 6;
      $("#cantidadBack").html(cantidadBack);
      $("#pasadas").html(pasadas);
      clearTimeout(killInterval);
      clearTimeout(kill2);
    clearTimeout(kill3);

   });

   //Match Buttons

   $("#pm, #controls-l").click(function(){
     

    if(bIntroducir){
            
            if(currentPasada+1>cantidadBack){
                console.log("A");
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

                if(salidas[_s][0]==salidas[_b][0] && salidas[_s][1]==salidas[_b][1]){
                  bOk=1;
                  ok++;
                  $("#ok").html(ok);
                  actualizarOk();
                  $("#pm").css("color","green");
                  //console.log("ok");

                  
                }else{
                  $("#pm").css("color","red");

                  console.log("error");
                  error++;
                  bOk=1;
                  //$("#error").html(error);
                  actualizarErrores();

                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir=0;
         setTimeout(function(){ $("#pm").css("color","black"); },300);
  

   });

   $("#sm, #controls-r").click(function(){


         if(bIntroducir1){
            
            if(currentPasada+1>cantidadBack){
               //console.log(bIntroducir);
                _s=currentPasada;
                _b=currentPasada-cantidadBack;

                if(salidas1[_s]==salidas1[_b]){
                  bOk1=1;
                  ok1++;
                  //$("#ok").html(parseInt(ok)+parseInt(ok1));
                  actualizarOk();
                  $("#sm").css("color","green");
                  //console.log("ok-s");

                  
                }else{
                  $("#sm").css("color","red");
                  errorShow += " &nbsp;"+ salidas1[currentPasada][0] + salidas1[currentPasada][1]; 

                  //console.log("error-s");
                  error1++;
                  bOk1=1;
                  //$("#error").html(parseInt(error)+parseInt(error1));
                  actualizarErrores();


                } //si coincide
            }//pasadas>cantidadBack
         }//bIntroducir
         bIntroducir1=0;
         setTimeout(function(){ $("#sm").css("color","black"); },300);

});

$("#stop1").click(function(){
    $("#stop1").hide();
    clearTimeout(killInterval);
    clearTimeout(kill2);
    clearTimeout(kill3);
    bOnGame=0;

});


if(bMobile==1){
     _ww=$(window).width();
    _wh=$(window).height();
    _cw = (_ww - canvas.width)/2-20;

    imagenDimension=500;

   //$("#controls-l").css("width",_cw+"px"); 
   $("#controls-l").css("width","70px"); 
   $("#controls-l").css("height",_wh+"px"); 
   $("#controls-l").css("display","flex");  
   //$("#controls-l").css("z-index","10000");

    //$("#controls-r").css("width",_cw+"px"); 
    $("#controls-r").css("width","70px"); 
    $("#controls-r").css("height",_wh+"px"); 
    $("#controls-r").css("display","flex"); 
   // $("#controls-r").css("z-index","10000");
    
    
    $("#controls-l").html(`<div style="align-self: center; margin-left: 30%;">A</div>`);
    $("#controls-r").html(`<div style="align-self: center; margin-left: 40%;">S</div>`);

    $("#cnv111").css("float","left");
}

/*
$("#d00").css("background-image","url('https://maps.googleapis.com/maps/api/streetview?size=290x190&location=25.1854152,55.3699478&fov=90&heading=297&pitch=10&key=AIzaSyB-CedQccD4tyO5TGMOSb5s1fMb-c6Nh-A')");
*/

$("#menos").click();

$("#milis-val").val("16")
// $("#tt1").val("6000")

testCCDefault="${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}";

configApp=localStorage.getItem("mrnback");
//configApp = defaultText;

if(configApp==null){
  
  configApp="${a_num[0]}${a_num[1]}&nbsp;${a_num[2]}${a_num[3]}&nbsp;${a_num[4]}${a_num[5]}&nbsp;${a_num[6]}${a_num[7]}&nbsp;${a_num[8]}${a_num[9]}&nbsp;${a_num[10]}${a_num[11]}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${a_num[12]}${a_num[13]}&nbsp;${a_num[14]}${a_num[15]}";

  localStorage.setItem("mrnback", configApp);
  
}else{
  //console.log(configApp);

}
var t_ini;
var t_fin;
var t_dif;

var getDuration = function(millis){
  var dur = {};
  var units = [
      {label:"millis",    mod:1000},
      {label:"seconds",   mod:60},
      {label:"minutes",   mod:60},
      {label:"hours",     mod:24},
      {label:"days",      mod:31}
  ];
  // calculate the individual unit values...
  units.forEach(function(u){
      millis = (millis - (dur[u.label] = (millis % u.mod))) / u.mod;
  });
  // convert object to a string representation...
  var nonZero = function(u){ return dur[u.label]; };
  dur.toString = function(){
      return units
          .reverse()
          .filter(nonZero)
          .map(function(u){
              return dur[u.label] + " " + (dur[u.label]==1?u.label.slice(0,-1):u.label);
          })
          .join(', ');
  };
  return dur;
};

</script>

<script type="text/javascript">
   if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) || $(window).width()<900 ) {
     // run your code here
     $("#myOther").hide();

    }
</script>

</body>
</html>