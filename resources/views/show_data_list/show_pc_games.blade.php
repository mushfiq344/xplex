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
                            <h1 class="text-center">PC Games</h1>
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
                    <button id="search_button" onclick="search_text_data()" class="btn btn-primary">Search <i class="fa fa-search"></i></button>
                    <script>
function search_text_data() {
    var search = document.getElementById("search");
    var url = '/show_pc_games_search/';
    var search_value =  search.value;
    url=url.concat(search_value);
    url=url.replace("%20"," ");
    window.open(url,"_self");
    }
                    </script>
                    <!-- /////////////////////////////// -->
                </div>
                <div style="max-height:300px;min-height: 40px;overflow-y:scroll;display: none;"id="pc_game_suggestion">
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
        document.getElementById("pc_game_suggestion").style.display = "none";
    }else{
        $.ajax({
            type: 'get',
            url: "{{URL::to('search_pc_games_from_table')}}",
            data: { 'search': x.value },
            success: function(data) {
                $('#tbody').html(data);
                $('#pc_game_suggestion').css('display','block');
            }
        });
    }
}
            </script>
            <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            </script>
            <script type="text/javascript" >
$(document).ready(function() {
    $(document).on("click", "#search_button", function() {
        $value = this.id;
        $("#search").val(" ");
        $('#tbody').html(" ");
        $.ajax({
            type: 'get',
            url: "{{URL::to('search_single_pc_games_from_table')}}",
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
         $('#pc_game_suggestion').css('display','none');

    });
});
            </script>
            <!-- ////////////////////////////////////////////////////////////////////////////////// -->
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(Session::get('pc_games') as $author)
                    <tr>
                        <td>{{ $author->title }}</td>
                        <td>{{ $author->igdbrating }}</td>
                        <td>
                            <i class="fa fa-pencil"></i>
                            <a href="{{url('edit_pc_games/'.$author->id)}}" style="margin-right: 10px">Edit</a>
                            <button class="btn btn-danger"    id="{{$author->id}}" onclick="deleteRow(this)" >Delete 
                                <i class="fa fa-close"></i></button>
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
                {{ Session::get('pc_games')->links() }}
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
function deleteRow(r) {
    var choice = confirm("You want to delete this Pc Game ?");
    if (choice == true) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("myTable").deleteRow(i);
        $value = r.id;
        console.log($value);
        $.ajax({
            type: 'get',
            url: "{{URL::to('delete_pc_games')}}",
            data: { 'search': $value },
            success: function(data) {}
        });
    } else {}
}
</script>
@endsection