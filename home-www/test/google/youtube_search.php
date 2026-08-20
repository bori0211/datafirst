<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if (isset($_GET['q']) && isset($_GET['maxResults'])) {
  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google API Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  echo $_GET['q'] . "<Br>";
  echo $_GET['maxResults'] . "<Br>";
  
  $client = new Google_Client();
  $client->setDeveloperKey(YOUTUBE_DEVELOPER_KEY_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);

  $htmlBody = '';
  try {

    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
    ));

    $videos = '';
    $channels = '';
    $playlists = '';

    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['videoId']);
          break;
        case 'youtube#channel':
          $channels .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['channelId']);
          break;
        case 'youtube#playlist':
          $playlists .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
          break;
      }
    }

    $htmlBody .= <<<END
    <h3>Videos</h3>
    <ul>$videos</ul>
    <h3>Channels</h3>
    <ul>$channels</ul>
    <h3>Playlists</h3>
    <ul>$playlists</ul>
END;
	
	echo $htmlBody;
	
  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}
	
	if ($maxResults == "") $maxResults = "10";
	
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
    
    <form class="form-inline" role="form" action="<?= $PHP_SELF ?>" method="get">
      <select class="form-control" name="search">
        <option value="">선택</option>
        <option value="search" <? if ($search == "search") echo "selected"; ?>>검색어</option>
      </select>
      <input class="form-control ms-1" type="text" name="q" value="<?= $q ?>" style="width:10em;">
      <input class="form-control ms-1" type="text" name="maxResults" value="<?= $maxResults ?>" style="width:10em;">
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
