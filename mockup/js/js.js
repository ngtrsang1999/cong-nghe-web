function show_dangnhap(){
	$('.tab-content .form-login').css('visibility','visible');
	$('.tab-content .form-registration').css('visibility','hidden');
	$('.modal-btn-dangnhap').css({'background-color':'#56ccf2', 'color': '#fff'});
	$('.modal-btn-dangky').css({'background-color':'#fff', 'color': '#007bff'});
}

function show_dangky(){
	$('.tab-content .form-login').css('visibility','hidden');
	$('.tab-content .form-registration').css('visibility','visible');
	$('.modal-btn-dangky').css({'background-color':'#56ccf2', 'color': '#fff'});
	$('.modal-btn-dangnhap').css({'background-color':'#fff', 'color': '#007bff'});
}
$('.btn-dangky, .modal-btn-dangky').on('click', function(){
	show_dangky();
});
$('.btn-dangnhap, .modal-btn-dangnhap').on('click', function(){
	show_dangnhap();
});




