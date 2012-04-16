<?php if($format==='business') : ?>
  <h2>Latest Business Fact Check Responses</h2>
<?php else : ?>
  <h2>Latest Citizen Fact Check Responses</h2>
<?php endif; ?>

<?php foreach($fact_checks as $msg) :?>
<div class="fcitem">
  <div class="alert-message <?php echo time_based_class(mysql_to_unix($msg->action_date));?>">
    <?php if($msg->gravatar_hash) :?><img src="http://www.gravatar.com/avatar/<?php echo $msg->gravatar_hash; ?>?s=64" width="64" height="64" alt="#" /><?php endif; ?>
    <strong><?php echo convert_to_human_date(mysql_to_unix($msg->action_date),2 ,'d-M-Y'); ?>: <em><?php echo $msg->user; ?></em></strong>
    <br/><?php echo $msg->title; ?> (<?php echo strtolower($msg->format); ?>)
    <br/>
  </div>
</div>
<?php endforeach; ?>