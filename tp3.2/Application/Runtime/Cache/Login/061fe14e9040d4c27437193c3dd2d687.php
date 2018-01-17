<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/Public/reslog/css/manhuaDate.1.0.css">
		<link rel="stylesheet" type="text/css" media="screen" href="/Public/reslog/css/iPicture.css"/>
		<link rel="stylesheet" type="text/css" media="screen" href="/Public/reslog/css/css.css"/>

		<script type="text/javascript" src="/Public/reslog/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/Public/reslog/js/jquery.date_input.pack.js"></script>
		<script type="text/javascript" src="/Public/reslog/layer/2.4/layer.js"></script>

		<style>

		</style>
		<title>登录</title>
	</head>
<body>
	<div style="margin-top:20px">
	<form action="" id="leave" method="post" class="basic-grey" enctype="multipart/form-data">
	<!-- <form action="<?php echo U('Login/do_register');?>" method="post" class="basic-grey" enctype="multipart/form-data"> -->
		<h1>登录
			<span></span>
		</h1>
		<label>
			<!--姓名-->
			<span>用户名 :</span>
			<input id="username" type="text" name="username" placeholder="请输入姓名" />
			<!--密码-->
			<label>
				<span>密码 :</span>
				<input id="password" type="password" name="password" placeholder="">
			</label>
			<label>
				<div style="margin-left:20%">
					<input type="checkbox" name="yonghu" value="1" placeholder="">
					<span style="margin-left:20px">是否记住用户</span>
				</div>
			</label>
				<br/>
				<!-- <input type="submit" class="submit" value="提交" /> -->
				<input type="button" id="button" class="submit" style="clear:both" value="登录" />
		</label> 
</form>
</div>
<script src="/Public/reslog/js/laydate.js"></script>
<script type="text/javascript" src="/Public/reslog/js/jquery.ipicture.js"></script>
<script type="text/javascript">
	$(function(){
	$("#button").click(function(){
		var form = new FormData(document.getElementById("leave"));
		console.log(form);
		var username=$('#username').val();
			if(!(/^[\u0391-\uFFE5]+$/.test(username))){
				layer.msg('请输入正确的姓名格式');
				return false;
			}
		var password=$('#password').val();
		var pwdReg = /(?!^[0-9]+$)(?!^[A-z]+$)(?!^[^A-z0-9]+$)^.{8,16}$/;
			if($("#password").val().length<8||$("#password").val().length>16){
                layer.msg("请输入8-16位密码");
                return false;
			}else if(!pwdReg.test($("#password").val())){
				layer.msg("密码必须包含字母、数字、符号中至少2种");
                return false;
			}
		$.ajax({
			url:"<?php echo U('Login/do_login');?>",
			type:"POST",
			data:form,
			processData: false,
   			contentType: false,
			success:function(data){
				switch(data.status){
					case 1:layer.msg(data.msg, {
                                 anim: 0
                              });
                            setInterval(function () {
                            location.href="<?php echo U('Index/index');?>";
                            },1000);
                    case 2 :layer.msg(data.msg, {
                                 anim: 0
                              });break;
					case 3 :layer.msg(data.msg, {
                                 anim: 0
                              });break;
                }
			},
			error:function(){
				layer.msg('错误');
			},
		});
		
			
	});

	})

</script>
</body>
</html>