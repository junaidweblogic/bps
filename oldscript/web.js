viewimage = function(img)
{
		var formstr = '<form name="fmfrnd" method="GET">'+'<div align="center"> <h3>'+ img +'</h3> </div>'+'</form>';
		jqistates = {
					state0: {
						html: formstr,
						focus: 1,
						buttons: { Close: false },
						submit: function(v, m, f){
							var e = "";
							m.find('.errorBlock').hide('fast',function(){ jQuery(this).remove(); });
							
							if (v) {
								if (e == "") 
								{
								}
								else{
									jQuery('<div class="errorBlock" style="display: none;">'+ e +'</div>').prependTo(m).show('slow');
								}
								return false;
							}
							else return true;
						}
					},
					state1: {
						html: '<div id="response" style="text-align:center;"></div>',
						focus: 1,
						buttons: { Back: false, Done: true },
						submit: function(v,m,f){
							if(v)
								return true;
								
							jQuery.prompt.goToState('state0');
							return false;
						}
					}
				};
				
				$.prompt(jqistates);
}
