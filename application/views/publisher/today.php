<h1>GOV.UK Publishing Updates</h1>
<table width="100%" cellspacing="0" cellpadding="5" border="0">
<thead>
  <tr>
    <th>&nbsp;</th>
    <th>Today <span>(<?php echo date('D d, M',$thisdate); ?>)</span></th>
    <th>This Week</th>
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
      <?php if(array_key_exists('published',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['published']; $i++) : ?>
          <span class="label success">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['published']; ?></span>
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
      <?php if(array_key_exists('review requested',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['review requested']; $i++) : ?>
          <span class="label warning">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['review requested']; ?></span>
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
      <?php if(array_key_exists('work started',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['work started']; $i++) : ?>
          <span class="label notice">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['work started']; ?></span>
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
      <?php if(array_key_exists('fact check requested',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['fact check requested']; $i++) : ?>
          <span class="label outbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['fact check requested']; ?></span>
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
      <?php if(array_key_exists('fact check response',$thisweek)) : ?>
        <?php for($i = 0; $i < $thisweek['fact check response']; $i++) : ?>
          <span class="label inbound">&nbsp;</span>
        <?php endfor; ?>
        <span class="result"><?php echo $thisweek['fact check response']; ?></span>
      <?php endif; ?>
    </td>
  </tr>
</tbody>
</table>

<style>
table th { font-size: 2em; color: #fff;  }
table th span { color: #666; font-weight: normal; }
table td { color: #fff; font-size: 1.6em; border-top: 0; padding: 5px 15px 0 15px; line-height: 1.5em; }
table td.today { background: #1a1a1a; width: 390px; }
table td.format { padding-left: 0; }
table td.thisweek { padding-right: 0; width: 390px; }
table td .label { font-size: 1em; padding: 0 7px; }
</style>