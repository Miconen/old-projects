jQuery(function($){
	var postWrapper = $('#posts');
	var loading = false;
	$('#load-morer').click(function(event){
		event.preventDefault();
		if (!loading) {
			loading = true;
			var button = $(this),
			    data = {
				'action': 'loadmore',
				// 'query': mico_load_params.posts,
				'page' : mico_load_params.current_page
			};
			$.post(mico_load_params.url, data, function(res) {
					if( res ) {
						console.log(res);
						$(postWrapper).append(res);
						mico_load_params.current_page++;
					} else {
						$(button).remove();
					}
				}).fail(function(xhr, textStatus, e) {
					// console.log(xhr.responseText);
			}).always(function(){
				loading = false;
			});
		};
	});
});
