function loadPhanTrangChapter(){
	var data_rq_chapter = $('#content-chapter').attr('data-request');
	$.ajax({
			url: "models/ajax/load_chapter/loadPhanTrang.php",
			method: "POST",
			data:{data_rq_chapter:data_rq_chapter},
			success:function(data){
				$('.pagination').html(data);
			}
		});
}

function loadInfoChapter(){
	var data_rq_chapter = $('#content-chapter').attr('data-request');
	$.ajax({
			url: "models/ajax/load_chapter/loadInfoChapter.php",
			method: "POST",
			data:{data_rq_chapter:data_rq_chapter},
			success:function(data){
				$('.title-readstory').html(data);
				autoAddViews();
				autoAddLichSu();
			}
		});
}

function autoAddLichSu(){
	var data = $('#linkOfChapter').attr('href');
	$.ajax({
			url: "models/ajax/load_chapter/autoAddLichSu.php",
			method: "POST",
			data:{data:data},
			success:function(data){
			}
		});
}
function autoAddViews(){
	var data = $('#linkOfChapter').attr('href');
	$.ajax({
			url: "models/ajax/load_chapter/autoAddViews.php",
			method: "POST",
			data:{data:data},
			success:function(data){			}
		});
}

function loadDataChapter(){
	var data_rq_chapter = $('#content-chapter').attr('data-request');
	$.ajax({
			url: "models/ajax/load_chapter/loadDataChapter.php",
			method: "POST",
			data:{data_rq_chapter:data_rq_chapter},
			success:function(data){
				if(data == false){
					$('#content-chapter').html('<p class="text-danger" style = "font-size: 30px;">Không có dữ liệu của chapter này !</p>');				
					$('.title-readstory, .story-see-footer').css('display','none');

				}else{
					loadInfoChapter();
					loadPhanTrangChapter();
					$('#content-chapter').html(data);
				}

				$('.lazy-img').Lazy();
			}
		});
}



$(document).ready(function(){
	loadDataChapter();
});