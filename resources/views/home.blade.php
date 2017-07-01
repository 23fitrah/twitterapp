@extends('app')

@section('content')
<style type="text/css">
	th,td{
		text-align:center;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-striped table-hover table-bordered dataTable" id="datatable_tweet" aria-describedby="editable-sample_info" width="100%">
	            <thead>
					<tr>
						<th>ID Tweet</th>
						<th>Tweet</th>
						<th>Favorite</th>
						<th>Retweet</th>
						<th>Action</th>
					</tr>
				</thead>
               <tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="odd">
               </tbody>
            </table>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"  style="text-align: center">Posting Tweet</h4>
            </div>
            <div class="modal-body">
	            <form class="form-horizontal" action="#" name="tweetBuilder">
                            <div class="form-group">
                                <label class="control-label col-md-3">Tweet</label>
                                <div class="col-md-8">
	                                <input id="_token" type="hidden" value="{{{ csrf_token() }}}" />
	                                <input type="text" name="tweet" id="tweet" class="form-control" />
                                </div>
                            </div>
                  </form>
            </div>
            <div class="modal-footer" style="text-align: center">
                <button class="btn btn-success" id="post">Post</button>
            </div>
        </div>
    </div>
</div> 

<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"  style="text-align: center">Id Tweet : <span class="id_tweet"></span></h4>
            </div>
            <div class="modal-body">
	             <form class="form-horizontal  " action="#">
                            <div class="form-group">
                                <label class="control-label col-md-3">Tweet</label>
                                <div class="col-md-8">
                                    <p class="tweet form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Create At</label>
                                <div class="col-md-8">
                                    <p class="create_at form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Favorite</label>
                                <div class="col-md-8">
                                    <p class="favorite form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Retweet</label>
                                <div class="col-md-8">
                                    <p class="retweet form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">place</label>
                                <div class="col-md-8">
                                    <p class="place form-control-static"></p>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>
@endsection
