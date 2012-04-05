<h1>Gov.UK Publishing Updates</h1>

<h2>Fact Check Responses</h2>
<?php foreach($fact_checks as $msg) :?>
<div class="fcitem">
  <div class="alert-message <?php echo time_based_class(mysql_to_unix($msg->action_date));?>">
    <img src="http://www.gravatar.com/avatar/<?php if(gravatar_hash($msg->user)) : echo gravatar_hash($msg->user); else : echo "null"; endif; ?>?s=64" width="64" height="64" alt="#" />
    <strong><?php echo convert_to_human_date(mysql_to_unix($msg->action_date),2 ,'d-M-Y'); ?>: <em><?php echo $msg->user; ?></em></strong>
    <br/><?php echo $msg->title; ?> (<?php echo strtolower($msg->format); ?>)
    <br/>
  </div>
</div>
<?php endforeach; ?>