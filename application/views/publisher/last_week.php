<?php if($format==='business') : ?>
  <h2>Latest Business Publisher Updates</h2>
<?php else : ?>
  <h2>Latest Citizen Publisher Updates</h2>
<?php endif; ?>

<table class="blocks" width="100%" cellspacing="0" cellpadding="5" border="0">
<thead>
  <tr>
    <th>&nbsp;</th>
    <th>This Week</th>
    <th>Last Week</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="format">Published</td>
    <td class="today">
      <?php if(array_key_exists('published',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['published']; $i++) : ?>
          <span class="label success">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['published']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('published',$lastweek)) : ?>
        <?php for($i = 0; $i < $lastweek['published']; $i++) : ?>
          <span class="label success">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $lastweek['published']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="format">2nd Eyes</td>
    <td class="today">
      <?php if(array_key_exists('review requested',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['review requested']; $i++) : ?>
          <span class="label warning">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['review requested']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('review requested',$lastweek)) : ?>
        <?php for($i = 0; $i < $lastweek['review requested']; $i++) : ?>
          <span class="label warning">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $lastweek['review requested']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="format">Started</td>
    <td class="today">
      <?php if(array_key_exists('work started',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['work started']; $i++) : ?>
          <span class="label notice">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['work started']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('work started',$lastweek)) : ?>
        <?php for($i = 0; $i < $lastweek['work started']; $i++) : ?>
          <span class="label notice">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $lastweek['work started']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="format">FC Out</td>
    <td class="today">
      <?php if(array_key_exists('fact check requested',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['fact check requested']; $i++) : ?>
          <span class="label outbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['fact check requested']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('fact check requested',$lastweek)) : ?>
        <?php for($i = 0; $i < $lastweek['fact check requested']; $i++) : ?>
          <span class="label outbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $lastweek['fact check requested']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="format">FC In</td>
    <td class="today">
      <?php if(array_key_exists('fact check response',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['fact check response']; $i++) : ?>
          <span class="label inbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['fact check response']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('fact check response',$lastweek)) : ?>
        <?php for($i = 0; $i < $lastweek['fact check response']; $i++) : ?>
          <span class="label inbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $lastweek['fact check response']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
</tbody>
</table>