function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);


$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    }else{

    	 $(':checkbox').each(function() {
            this.checked = false;                        
        });
    }

});

var chat = {}
chat.fetchMessages = function (){
	$.ajax({
		url: 'ajax/chat.php',
		type: 'post',
		data: { method: 'fetch'},
		success: function(data){
			$('.chat .messages').html(data);
		}

	});
}

chat.throwMessage =function(message) {
		if($.trim(message).length != 0){
			$.ajax({
		url: 'ajax/chat.php',
		type: 'post',
		data: { method: 'throw', message: message},
		success: function(data){
			chat.fetchMessages();
			chat.entry.val('');
		}

	});

		}




}



chat.entry =$('.chat .entry');
chat.entry.bind('keydown', function(e){
	if (e.keyCode === 13 && e.shiftKey === false){
		chat.throwMessage($(this).val());
		e.preventDefault();
	}


});


chat.interval = setInterval(chat.fetchMessages, 1000);
chat.fetchMessages();