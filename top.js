//ウィンドウの高さをbodyに適応
// $(window).on('load' ,function(){
// 	var WH = $(window).height();
// 	$("body").css("height",WH-80 + "px");
// });


var p1Flag = false;
var p2Flag = false;
var cpuflag = false

$(window).load(function(){
	//alert("各プレイヤーはプレイヤー名と3桁の数字(確認)を入力してください");
	$(".p1,.p2").animate({
		opacity:"1",
		width:"212px"
	},500);
});

function kakunin(name,x,y){
	var pname = document.getElementById(name).value;
	var numx = document.getElementById(x).value;
	var numy = document.getElementById(y).value;

//	重複チェックのための変数
	var num000x = numx%10;
	var x = (numx-num000x)/10
	var num00x0 = x%10;
	x = (x-num00x0)/10;
	var num0x00 = x%10;
	//var numx000 = (x-num0x00)/10;
	var numarray = [num0x00,num00x0,num000x];
	var jufuku = numarray.filter(function(x,i,self){
		return self.indexOf(x) !== self.lastIndexOf(x);
		});
	if (pname == "") {
	 	alert("名前を入力してください");
	}else if (numx ==""|| numy==""){
		alert(pname+"は数字を入力してください");
	}else if(isNaN(numx) || isNaN(numy)){
		alert("数字を入力してください");
	}else if(numx.length!==3){
		alert("3桁の数字を入力してくさい");
	}else if(numx === numy){
		if(jufuku.length > 0){
			alert("数字が重複しています\n二度同じ数字は使用できません");
		}else{
			if(document.getElementById(name) == player1){
				p1Flag=true;
				$(".p1").css("background","#9f9").attr('readonly','readonly');
			}else{
				p2Flag=true;
				$(".p2").css("background","#9f9").attr('readonly','readonly');
			}
		}
	}else{
		alert("数字(確認)が一致しません");
	}
}

function syoukyo(pname,px,py){
	if(pname=="player1"){p1Flag=false;$(".p1").css("background","#fff").removeAttr('readonly');document.getElementById(pname).value="プレイヤー１";document.form.player1.focus();}
	if(pname=="player2"){p2Flag=false;$(".p2").css("background","#fff").removeAttr('readonly');document.getElementById(pname).value="プレイヤー２";document.form.player2.focus();}
	document.getElementById(px).value="";
	document.getElementById(py).value="";
}

function kakuninfinal(){
	var obj = document.form;
	var round = document.form.round.value;
	if (p1Flag && p2Flag) {
		if(confirm("対戦回数："+ round +"回でゲームを開始しますか？")){
			obj.submit();
		}
	}else　if(!p1Flag && !p2Flag){
		$(".p1,.p2").css("background","#fbb");
		alert("両プレイヤーは入力の上、確認ボタンを押してください");
	}else if(!p1Flag){
		$(".p1").css("background","#fbb");
		alert("プレイヤー1は入力の上、確認ボタンを押してください");
	}else{
		$(".p2").css("background","#fbb");
		alert("プレイヤー2は入力の上、確認ボタンを押してください");
	}
}
function cpuFlag(){
	var flagval = document.form.cpuflag.value;
	if(flagval == "OFF"){
		document.form.cpuflag.value = "ON";
		var ans1 = Math.floor(Math.random() * 10);
		var ans2 = 0;
		var ans3 = 0;
		//var ans4 = 0;
		do{
			var ans2 = Math.floor(Math.random() * 10);
		}while(ans1 == ans2);
		do{
			var ans3 = Math.floor(Math.random() * 10);
		}while(ans1 == ans3 || ans2 == ans3);
		// do{
		// 	var ans4 = Math.floor(Math.random() * 10);
		// }while(ans1 == ans4 || ans2 == ans4 || ans3 == ans4);
		var ans = String(ans1)+String(ans2)+String(ans3);
		// if(String(ans).length != 3){
		// 	ans = "0"+ans;
		// }
		$(".cpuflag input").css("background","#9f9");
		//console.log(ans);
		document.form.number2.value = ans;
		document.form.number22.value = ans;
		p2Flag=true;
		$(".p2").css("background","#a6d").attr('readonly','readonly');
	}else {
		syoukyo('player2','number2','number22');
		document.form.cpuflag.value = "OFF";
		$(".cpuflag input").css("background","#fff");
	}
}