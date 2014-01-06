
$(document).ready(function() {
    $('#tagsearch').keyup( function(){
        
        var query = $(this).val();
        query = query.toLowerCase();
        
        if( query === '' ){
            $('#tagsearchresults').remove();
            $('#tagsearchresult').hide();
            return;
        }
        
        $.ajax({
            type: "POST",
            url: "/boot/?p=api&p1=tag&p2=search",
            data: {q: query},
            success: function( data ){
                
                var dataobj = jQuery.parseJSON( data );
                
                if( "results" in dataobj ){
                    $('#tagsearchresults').remove();
                    var html='<ul id="tagsearchresults">';
                    for( rez in dataobj.results ) {
                        html += '<li class="tag"><a href="/boot/?p=tag&tag='+dataobj.results[rez].tag_key+'">'+dataobj.results[rez].tag_disp+'</a></li>';
                    }
                    html += '</ul>';
                    
                    $('#tagsearchresult').show();
                    $('#tagsearchresult').append(html);
                    
                }
                
            }
        });
        
    })
});