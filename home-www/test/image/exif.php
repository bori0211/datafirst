<?php
	// REQUIRE FILES (ÇÊ¼ö)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	
	// HEADER INCLUDE
	include "../header.inc.php";
	
	
	$work_img_url = "./exif_test_018.jpg";
	
	$exif_data = exif_read_data($work_img_url);
	
	if ($exif_data) {
		var_dump( json_encode($exif_data, JSON_INVALID_UTF8_IGNORE) );
		
switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }		
		
		//var_dump( addslashes(json_encode($exif_data)) );
	} else {
		echo "no";
	}
	
	exit();
	
	if (is_array($exif_data)) {
		if (isset($exif_data["FileName"])) {
			$exif_data["FileName"] = "123";
			//var_dump($exif_data["FileName"]);
		}
	}
	
	$exit_data_json = json_encode($exif_data);
?>



    <textarea id="json-input" autocomplete="off" style="width:800px;height:300px"><?= $exit_data_json ?></textarea>
    
    <p class="options">
      Options:
      <label title="Generate node as collapsed">
        <input type="checkbox" id="collapsed">Collapse nodes
      </label>
      <label title="Allow root element to be collasped">
        <input type="checkbox" id="root-collapsable" checked>Root collapsable
      </label>
      <label title="Surround keys with quotes">
        <input type="checkbox" id="with-quotes">Keys with quotes
      </label>
      <label title="Generate anchor tags for URL values">
        <input type="checkbox" id="with-links" checked>
        With Links
      </label>
    </p>
    
    <pre id="json-renderer">234</pre>


    <script>
$(function() {
  function renderJson() {
    try {
      var input = eval('(' + $('#json-input').val() + ')');
    }
    catch (error) {
      return alert("Cannot eval JSON: " + error);
    }
    var options = {
      collapsed: $('#collapsed').is(':checked'),
      rootCollapsable: $('#root-collapsable').is(':checked'),
      withQuotes: $('#with-quotes').is(':checked'),
      withLinks: $('#with-links').is(':checked')
    };
    $('#json-renderer').jsonViewer(input, options);
  }

  // Generate on click
  $('#btn-json-viewer').click(renderJson);

  // Generate on option change
  $('p.options input[type=checkbox]').click(renderJson);

  // Display JSON sample on page load
  renderJson();
});
    </script>


<?
	
	
	// FOOTER INCLUDE
	include "../footer.inc.php";
?>