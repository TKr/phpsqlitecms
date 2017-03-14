<?php
if(!defined('IN_INDEX')) exit;

$_id = 0;

$_content = $content;
$from = 0;
$_id = 0;
$_aId = 0;

do {
    $start = strpos($_content, '[DOCUMENT LIST START]', $from);
    $end = strpos($_content, '[DOCUMENT LIST END]', $from);

    if ($start !== false && $end !== false) {
        $documents = substr($_content, ($start + 21) , ($end - $start));

        $_header = "<div class=\"panel-group\" id=\"accordion{$_aId}\" role=\"tablist\" aria-multiselectable=\"true\">";
        $_footer = '</div>';

        $documentRows = explode("\n", $documents);
        $panels = [];
        $panel = [];
        foreach($documentRows as $documentRow) {
            $aRow = array_map('trim', explode('|', $documentRow));
            if ($aRow[0] == 'title') {
                if (!empty($panel)) {
                    $panels[] = $panel;
                    $panel = [];
                }
                $panel['title'] = ['title' => $aRow[1], 'open' => false];
                if (isset($aRow[2]) && trim($aRow[2]) == 'open') {
                    $panel['title']['open'] = true;
                }
            }
            if ($aRow[0] == 'row') {
                $panel['rows'][] = ['title' => $aRow[2], 'url' => $aRow[1]];
            }
        }
        if (!empty($panel)) {
            $panels[] = $panel;
        }

        $documents_rows = [];

        foreach($panels as $panel) {
            $documents_rows[] = include(BASE_PATH . 'cms/templates/subtemplates/documents.inc.tpl');
            $_id++;
        }
        $_aId++;

        $row = implode("\n", $documents_rows);

        $newContent = substr($_content, 0, $start) . $_header . "\n" . $row . "\n" . $_footer. "\n" . substr($_content, ($end + 19));
        $from = strlen(substr($_content, 0, $start) . $_header . "\n" . $row . "\n" . $_footer. "\n");
        $_content = $newContent;
    }

} while ($start !== false);

$template->assign('content', $_content);


if(isset($cache) && empty($no_cache))
 {
  $cache->cacheId = PAGE;
 }
?>
