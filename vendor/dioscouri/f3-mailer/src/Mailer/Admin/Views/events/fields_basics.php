<div class="row">
    <div class="col-md-2">
        
        <h3>Basics</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" placeholder="Title" value="<?php echo $flash->old('title'); ?>" class="form-control" />
        </div>
        <div class="form-group">
            <label>Event Name</label>
            <input type="text" name="event_name" placeholder="" value="<?php echo $flash->old('event_name'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
                 
        <div class="form-group">
            <label>Description - Information about when this email sends</label>
            <textarea name="copy" class="form-control wysiwyg"><?php echo $flash->old('copy'); ?></textarea>
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->

<hr />



