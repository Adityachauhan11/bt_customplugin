<div class="container">
  <form action="" method="post" enctype='multipart/form-data'>
    <div class="row">
      <div class="col-25">
        <label for="title" class="title_form">Title</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="title" placeholder="Title">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject" class="title_form">Description</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="description" placeholder="Write something.." style="height:200px"></textarea>
      </div>
    </div>
	<div class="row">
      <div class="col-25">
        <label for="date" class="title_form">Schedule Date</label>
      </div>
      <div class="col-75">
       <input type="date" id="" name="date">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="image" class="title_form">Feature Image</label>
      </div>
      <div class="col-75">
       <input type="file" id="img" name="post_Fimage" accept="image/*">
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit" name='my_submit_btn' class="sum_bttn">
    </div>
	<?php wp_nonce_field( 'bt_custom_action', 'bt_custom_field' ); ?>
  </form>
</div>