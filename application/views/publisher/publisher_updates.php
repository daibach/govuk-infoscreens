<?php if($format==='business') : ?>
  <h2>Latest Business Publisher Updates</h2>
<?php else : ?>
  <h2>Latest Citizen Publisher Updates</h2>
<?php endif; ?>

<div class="row">
  <div class="span6 updates-publish">
    <h3>Recently Published</h3>
    <?php foreach($published_messages as $msg) : ?>
      <div class="alert-message success">
        <img src="http://www.gravatar.com/avatar/<?php if(gravatar_hash($msg->user)) : echo gravatar_hash($msg->user); else : echo "null"; endif; ?>?s=64" width="64" height="64" alt="#" />
        <strong><?php echo $msg->user; ?></strong> <?php echo $msg->action_name; ?> the <?php echo strtolower($msg->format); ?> <strong>"<?php echo $msg->title; ?>"</strong>
        <span><?php echo convert_to_human_date(mysql_to_unix($msg->action_date),2 ,'d-M-Y h:i:s'); ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="span5 updates-other">
    <h3>Action Updates</h3>
    <?php foreach($action_messages as $msg) : ?>
      <div class="alert-message <?php echo $msg->action_format; ?>">
        <?php if(gravatar_hash($msg->user)) : ?><img src="http://www.gravatar.com/avatar/<?php echo gravatar_hash($msg->user); ?>?s=32" width="32" height="32" alt="#" /><?php endif; ?>
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