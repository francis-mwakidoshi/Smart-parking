<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-default" role="tablist" >
    <li id="new_btn" role="presentation" class="active btn-warning"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-bell"></span> New Requsts</a></li>
    <li role="presentation" id="accepted_btn" class="btn-success" ><a href="#accepted" aria-controls="accepted" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-bell"> Accepted Requests</a></li>
    <li role="presentation" id="declined_btn" class="btn-danger"><a href="#declined" aria-controls="declined" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-bell"> Declined Requests</a></li>
    <li role="presentation" id="old_btn" class="btn-info"><a href="#past" aria-controls="past" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-bell"> Past Requests</a></li>
  </ul>



  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="new">
      <?php


      ?>
    </div>




    <div role="tabpanel" class="tab-pane" id="accepted">.2..</div>
    <div role="tabpanel" class="tab-pane" id="declined">.3..</div>
    <div role="tabpanel" class="tab-pane" id="past">..4.</div>
  </div>

</div>

<script>
$("#new").load("feedback/req.php");

/*Accepted Requests*/
  $("#accepted_btn").click(function(){
      var status1 ="Accepted";
      $.post("feedback/req.php", {status:status1}, function(data){
          $("#accepted").html(data);
      });
  })

/* declined Request */
  $("#declined_btn").click(function(){
      var status1 ="Declined";
      $.post("feedback/req.php", {status:status1}, function(data){
          $("#declined").html(data);
      });
  }) 

/* declined Request */
  $("#old_btn").click(function(){
      var status1 ="Completed";
      $.post("feedback/req.php", {status:status1}, function(data){
          $("#past").html(data);
      });
  })   
</script>