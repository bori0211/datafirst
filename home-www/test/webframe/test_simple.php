<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	echo "<!DOCTYPE html>\n";
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=no">
    <title>TEST</title>
    <link rel="shortcut icon" type="image/png" href="/assets/favicon-32x32.png">
    <style>
      table {
        width: 100%;
        border: 1px solid #444444;
        border-collapse: collapse;
      }
      th, td {
        border: 1px solid #444444;
        padding: 10px;
      }
    </style>
    <script src="/bower/jquery/dist/jquery.min.js"></script>
  </head>
  
  <body>
    <h2>YouTube 검색 TEST</h2>
    
    <form class="form-inline" role="form" id="content-search-form">
      <select class="form-control" name="search">
        <option value="">선택</option>
        <option value="search" <? if ($search == "search") echo "selected"; ?>>검색어</option>
      </select>
      <input class="form-control ms-1" type="text" name="find" value="<?= $find ?>" style="width:10em;">
      <input type="hidden" name="page" value="1">
      <button type="submit">검색</button>
    </form>
    
    <br>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>트윗</th>
          <th>Media</th>
        </tr>
      </thead>
      <tbody>
<?
	$id_str = "123";
	$text_display = "123";
	$medias = "123";
	
	{
?>
        <tr>
          <td class="text-center"><?= $id_str ?></td>
          <td class="text-start"><?= $text_display ?></td>
          <td class="text-start"><?= is_array($medias) ?></td>
        </tr>
<?
	}
?>
      </tbody>
    </table>
    
<script>
$(document).ready(function() {
});
</script>
    
  </body>
</html>

<?
	// MYSQLi CLOSE
	$mysqli->close();
?>
