

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
            <form class="form-inline" method="GET">
                <div class="form-group mb-2">
                    <label for="filter" class="col-sm-2 col-form-label">Search </label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Title or Author ..." >
                </div>
                 <input type='button' value='Search' id='but_search'>
 
                
            </form>
               
            </div>
        </div>

       
    
 
   <!-- Table -->
   <table border='1' id='searchTable' style='border-collapse: collapse;'>
     
     <tbody></tbody>
   </table>
 
   <!-- Script CDN -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!-- Script Local -->
   <!-- <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script> -->
 
   <script type='text/javascript'>
   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   $(document).ready(function(){
 
 
      // Search by 
      $('#but_search').click(function(){
         var search = $('#search').val().trim();
 
         if(search != ''){
 
           // AJAX POST request
           $.ajax({
              url: '/searchbook',
              type: 'post',
              data: {_token: CSRF_TOKEN, search: search},
              dataType: 'json',
              success: function(response){
 
                 createRows(response);
 
              }
           });
         }
 
      });
 
   });
 
   // Create table rows
   function createRows(response){
      var len = 0;
      $('#searchTable tbody').empty(); // Empty <tbody>
      if(response['data'] != null){
         len = response['data'].length;
      }
 
      if(len > 0){
         var tr_str = "<tr>" +
             "<th align='center'> </th>" +
             "<th align='center'> Title </th>" +
             "<th align='center'> Author </th>" +
             "<th align='center'> ISBN </th>" +
           "</tr>";

        for(var i=0; i<len; i++){
           var id = response['data'][i].id;
           var title = response['data'][i].title;
           var author = response['data'][i].author;
           var isbn = response['data'][i].isbn;
 
           var tr_str = "<tr>" +
             "<td align='center'>" + (i+1) + "</td>" +
             "<td align='center'>" + title + "</td>" +
             "<td align='center'>" + author + "</td>" +
             "<td align='center'>" + isbn + "</td>" +
           "</tr>";
 
           $("#searchTable tbody").append(tr_str);
        }
      }else{
         var tr_str = "<tr>" +
           "<td align='center' colspan='4'>No record found.</td>" +
         "</tr>";
 
         $("#searchTable tbody").append(tr_str);
      }
   } 
   </script>
</body>
</html>
      
