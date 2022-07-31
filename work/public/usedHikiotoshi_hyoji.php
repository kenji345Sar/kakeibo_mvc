<?php

require_once(__DIR__ .'/../config/config.php');


$komokuApp = new MyApp\Controller\UsedHikiotoshiHyoji();


//追加の場合
// $komokuApp->add($_POST);


//該当日付
$hiduke = $_GET['yy'].'年'.$_GET['mm'].'月'.$_GET['dd'].'日';

$yy=$_GET['yy'];
$mm=$_GET['mm'];
$dd=$_GET['dd'];


$komokuApp->run($_POST,$yy,$mm,$dd);

$hyouji_komoku = $komokuApp->getValues()->hyojiKomoku;

$gokei = $komokuApp->getValues()->total;
// $hyouji_komoku = $komokuApp->hyoji_komoku($_GET['yy'],$_GET['mm'],$_GET['dd']);
// echo('7777777');
// var_dump($hyouji_komoku);


// $gokei = $komokuApp->hiniti_gokei($_GET['yy'],$_GET['mm'],$_GET['dd']);

// echo('5555555');
// var_dump($gokei);


//該当日付
// $hiduke = $_GET['yy'].'年'.$_GET['mm'].'月'.$_GET['dd'].'日';

// $yy=$_GET['yy'];
// $mm=$_GET['mm'];
// $dd=$_GET['dd'];





?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>/*
	.form_conf {
	    text-align: center;
	}*/
	.form_conf form {
	    display: inline-block;
	    margin: 0 10px;
	}

	#container{
		width: 300px;
		margin: 15px auto;
	}

	.row {
		margin-bottom: 15px;
	}
	#btn{
		display: inline-block;
		width: 50px;
		padding:7px;
		background: #00aaff;
		box-shadow: 0 4px 0 #0088cc;
		color: #fff;
	}


	</style>
</head>
<body>
<div id="container">
	<p>銀行引落</p>
	<div>
		<form action="/usedHikiotoshi_hyoji.php" method="post">
<div class="row">
	費用項目1
	<?php echo $komokuApp->select_Name();?>
<!-- 	<select name="koumoku1">
	<option value="1">食費</option>
	<option value="2">カフェ</option>
	<option value="3">お菓子</option>
	<option value="4">清潔品</option>
	</select> --><br>	

	費用項目2<input type="text" name="tag_name_2"><br>
	金額<input type="text" name="tag_kingaku_2"><br>
	備考<input type="text" name="tag_biko">
	</div>

<!-- 	<div id="btn">登録</div>
	<input type="hidden" name="yy" value=<?php echo $_GET['yy']; ?>>
	<input type="hidden" name="mm" value=<?php echo $_GET['mm']; ?>>
	<input type="hidden" name="dd" value=<?php echo $_GET['dd']; ?>> -->


			<button>登録</button>
			<input type="hidden" name="yy" value="<?php echo $_GET['yy'];?>">
			<input type="hidden" name='mm' value="<?php echo $_GET['mm'];?>">
			<input type="hidden" name='dd' value="<?php echo $_GET['dd'];?>">
			<input type="hidden" name="way" value="add">
		</form>
	</div>
	<div>合計:<?php echo $gokei; ?>円</div>

	<div>登録一覧</div>
	<?php foreach($hyouji_komoku as $hyoji) : ?>
	<div class="row" id="todo">
	<form action="/usedHikiotoshi_hyoji.php?yy=$yy&mm=$mm&dd=$dd" name="form_name_<?php echo $hyoji->id; ?>" id="form_name_<?php echo $hyoji->id; ?>" data-id="<?php echo $hyoji->id; ?>" method="post">
	費用項目1
	<?php echo $komokuApp->komoku_sel($hyoji->sisyutu_type); ?><br>
	費用項目2<input type="text" name="sisyutu_name" value="<?php echo $hyoji->sisyutu_name; ?>"><br>
	金額<input type="text" name="kingaku" value="<?php echo $hyoji->kingaku; ?>"><br>
	備考<input type="text" name="biko" value="<?php echo $hyoji->biko; ?>"><br>
		<input class="submit-button" type="submit" name="submit1" id="submit1" value="修正">
		<!-- <button id="submit1">修正</button> -->

		<input class="submit-sakujo" type="submit" name="submit2" id="submit2" value="削除">
				<!-- <button id="submit2_<?php echo $hyoji->id;?>" class="delete_todo">削除1</button> -->

		<input type="hidden" name="yyyy" value="<?php echo $_GET['yy'];?>">
		<input type="hidden" name='mm' value="<?php echo $_GET['mm'];?>">
		<input type="hidden" name='dd' value="<?php echo $_GET['dd'];?>">
		<input type="hidden" name='id' id="iid" value="<?php echo $hyoji->id;?>">
		
	</form>
	</div>

<?php endforeach; ?>


<a href="/hikiotoshi.php">カレンダーの画面</a>

</div><!-- #container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

 <script>

$('.submit-sakujo').on('click',function(){

	var id = $(this).parent().data('id');

console.log(id);

	alert(id + 'を、削除しますか');
});

// var btn2 = document.getElementById('submit2');
// console.log(btn2);

// btn2.addEventListener("click",function(){
// 	alert('削除しますか')
// 	// document.form_name_56.submit();
// },false);




// function form_check(){
// 	if()
// 	if(document.getElementById('submit1').value == '修正'){
// 		if(confirm('修正してもよろしいですか？')){
// 		}else{
// 			return false;
// 		}
// 	}

// 	if(document.getElementById('submit2').value == '削除'){
// 		if(confirm('削除してもよろしいですか？')){
// 		}else{
// 			return false;
// 		}
// 	}

// 	alert(document.getElementById('submit1').value);
// }
</script>
</body>
</html>