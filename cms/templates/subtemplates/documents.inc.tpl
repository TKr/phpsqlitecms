<?php
ob_start();
?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading_<?php echo $_id; ?>">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion<?php echo $_aId; ?>" href="#collapse_<?php echo $_id; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $_id; ?>">
          <?php echo $panel['title']['title']; ?>
        </a>
      </h4>
    </div>
    <div id="collapse_<?php echo $_id; ?>" class="panel-collapse collapse<?php echo ($panel['title']['open'] ? ' in' : ''); ?>" role="tabpanel" aria-labelledby="heading_<?php echo $_id; ?>">
      <div class="panel-body">
         <?php foreach($panel['rows'] as $_row): ?>
<p><a class="btn btn-primary" href="<?php echo $_row['url']; ?>"><span class="glyphicon glyphicon-cloud-download"></span> <?php echo $_row['title']; ?></a></p>
         <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php
$_generated_content = ob_get_clean();

return $_generated_content;
