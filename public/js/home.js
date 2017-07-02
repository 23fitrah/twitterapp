$(document).ready(function(){

  load_tweet_list();
	
  setInterval(function(){ 
       $('#datatable_tweet').DataTable().ajax.reload();
  }, 10000);

	

	$("#post").click(function(){
		tweet_post();
	});

	$("#post_form").click(function(){
		$("#myModal").modal('show');
	});

	 
});

function load_tweet_list()
{
    var configTable={
		 "pageLength": 7,
      "ajax": {
          "url":"tweet_list",
          "type": "GET",
          "data": function(d){
				      d._token = $("#_token").val();
			     }
      },
     'bDestroy':true,
      "columns": [
        {"data" :"id_tweet"},
        { "data": "tweet"},
  			{ "data": "favorite"},
  			{ "data": "retweet"},
		  ],
		 "aoColumnDefs": [
      {
          "aTargets": [ 2 ],
          "mRender": function ( data, row, full ) {
            return data;
          }
      },
      {
          "aTargets": [ 4 ],
          "mRender": function ( data, row, full ) {
              	return action(full.id_tweet);
          }
      }
      ],

    }
	 var oTable=$('#datatable_tweet').DataTable(configTable);

   $("#datatable_tweet_length select").addClass("form-control");
   $("#datatable_tweet_filter input").addClass("form-control");
}

function tweet_post()
{
	$.ajax({
      url: 'post_tweet',
      type: "POST",
      data: {
      	'_token':$('#_token').val(),
      	'tweet':$('#tweet').val()
      },
      success: function(res){
	var res = JSON.parse(res);
        if(res.message=='success')
        {
		alert('Posting Success');
        	$('#tweet').val("");
	        $("#myModal").modal('hide');
	        $('#datatable_tweet').DataTable().ajax.reload();
        }else
        {
        	alert('Posting Failed');
        }
       
      },
      error:function(err){
      	console.log(err);
      }
    }); 
}

function action(id)
{ 
    var detail="<button class='btn btn-info'  onclick=a('"+id+"'); >Detail</button>";
    return detail;
}

function a(id)
{

	tweet_detail(id);
}

function tweet_detail(idx)
{

	$.ajax({
      url: 'tweet_detail/'+idx,
      type: "GET",
      success: function(res){	
        var res = JSON.parse(res);
  	     $(".id_tweet").text(res.id);
  	     $(".tweet").text(res.text.trim());
  	     $(".create_at").text(res.create_at);
  	     $(".favorite").text(res.favorite);
  	     $(".retweet").text(res.retweet);
         $(".place").text(res.place);
         $("#myModal2").modal('show');
      },
      error:function(err){
      	console.log(err);
      }
    }); 
}
