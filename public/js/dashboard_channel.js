var image_no = 2;
 $(document).ready(function() {
     $("#add_new_channel").click(function() {
         var html = $("#copy_channel").html();
         html = html.replace('load_image', 'load_image_' + image_no);

         html = html.replace('preview_image', 'preview_image_' + image_no);

         $(".increment").after(html);
         image_no++;
     });
     $("body").on("click", ".btn-danger", function() {
         $(this).closest(".control-group").remove();
     });

 });


 function delete_channel(r) {
     var i = r.parentNode.parentNode.rowIndex;
     document.getElementById("tv_channels").deleteRow(i);
     var value = r.id;
     console.log(r.id);
     $.ajax({
         type: 'get',
         url: '/delete_channel',
         data: { 'id': value },
         success: function(data) {
             console.log(data);
         }
     });
 }
 ////////////////////////
 function preview_image(input) {
     console.log(input.id);
     var str = input.id;
     str = str.toString();
     var product_image_id = str.replace("load_image", "preview_image");

     if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function(e, id) {
             console.log(e);
             $('#' + product_image_id)
                 .attr('src', e.target.result);

         };
         reader.readAsDataURL(input.files[0]);
     } else {
         $('#' + product_image_id)
             .attr('src', '');
     }
 }