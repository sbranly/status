<?php
function GetInfoLogData()
{
  $logfile = '/usr/opsscripts/' . 'info.log';
  $txt_file    = file_get_contents($logfile);
  $rows        = explode("\n", $txt_file);
  array_shift($rows);
  //$rows = array_slice($rows, -5);
  $infologrow = '';

  foreach($rows as $row => $data)
    {
          //get row data
          $row_data = explode(',', $data);

          $info[$row]['lastrun']              = trim($row_data[0]);
          $info[$row]['opsviewquery']         = trim($row_data[1]);
          $info[$row]['awsquery']             = trim($row_data[2]);
          $info[$row]['opsviewpurge']         = trim($row_data[3]);
          $info[$row]['opsviewadd']           = trim($row_data[4]);


          if ($info[$row]['opsviewquery'] == "FAILED" || $info[$row]['awsquery'] == "FAILED" || $info[$row]['opsviewpurge'] == "FAILED" || $info[$row]['opsviewadd'] == "FAILED")
          {
            $infologrow .= "\n\t\t\t<tr class=\"danger\" >";
          }
          else
          {
            $infologrow .= "\n\t\t\t<tr>"
          }
          $infologrow .= "
                <td>". $info[$row]['lastrun']. "</td>
                <td>". $info[$row]['opsviewquery']. "</td>
                <td>". $info[$row]['awsquery']. "</td>
                <td>". $info[$row]['opsviewpurge']. "</td>
                <td>". $info[$row]['opsviewadd']. "</td>
                </td>";
          $infologrow .= "\t\t\t</tr>";
    }
    return $infologrow;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Opsview Services</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.2.2/packaged/jquery.noty.packaged.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.2.2/layouts/inline.js"></script>
</head>
<body>
  <div class="container" id="update_config">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Opsview Services</h3>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Status</h3>
      </div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Last Run</th>
              <th>Opsview Query</th>
              <th>AWS Query</th>
              <th>Opsview Purge</th>
              <th>Opsview Add</th>
            </tr>
          </thead>
          <tbody>
            <?php echo GetInfoLogData(); ?>
          </tbody>
      </table>
    </div>
    </div>
  </div>
  <div class="container" id="config_options">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Configuration</h3>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="list-group">
        <a href="http://opsviewservices.jpg.com/update/" class="list-group-item">Configure ELBs and Hostgroups</a>
        <a href="http://opsviewservices.jpg.com/template/" class="list-group-item">Manage JSON Templates</a>
      </div>
    </div>
  </div>
</body>
</html>
