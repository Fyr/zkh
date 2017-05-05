<div style="height: 200px; overflow-y: auto;">
<?
    foreach($aOptions as $id => $title) {
        $_checked = (in_array($id, $checked)) ? 'checked="checked"' : '';
?>
    <input type="checkbox" name="data[<?=$type?>][]" value="<?=$id?>" <?=$_checked?> autocomplete="off"/> <?=$title?> <br />
<?
    }
?>
</div>
