<?php 
$form_attributes = array('class' => 'm-3 animated ', 'id' => 'form-post');
?>
<div class="container-fluid mt-5">
    <div class="row h-100 justify-content-center align-items-center">  
        <div class="col-12">
            <?php echo form_open('/account/post', $form_attributes); ?>
                <div class="card card-post mx-auto" style="max-width:600px; width:auto;">
                <div class="card-body">
                    <div class="form-group">
                        <textarea class="form-control" id="caption" name="caption" placeholder="What's on your mind?" maxlength="255" rows="3"></textarea>
                    </div>
                </div>
                    <div class="card-footer">
                        <button class="btn btn-post float-right" type="submit"><span>Post <img src="https://png.icons8.com/android/14/ffffff/forward.png"></span></button>
                    </div>
                </div>
            </form>
        </div>  
    </div>
</div>
