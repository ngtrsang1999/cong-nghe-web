function load_listStoriesTopUpdate(){
	var order_by = 'update_at';
	$.ajax({
			url: "models/ajax/load_home/getListStoriesTop.php",
			method: "POST",
			data:{order_by:order_by},
			success:function(data){
				$('.truyen-moi-cap-nhat .list-story').html(data);
				$('.lazy-img').Lazy();
			}
		});
}

function load_listStoriesTopTrend(){
	var order_by = 'views_month';
	$.ajax({
			url: "models/ajax/load_home/getListStoriesTop.php",
			method: "POST",
			data:{order_by:order_by},
			success:function(data){
				$('.top-trend .container .row').html(data);
			}
		});
}

function load_listStoriesTopViewsWeek(){
	var order_by = 'views_week';
	$.ajax({
			url: "models/ajax/load_home/getListStoriesTop.php",
			method: "POST",
			data:{order_by:order_by},
			success:function(data){
				$('.truyen-top-tuan .list-story').html(data);
				$('.lazy-img').Lazy();
			}
		});
}

function load_listStoriesTopViews(){
	var order_by = 'count_views';
	$.ajax({
			url: "models/ajax/load_home/getListStoriesTop.php",
			method: "POST",
			data:{order_by:order_by},
			success:function(data){
				$('.truyen-doc-nhieu .list-story').html(data);
				$('.lazy-img').Lazy();
			}
		});
}

function load_listSuggestStory(){
	var order_by = 'count_views';
	$.ajax({
			url: "models/ajax/load_home/getSuggestStory.php",
			method: "POST",
			data:{order_by:order_by},
			success:function(data){
				$('#suggest-story').html(data);
				$('.lazy-img').Lazy();
			}
		});
}

function loadStoryOnPageList(){
	var page = $('#page-now').attr('data-page');
	var data_request = $('#data-request').attr('data-request');
	$.ajax({
			url: "models/ajax/load_liststory/getListStory.php",
			method: "POST",
			data:{data_request:data_request, page:page},
			success:function(data){
				$('#data-request').html(data);
				$('.lazy-img').Lazy();
			}
		});
}
function checkrightpage(){
	pm = $('#page-max').attr('data-page');
	if(pm > 1){
		$('#page-right').attr('data-page','2');
	}else{
		$('#page-right').attr('data-page','1');
	}
}

function getPageMax(){
	var data_request = $('#data-request').attr('data-request');
	$.ajax({
			url: "models/ajax/load_liststory/loadPhanTrangList.php",
			method: "POST",
			data:{data_request:data_request},
			success:function(data){
				$('#page-max').attr('data-page',data);
				checkrightpage();
			}
		});
}

function addTheoDoi(story_code){
	$.ajax({
			url: "models/ajax/story/addTheoDoi.php",
			method: "POST",
			data:{story_code:story_code},
			success:function(data){
				if(data == "0"){
					alert('Bạn phải đăng nhập để thực hiện chức năng này');
				}else{
					$('#btn-theodoi').html(' <i class="fa fa-heart" aria-hidden="true"></i> Bỏ theo dõi');
					$('#btn-theodoi').attr('data-action','remove');	
					$('.number-followes').html(data);		
				}
			}
		});
}


function removeTheoDoi(story_code){
	$.ajax({
			url: "models/ajax/story/removeTheoDoi.php",
			method: "POST",
			data:{story_code:story_code},
			success:function(data){
				$('#btn-theodoi').html(' <i class="fa fa-eye" aria-hidden="true"></i> Theo dõi');
				$('#btn-theodoi').attr('data-action','add');	
				$('.number-followes').html(data);			
			}
		});
}

function addLike(story_code){
	$.ajax({
			url: "models/ajax/story/addLike.php",
			method: "POST",
			data:{story_code:story_code},
			success:function(data){
				if(data == "0"){
					alert('Bạn phải đăng nhập để thực hiện chức năng này');
				}else{
					$('#btn-like').html(' <i class="fa fa-thumbs-up" aria-hidden="true"></i> Bỏ thích');
					$('#btn-like').attr('data-action','remove');
					$('.number-like').html(data);			
				}
			}
		});
}

function removeLike(story_code){
	$.ajax({
			url: "models/ajax/story/removeLike.php",
			method: "POST",
			data:{story_code:story_code},
			success:function(data){
				$('#btn-like').html(' <i class="fa fa-thumbs-up" aria-hidden="true"></i> Thích');
				$('#btn-like').attr('data-action','add');
				$('.number-like').html(data);			
			}
		});
}

$(document).ready(function(){
	load_listStoriesTopUpdate();
	load_listStoriesTopViewsWeek();
	load_listStoriesTopViews();
	load_listStoriesTopTrend();
	load_listSuggestStory();
	loadStoryOnPageList();
	getPageMax();
	$('.lazy-img').Lazy();


$('.page-link').on('click', function(){
	var thispage = $(this).attr('data-page');
	thispage = parseInt(thispage, 10);
	var page_max = $('#page-max').attr('data-page');
	var pageRight = thispage + 1;
	if(pageRight > page_max){
		pageRight = page_max;
	}
	var pageLeft = thispage - 1;
	if(pageLeft < 1){
		pageLeft = 1;
	}
	$('#page-now').attr('data-page',thispage);
	$('#page-now').html(thispage);
	$('#page-right').attr('data-page',pageRight);
	$('#page-left').attr('data-page',pageLeft);
	loadStoryOnPageList();
});
});

$('#btn-theodoi').on('click', function(){
	var action = $(this).attr('data-action');
	var story_code = $(this).attr('data-storycode');
	if(action == 'add'){
		addTheoDoi(story_code);
	}else{
		removeTheoDoi(story_code);
	}
});

$('#btn-like').on('click', function(){
	var action = $(this).attr('data-action');
	var story_code = $(this).attr('data-storycode');
	if(action == 'add'){
		addLike(story_code);
	}else{
		removeLike(story_code);
	}
});

$('.btn-close-theodoi').on('click', function(){
	var story_code = $(this).attr('data-story');
	removeTheoDoi(story_code);
	location.reload();
});
