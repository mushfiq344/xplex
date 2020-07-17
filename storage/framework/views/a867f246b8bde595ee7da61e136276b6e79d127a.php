<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); ">
            <div class="modal-header" style="background-color: #020C17; border:0;border-radius:10px 10px 0 0">
                <button type="button" style="color: #FFF" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title" id="myModalLabel"><i style="padding-right: 15px;" class="fa fa-search"></i>
                    Search</h2>
            </div>
            <div class="modal-body" style="padding-left: 20%; background-color: #020C17;">
                <p>Enter File Name:</p>
                <form>
                    <div class="row">
                        <div class="youplay-input col-lg-10">
                            <input type="text" name="search" placeholder="Type Filename" onkeyup="searchBy(this.value)">
                        </div>

                    </div>
                </form>
            </div>
            <div id="search_result" class="modal-body" style="padding-left: 10%; background-color: #020C17">

                <br>
            </div>

        </div>
    </div>
</div>
</div>