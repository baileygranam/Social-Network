<?php
if(!empty($posts))
{
    foreach ($posts->result() as $row)
    {
?>
<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center">  
        <div class="col-12">
            <div class="m-4">
                <div class="card card-post mx-auto" id="card-post" style="max-width:600px; width:auto;">
                    <div class="card-header">
                        <a href="/profile/<?php echo $row->username; ?>" target="_blank">
                            <span id="profile-image">
                                <img src="https://media.licdn.com/dms/image/C5103AQE6vXK_Uptc9A/profile-displayphoto-shrink_200_200/0?e=1530111600&v=beta&t=jAQ-47DgFBCPdl2aaGVsB5ABcjwknMuhEJ9IGnPL-uA" width="60">
                            </span>
                            <span id="name">
                                <?php echo ucfirst($row->first_name) . ' ' .  ucfirst($row->last_name); ?>
                            </span>
                            <span id="screen-name"> 
                                &#8211; @<?php echo $row->username; ?> 
                            </span>
                        </a>
                        <span id="date">
                            <?php echo (new \DateTime(($row->created_at)))->format('M j'); ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <?php echo $row->caption; ?>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<?php }
}  ?>
