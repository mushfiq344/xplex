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
                        <div class="col-md-4 offset-md-2">     
                            <h1 class="text-center">Tv Shows</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- ////////////////////////////////////////////////////////////////////////////////// -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                </div>
                <div class="form-group">
                    <h4 style="margin-left: 2%;" >Search :</h4>
                    <input autocomplete="off" type="text" style="margin-left: 2%;" class="form-controller" id="search" onkeyup="search_from_table()" name="search"></input>
                    <!-- /////////////////////////////// -->
                    <button id="search_button" onclick="search_text_data()" class="btn btn-primary">Search <i class=" fa fa-search"></i></button>
                    <script>
function search_text_data() {
    var search = document.getElementById("search");
    var url = '/show_tv_shows_search/';
    var search_value = search.value;
    url = url.concat(search_value);
    url = url.replace("%20", " ");
    window.open(url, "_self");
}
                    </script>
                    <!-- /////////////////////////////// -->
                </div>
                <div style="max-height:300px;min-height: 40px;overflow-y:scroll;display: none;"id="tv_show_suggestion">
                    <table class="table table-bordered table-hover">
                        <tbody id= "tbody" >
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
function search_from_table() {
    var x = document.getElementById("search");
    if(x.value.length==0){
        document.getElementById("tv_show_suggestion").style.display = "none";
    }else{
        $.ajax({
            type: 'get',
            url: "{{URL::to('search_tv_show_from_table')}}",
            data: { 'search': x.value },
            success: function(data) {
                $('#tbody').html(data);
                $('#tv_show_suggestion').css('display','block');
            }
        });
    }
}
            </script>
            <script type="text/javascript">            
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });  </script>
            <script type="text/javascript" >
$(document).ready(function() {
    $(document).on("click", "#search_button", function() {
        $value = this.id;
        $("#search").val(" ");
        $('#tbody').html(" ");
        $.ajax({
            type: 'get',
            url: "{{URL::to('search_single_tv_show_from_table ')}}",
            data: { 'search': $value },
            success: function(data) {
                $("#search").val(data[0]['title']);
                console.log(data[0]);
            }
        });
    });
    $(document).on("click", ".clickMe", function() {
        $value = this.id;
        $("#search").val(" ");
        $('#tbody').html(" ");
        $("#search").val(this.innerHTML);
        $('#movie_suggestion').css('display','none');
    });
});
            </script>
            <!-- ////////////////////////////////////////////////////////////////////////////////// -->
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(Session::get('tv_shows') as $author)
                    <tr>
                        <td>{{ $author->title }}</td>
                        <td>{{ $author->year }}</td>
                        <td>{{ $author->imdbrating }}</td>
                        <td>
                            <i class="fa fa-pencil"></i>
                            <a href="{{url('edit_tv_show/'.$author->id)}}" class="btn btn-default">Edit</a>
                            <button     id="{{$author->id}}" onclick="deleteRow(this)" class="btn btn-danger">Delete 
                                <i class="fa fa-close"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-success"  onclick="get_print_type('{{$author->id}}')">Scan <i class="fa fa-search"></i></button>
                            
                            <div id="{{'spin_scan_tv_show_'.$author->id}}" class="loader"
                            style="display: none;float:right;margin-right: 115px;"></div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No entries found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ Session::get('tv_shows')->links() }}
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>

function get_print_type(id){
     $('#spin_scan_tv_show_'+id).fadeIn(300);
    $value=id;
    $.ajax({
            type: 'get',
            url: "{{URL::to('scan_single_tv_show')}}",
            data: { 'scan_id': $value },
            success: function(data) {
                console.log(data);
                $('#spin_scan_tv_show_'+id).fadeOut();
            }
        });

}


function deleteRow(r) {
    var choice = confirm("You want to delete this movie ?");
    if (choice == true) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("myTable").deleteRow(i);
        $value = r.id;
        console.log($value);
        $.ajax({
            type: 'get',
            url: "{{URL::to('delete_tv_show')}}",
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
            }
        });
    } else {}
}
</script>
@endsection