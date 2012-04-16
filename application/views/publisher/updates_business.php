<h2>Latest Business Publisher Updates</h2>

<div class="row">
  <div class="span5 updates-other">
    <h3>Recently Created/Assigned</h3>
    <?php foreach($other_messages as $msg) : ?>
      <div class="alert-message success">
        <?php if($msg->gravatar_hash) :?><img src="http://www.gravatar.com/avatar/<?php echo $msg->gravatar_hash; ?>?s=64" width="64" height="64" alt="#" /><?php endif; ?>
        <strong><?php echo $msg->user; ?></strong> <?php echo $msg->action_name; ?> the <?php echo strtolower($msg->format); ?> <strong>"<?php echo $msg->title; ?>"</strong>
        <span><?php echo convert_to_human_date(mysql_to_unix($msg->action_date),2 ,'d-M-Y h:i:s'); ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="span6 updates-publish">
    <h3>Action Updates</h3>
    <?php foreach($action_messages as $msg) : ?>
      <div class="alert-message <?php echo $msg->action_format; ?>">
        <?php if($msg->gravatar_hash) :?><img src="http://www.gravatar.com/avatar/<?php echo $msg->gravatar_hash; ?>?s=32" width="32" height="32" alt="#" /><?php endif; ?>
        <?php echo $msg->action_name; ?>: <strong>"<?php echo $msg->title; ?>"</strong> (<?php echo strtolower($msg->format); ?>) by <strong><?php echo $msg->user; ?></strong>
        <span><?php echo convert_to_human_date(mysql_to_unix($msg->action_date),2 ,'d-M-Y h:i:s'); ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="span5 updates-other">
    <h3>Fact Check Updates</h3>
    <?php foreach($automatic_messages as $msg) : ?>
      <?php if($msg->action_name == 'fact check response') : ?>
        <div class="alert-message <?php echo $msg->action_format; ?>">
          <?php echo $msg->action_name; ?>: <strong>"<?php echo $msg->title; ?>"</strong> (<?php echo strtolower($msg->format); ?>)
          <span><?php echo convert_to_human_date(mysql_to_unix($msg->action_date),2 ,'d-M-Y h:i:s'); ?></span>
        </div>
      <?php else : ?>
        <div class="alert-message <?php echo $msg->action_format; ?>">
          <?php echo $msg->action_name; ?>: <strong>"<?php echo $msg->title; ?>"</strong> (<?php echo strtolower($msg->format); ?>) by <strong><?php echo $msg->user; ?></strong>
          <span><?php echo convert_to_human_date(mysql_to_unix($msg->action_date),2 ,'d-M-Y h:i:s'); ?></span>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>

</div>