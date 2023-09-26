<?php
  $sql = "SELECT real_filename FROM todos WHERE real_filename IS NOT NULL AND id IN (" . implode(",", array_keys($keys)) . ")";
  $sth = $dbh->prepare($sql);
  $sth->execute($keys);
  foreach ($sth as $row) {
    @unlink("attachment/${row['real_filename']}");
  }
  
  $sql = "DELETE FROM todos WHERE id IN (" . implode(",", array_keys($keys)) . ")";
  $sth = $dbh->prepare($sql);
  $sth->execute($keys);
  $result = $sth->rowCount() . '件削除';
