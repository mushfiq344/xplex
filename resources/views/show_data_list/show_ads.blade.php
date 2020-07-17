@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row"> 
                        <div class="col-md-1">     
                            <a href="{{ url('dashboard_explore') }}" title="Return to dashboard"><i class="fa fa-arrow-left mt-2" style="font-size:36px"></i></a>
                        </div>   
                        <div class="col-md-4 offset-md-3">     
                            <h1 class="text-center">Movies</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ////////////////////////////////////////////////////////////////////////////////// -->
            <table class="table table-hover" id="ad_list">
                <thead>
                    <tr>
                        <th>Banner</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($ads as $ad) {
                    ?>      
                            <tr>
                                <td><img src="{{ asset($ad->name) }}" width="200px" height="100px"></td>  
                                <td>
                                    <button class="btn btn-danger" onclick="delete_ad(this)" id="{{$ad->id}}">Delete</button>
                                </td>
                            </tr>
                    <?php    
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
function delete_ad(r) {
    var confirmation = confirm("Want to delete this advertisement ?");
    if (confirmation == true) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("ad_list").deleteRow(i);
        $value = r.id;
        $.ajax({
            type: 'get',
            url: "/delete_ad",
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
            }
        });
    } else {
        alert('Delete Cancelled')
    }
}
</script>
@endsection