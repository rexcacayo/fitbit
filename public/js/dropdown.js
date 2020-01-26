$("#spa").change(function(event){
    if ( $(".valores").length > 0 ) {
        $(".valores").remove();
      }
    $.get("sensores"+event.target.value+"",function(response,state){
        for(i=0; i<response.length; i++){
            $("#cerebro").append("<option class='valores' value='"+response[i].fiwarePath+"_"+response[i].entity_name+"_"+response[i].entity_type+"'>"+response[i].device_id+"</option>");
        }
    })
})
