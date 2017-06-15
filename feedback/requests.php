
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-default" role="tablist" >
    <li id="new_btn" role="presentation" class="active btn-warning"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-bell"></span> Active Requsts</a></li>

    <li role="presentation" id="old_btn" class="btn-info"><a href="#past" aria-controls="past" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-bell"> Past Requests</a></li>
  </ul>



  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="new">
      <?php


      ?>
    </div>



    <div role="tabpanel" class="tab-pane" id="past">..4.</div>
  </div>

</div>

<script>
$("#new").load("feedback/req.php");


/* Past Request */
  $("#old_btn").click(function(){
      var status1 ="Completed";
      $.post("feedback/req.php", {status:status1}, function(data){
          $("#past").html(data);
      });
  })   

</script>