<?php if($format==='business') : ?>
  <h2>Business Publishing Updates</h2>
<?php else : ?>
  <h2>Citizen Publishing Updates</h2>
<?php endif; ?>

<table class="blocks" width="100%" cellspacing="0" cellpadding="5" border="0">
<thead>
  <tr>
    <th>&nbsp;</th>
    <th>Today <span>(<?php echo date('D d, M',$thisdate); ?>)</span></th>
    <th>Yesterday <span>(<?php echo date('D d, M',$yesterdaydate); ?>)</span></th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="format">Published</td>
    <td class="today">
      <?php if(array_key_exists('published',$today)) : ?>
        <?php for($i = 0; $i < $today['published']; $i++) : ?>
          <span class="label success">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $today['published']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('published',$yesterday)) : ?>
        <?php for($i = 0; $i < $yesterday['published']; $i++) : ?>
          <span class="label success">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $yesterday['published']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="format">2nd Eyes</td>
    <td class="today">
      <?php if(array_key_exists('review requested',$today)) : ?>
        <?php for($i = 0; $i < $today['review requested']; $i++) : ?>
          <span class="label warning">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $today['review requested']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('review requested',$yesterday)) : ?>
        <?php for($i = 0; $i < $yesterday['review requested']; $i++) : ?>
          <span class="label warning">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $yesterday['review requested']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="format">Started</td>
    <td class="today">
      <?php if(array_key_exists('work started',$today)) : ?>
        <?php for($i = 0; $i < $today['work started']; $i++) : ?>
          <span class="label notice">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $today['work started']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('work started',$yesterday)) : ?>
        <?php for($i = 0; $i < $yesterday['work started']; $i++) : ?>
          <span class="label notice">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $yesterday['work started']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="format">FC Out</td>
    <td class="today">
      <?php if(array_key_exists('fact check requested',$today)) : ?>
        <?php for($i = 0; $i < $today['fact check requested']; $i++) : ?>
          <span class="label outbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $today['fact check requested']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('fact check requested',$yesterday)) : ?>
        <?php for($i = 0; $i < $yesterday['fact check requested']; $i++) : ?>
          <span class="label outbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $yesterday['fact check requested']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td class="format">FC In</td>
    <td class="today">
      <?php if(array_key_exists('fact check response',$today)) : ?>
        <?php for($i = 0; $i < $today['fact check response']; $i++) : ?>
          <span class="label inbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $today['fact check response']; ?></span>
      <?php endif; ?>
    </td>
    <td class="thisweek">
      <?php if(array_key_exists('fact check response',$yesterday)) : ?>
        <?php for($i = 0; $i < $yesterday['fact check response']; $i++) : ?>
          <span class="label inbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $yesterday['fact check response']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
</tbody>
</table>
