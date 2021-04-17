
<!------ Include the above in your HEAD tag ---------->


</head>
<style>
	.container2 {max-width:600px; margin:auto;position: fixed;z-index: 100 !important; right: 0px;background-color: #dddddd;bottom: 0px; border: green;  border-radius: 25px}
	img{ max-width:100%;}
	.inbox_people {
		background: #f8f8f8 none repeat scroll 0 0;
		float: left;
		overflow: hidden;
		width: 40%; border-right:1px solid #c4c4c4;
	}
	.inbox_msg {
		border: 1px solid #c4c4c4;
		clear: both;
		overflow: hidden;
	}
	.top_spac{ margin: 20px 0 0;}


	.recent_heading {float: left; width:40%;}
	.srch_bar {
		display: inline-block;
		text-align: right;
		width: 60%;
	}
	.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

	.recent_heading h4 {
		color: #05728f;
		font-size: 21px;
		margin: auto;
	}
	.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
	.srch_bar .input-group-addon button {
		background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
		border: medium none;
		padding: 0;
		color: #707070;
		font-size: 18px;
	}
	.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

	.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
	.chat_ib h5 span{ font-size:13px; float:right;}
	.chat_ib p{ font-size:14px; color:#989898; margin:auto}
	.chat_img {
		float: left;
		width: 11%;
	}
	.chat_ib {
		float: left;
		padding: 0 0 0 15px;
		width: 88%;
	}

	.chat_people{ overflow:hidden; clear:both;}
	.chat_list {
		border-bottom: 1px solid #c4c4c4;
		margin: 0;
		padding: 18px 16px 10px;
	}
	.inbox_chat { height: 300px; overflow-y: scroll;bottom: 0px}

	.active_chat{ background:#ebebeb;}

	.incoming_msg_img {
		display: inline-block;
		width: 6%;
	}
	.received_msg {
		display: inline-block;
		padding: 0 0 0 10px;
		vertical-align: top;
		width: 92%;
	}
	.received_withd_msg p {
		background: #ebebeb none repeat scroll 0 0;
		border-radius: 3px;
		color: #646464;
		font-size: 14px;
		margin: 0;
		padding: 5px 10px 5px 12px;
		width: 100%;
	}
	.time_date {
		color: #747474;
		display: block;
		font-size: 12px;
		margin: 8px 0 0;
	}
	.received_withd_msg { width: 57%;}
	.mesgs {
		float: left;
		padding: 30px 15px 0 25px;
		width: 60%;
		background-color: #dddddd;
	}

	.sent_msg p {
		background: #05728f none repeat scroll 0 0;
		border-radius: 3px;
		font-size: 14px;
		margin: 0; color:#fff;
		padding: 5px 10px 5px 12px;
		width:100%;
	}
	.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
	.sent_msg {
		float: right;
		width: 46%;
	}
	.input_msg_write input {
		background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
		border: medium none;
		color: #4c4c4c;
		font-size: 15px;
		min-height: 48px;
		width: 100%;
	}

	.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
	.msg_send_btn {
		background: #05728f none repeat scroll 0 0;
		border: medium none;
		border-radius: 50%;
		color: #fff;
		cursor: pointer;
		font-size: 17px;
		height: 33px;
		position: absolute;
		right: 0;
		top: 11px;
		width: 33px;
	}
	.messaging { padding: 0 0 50px 0;}
	.msg_history {
		height: 300px;
		overflow-y: auto;
	}
	.btn-close{
		float:right;
	}
	.open-chat{
		right: 0px;
		position: fixed;
		bottom: 0px;
		z-index: 100;
	}
	.btn-open-chat{
		width: 100px;
	}
	.btn-open-chat :hover{
		background-color: #1e7e34;
	}
</style>
<body>
<div class="open-chat">
	<button class="btn-open-chat btn btn-primary "> Open Chat </button>
</div>
<div class="container2">
	<h3 class=" text-center">Messaging
	<button class="btn-close btn btn-warning  form-inline" >Close <span class="fa fa-close"></span></button></h3>
	<div class="messaging">
		<div class="inbox_msg">
			<div class="inbox_people">
				<div class="headind_srch">
					<div class="recent_heading">
						<h4>Recent</h4>
					</div>

				</div>
				<div class="inbox_chat ">
				</div>
			</div>
			<div class="mesgs">
				<div class="msg_history" >


				</div>
				<div class="type_msg">
					<div class="input_msg_write">
						<input type="text" class="write_msg" placeholder="Type a message"/>
						<button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>

	</div></div>
</body>
</html>

<script>
   var selected_chat ="";
	$(document).ready(function(){
			$('.container2').hide();
		$('.btn-close').on('click',function(){
			$('.container2').slideToggle();
		});

	});


	$(document).ready(function(){


		$('.btn-open-chat').on('click',function(){
			$('.container2').slideToggle();

			var fetch_chat_list = "<?= base_url().'user/fetch_chat_list'?>";

			$.post( fetch_chat_list,{},function(success){

			} ).done(function(datas){
				datas = JSON.parse(datas);

				$('.inbox_chat').html("");
				$.each(datas,function (index,data){
					console.log(data);

					$('.inbox_chat').append('<div class="chat_list active_chat "><div style="cursor: pointer" class="chat_people" data-user_chat_id = "'+data.following_id+'" id="people_'+data.following_id+'"> <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="pic"> </div><div class="chat_ib"><h5>'+data.first_name+' '+data.last_name+'<span class="chat_date">'+data.date_time+'</span></h5><p>'+data.message+'</p></div></div></div>')
				})
			});
		});



			$('.inbox_chat').on('click', '.chat_people', function () {
				var chat_from = $(this).attr('data-user_chat_id');
				var fetch_chat_message = "<?= base_url() . 'user/fetch_chat_message'?>";
				var myUserId = "<?=$this->session->userdata('id')?>";
				selected_chat = chat_from;
				getChat(chat_from, fetch_chat_message, myUserId);
				// getChat(chat_from, fetch_chat_message, myUserId);
				// setInterval(getChat,3000);

			});


		$('.input_msg_write').on('click','.msg_send_btn',function(){
			var save_message = "<?= base_url().'user/chat_save_message'?>";
			var message = $('.write_msg').val();
			var send_to = selected_chat;

			send_chat(save_message,message,send_to);

		});
	});


	 function getChat(chat_from,fetch_chat_message,myUserId){

		$.post(fetch_chat_message,{'chat_from':chat_from},function(success){

		}).done(function(messages){
			messages = JSON.parse(messages);
			$('.msg_history').html("");

			$.each(messages , function(index,message){

				if(message.date_time==undefined){
					$('.incoming_msg').html("");
					return false;
				}
				if (message.chat_from==myUserId){

					$('.msg_history').append('	<div class="incoming_msg"><div class="received_msg"><div class="sent_msg"><p>'+message.message+'</p><span class="time_date">'+message.date_time+'</span></div></div>');
				}
				else{

					$('.msg_history').append('	<div class="outgoing_msg"><div class="received_withd_msg" data-sent_from = "'+message.chat_from+'"> <p>'+message.message+'</p><span class="time_date">'+message.date_time+'</span></div></div>');
				}
				$(".msg_history").scrollTop($(".msg_history")[0].scrollHeight);
			});

		});
	}

	function send_chat(save_message,message,send_to){
		if(message.trim()==""){
			alertify.error('Message cant be empty');
			return false;
		}
		$.post(save_message,{'send_to':send_to,'message':message},function(success){
			if(success){
				$('.write_msg').val("");
				$('.msg_history').append('<div class="received_msg"><div class="sent_msg"><p>'+message+'</p><span class="time_date">just now</span></div>');
			}
		});
	}
</script>
