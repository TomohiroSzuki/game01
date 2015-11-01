$(window).load(function(){
	var BH = $("table").height();
	var tableH = $(".player1 table").height();
	$("body").css("height",BH+300 + "px");
	$("html,body").animate({scrollTop:$('#p1ans,#p2ans').offset().top},800);
	$('.player2 table').css("height",tableH+6 + "px");
});

function Cursorpos(curposi){
	if(curposi == "p1"){
		document.form.p1ans.focus();
	}else if(curposi =="p2"){
		document.form.p2ans.focus();
	}
}

function topkakunin(num,turn,nowplayer){
	var obj = document.form;
	var　num = document.getElementById(num).value;
	var num000x = num%10;
	var x = (num-num000x)/10
	var num00x0 = x%10;
	x = (x-num00x0)/10;
	var num0x00 = x%10;
	//var numx000 = (x-num0x00)/10;
	var numarray = [num0x00,num00x0,num000x];
	var jufuku = numarray.filter(function(x,i,self){
		return self.indexOf(x) !== self.lastIndexOf(x);
		});
	if(turn == 'end'){
		alert("ゲームは終了しました");
	}else if(turn !== nowplayer){
		alert("今は相手のターンです");
	}else if(num == "" || isNaN(num)){
		alert("半角数字を入力してください");
	}else if(num.length !==3){
		alert("3桁の数字を入力してください");
	}else if (jufuku.length > 0) {
		alert("数字が重複しています");
	}else{
		if(confirm("この数字でよろしいですか？")){
			obj.submit();
		}
	}
}
function foget(ans){
	if(confirm("秘密の数字を確認しますか？")){
			alert(ans);
	}
}

//CPU対戦時、CPUの最初の答えをランダムで生成
// function vscpu(onoroff){
// 	if(onoroff == "ON"){
// 		var ans1 = Math.floor(Math.random() * 10);
// 		var ans2 = 0;
// 		var ans3 = 0;
// 		var ans4 = 0;
// 		do{
// 			var ans2 = Math.floor(Math.random() * 10);
// 		}while(ans1 == ans2);
// 		do{
// 			var ans3 = Math.floor(Math.random() * 10);
// 		}while(ans1 == ans3 || ans2 == ans3);
// 		do{
// 			var ans4 = Math.floor(Math.random() * 10);
// 		}while(ans1 == ans4 || ans2 == ans4 || ans3 == ans4);
// 		var ans = [ans1*1000+ans2*100+ans3*10+ans4];
// 		if(String(ans).length != 4){
// 			ans = "0"+ans;
// 		}
// 		document.form.p2ans.value = ans;
// 	}
// }