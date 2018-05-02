<?php 

if(!empty($posts)) { foreach ($posts as $row) { ?>
<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center">  
        <div class="col-12">
            <div class="m-4">
                <div class="card card-post mx-auto" id="card-post" style="max-width:600px; width:auto;">
                    <?php if(!empty($row->file_name) && $row->file_type_id == 1) { ?>
                    <img class="card-img-top" src="/uploads/<?php echo $row->file_name; ?>" alt="Card image cap">
                    <?php } if(!empty($row->file_name) && $row->file_type_id == 2) { ?>
                    <div align="center" class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item" onclick="this.paused ? this.play() : this.pause();">
                            <source src="/uploads/<?php echo $row->file_name; ?>" type="video/mp4">
                        </video>
                    </div>
                    <?php } if(!empty($row->file_name) && $row->file_type_id == 3) { ?>
                    <div id="wrapper">
                        <audio preload="auto" controls>
                            <source src="/uploads/<?php echo $row->file_name; ?>">
                        </audio>
                        <script src="/js/jquery.js"></script>
                        <script src="/js/audioplayer.js"></script>
                        <script>$( function() { $( 'audio' ).audioPlayer(); } );</script>

                        <div class="attribution">
                            <div xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/" about="http://freemusicarchive.org/music/Blue_Ducks/Six/">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="card-header">
                        <a href="/profile/<?php echo $row->username; ?>" target="_blank">
                            <span id="profile-image">
                                <img src="/uploads/<?php echo $row->avatar; ?>" width="60">
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
                    <div class="card-footer" style="padding:15px;">
                        <?php if($row->user_id == $this->session->user_id) { ?>
                        <a href="/posts/delete/<?php echo $row->post_id; ?>"><img src="https://png.icons8.com/material/24/8A8A8A/cancel.png"></a>
                        <?php } ?>
                        <a href="/posts/like/<?php echo $row->post_id; ?>"><img src="https://png.icons8.com/material/26/8A8A8A/hearts.png"> <?php echo $row->likes; ?></a>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<?php } } ?>
