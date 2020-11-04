<?php 

error_reporting(0);
if($_GET['sku']!='')
{

$sku=$_GET['sku'];
$sku=str_replace(" ","",$sku);
$querypage=file_get_contents("https://www.lethalperformance.com/catalogsearch/result/?q=".$sku);
$start=strpos($querypage,'<section class="cat-listing-filter-main" id="cat-listing-filter-main-section">');
$fs=$sku;
$end=strpos($querypage,"</section>",$start);
$end=$end+10;
if($start!=0)
{
$querypage=substr($querypage,$start,$end-$start);


}
else{
$main="https://www.lethalperformance.com/catalogsearch/result/?q=".$sku;

$sku='';

}
}


if($main!='' || $_GET['main']!='')
{
    if($main=='')
    {
        $querypage=file_get_contents($_GET['main']);
        $main=$_GET['main'];
    }
    else{
        $GET['main']=$main;
        //$GET_['fs']=$fs;
    }
    
    $start=strpos($querypage,'<div class="product-top-left">');
    $end=strpos($querypage,'<div class="product-top-right">',$start);
    $querypage=substr($querypage,$start,$end-$start);
}

if($_GET['final']!='')
{
    if($_GET['fs']!='')
    $fs=$_GET['fs'];
    unlink("a1.jpg");
    unlink("a2.jpg");
    unlink("a3.jpg");
    unlink("a4.jpg");
    unlink("a5.jpg");
    unlink("a6.jpg");
    unlink("a7.jpg");
    unlink("a8.jpg");
    unlink("a9.jpg");
    unlink("a10.jpg");
    unlink("a11.jpg");
    unlink("a12.jpg");
    unlink("a13.jpg");
    unlink("a14.jpg");
    unlink("a15.jpg");
    unlink("a16.jpg");
    unlink("a17.jpg");
    unlink("a18.jpg");
    unlink("a19.jpg");
    unlink("a20.jpg");


    
    if($_GET['totalurl']!=0)
    {
        $total=$_GET['totalurl']*1;
        //echo $total;
        for($i=1;$i<=$total;$i=$i+1)
        {   
            $file=fopen('a'.$i.'.jpg','w');
            $image=file_get_contents($_GET['imgurl'.$i]);
            fwrite($file,$image);
            fclose($file);
            //echo $_GET['imgurl'.$i];
        }
    }
if($_GET['totalurl']==1)
{
    if(strpos($_GET['imgurl1'],'placeholder/default/loyaltylogo_small.png'))
    unlink('a1.jpg');
}
    $final=$_GET['final'];
    $querypage=file_get_contents($_GET['final']);
    if(strpos($querypage,'<div class="product-options" id="product-options-wrapper">'))
    {
        $querypage1='<div id="vardetect" style="height:100px;width:100%;background-color:red;"></div>';
        $hsidata=fopen('hsidata.txt','a');
        $data=$fs."\n";
        fwrite($hsidata,$data);
        fclose($hsidata);
    }
    $start=strpos($querypage,'<div class="sixth">');
    $end=strpos($querypage,'<div class="seventh">',$start);
    $querypage2='<div style="padding:20px">'.substr($querypage,$start,$end-$start).'</div>';
    $start=strpos($querypage,'<section class="producttabs clearfix" id="producttabs1">');
    $end=strpos($querypage,'</section>',$start);
    $querypage3=substr($querypage,$start,$end-$start);
    $querypage=$querypage1.$querypage2.$querypage3;
    $querypage=str_ireplace("lethal","HSI",$querypage);
    $a='<img src="'.$_GET["imgurl1"].'" height="300px" >';
    $querypage=$a.$querypage;
    $a='<div>'.$fs.'</div>';
    $querypage=$a.$querypage;
}


?>
<form id="formsku">
<input name="sku" type="text">
<input type="submit" value="Submit">

</form>
<div id="phpcontent"><?php echo $querypage;?></div>


<script id="scripts">

    

<?php 
if($sku!='')
{
echo 'var sku="'.$sku.'";';
echo 'var fs="'.$fs.'";';?>

document.querySelector("#phpcontent").innerHTML=document.querySelector("#cat-listing-filter-main-section .container").innerHTML; 
a=document.querySelector(".cat-listing-filter-right").innerText;

if(a.indexOf('Your search returns no results')==-1)
{
document.querySelector("#phpcontent").innerHTML=document.querySelector(".home-product-slider").innerHTML;

var c = document.getElementById("phpcontent").childNodes;

for(i=1;i<=c.length;i=i+2)
{
//console.log(c[i].tagName);
//c[i].style.color="red";
a=c[i].querySelector('.product-home-sku > p > span');
a.remove();
a=c[i].querySelector('.product-home-sku > p').innerText;
//console.log(a);
a=a.replace(/\s/g, '');
if(a==sku)
{
b=c[i].querySelector('.product-image').getAttribute("href");
console.log(fs);
window.location.href = 'http://127.0.0.1/?main='+b+'&fs='+fs;
}
}

}
<?php }?>
<?php if($main!='')
{
    echo 'var main="'.$main.'";';
    if($_GET['fs']=='')
    echo 'var fs="'.$fs.'";';
    else
    echo 'var fs="'.$_GET['fs'].'";';
    

    ?>
    document.querySelector("#phpcontent").innerHTML=document.querySelector("#rg-gallery ul").innerHTML;
    var c = document.getElementById("phpcontent").childNodes;
    
    var total=0;
    var imgurl='',b='';
 
    for(i=1;i<c.length;i=i+2)
    {

        b=c[i].querySelector('img').getAttribute('data-large');
        total=total+1;
        c[i].innerHTML=b;
        imgurl=imgurl+'&imgurl'+total+'='+b;
        
    }
    //console.log(imgurl);
    url='&totalurl='+total+imgurl;
    final='final='+main+url;
    console.log(fs);
    window.location.href = 'http://127.0.0.1/?'+final+'&fs='+fs;


<?php }?>
<?php if($final!="")
{
    echo 'var fs="'.$fs.'";';
    ?>

document.getElementById('producttabs1').innerHTML=document.getElementById('collateral-tabs').innerHTML;
document.getElementById('producttabs1').innerHTML=document.querySelector('.tab-container:nth-child(2)').innerHTML;
document.getElementById('producttabs1').innerHTML=document.querySelector('.std').innerHTML;
document.getElementById("producttabs1").addEventListener("click", function() {
    copyToClipboard(document.getElementById('producttabs1').innerHTML);
}); 
function copyToClipboard(text) {
  window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}
console.log(fs);
 
<?php }?>
</script>
