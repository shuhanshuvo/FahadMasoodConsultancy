<footer>
	<div class="container">
	   <div class="well text-center">
			Copyright © 2018 Fahad Masood. All rights reserved.
       </div>

    </div>
</footer>

<script src="inc/jquery-3.1.1.min.js"></script>
<script src="inc/bootstrap.min.js"></script>
<script src="inc/jquery.download.js"></script>
<script src="inc/simple.fileupload.js"></script>

<script type="text/javascript">

  $(document).on("click", "a.myClass1", function () {
    $.fileDownload($(this).prop('href'), {
        preparingMessageHtml: " preparing for download, please wait...",
        failMessageHtml: "There was a problem generating your report, please try again."
    });
    return false; //this is critical
});
  </script>

<script>
  
  $("#upload").on("click",function(){

   
     $("#myfile").upload("upload.php",

      function(success){
         console.log("done",success);
     },

     function(prog,value){

        $("#prog").val(value);

     });

  });

</script>



</body>
</html>