<?php

define("GEOIP_COUNTRY_BEGIN", 16776960);
define("GEOIP_STANDARD", 0);
define("GEOIP_MEMORY_CACHE", 1);
define("GEOIP_SHARED_MEMORY", 2);
define("STRUCTURE_INFO_MAX_SIZE", 20);
define("GEOIP_COUNTRY_EDITION", 106);
define("STANDARD_RECORD_LENGTH", 3);
define("GEOIP_SHM_KEY", 0x4f415401);

class GeoIP {
  var $flags;
  var $filehandle;
  var $memory_buffer;
  var $databaseType;
  var $databaseSegments;
  var $record_length;
  var $shmid;
}

function _setup_segments($gi) {
  $gi->databaseType = GEOIP_COUNTRY_EDITION;
  $gi->record_length = STANDARD_RECORD_LENGTH;
  if ($gi->flags & GEOIP_SHARED_MEMORY) {
    $offset = @shmop_size ($gi->shmid) - 3;
    for ($i = 0; $i < STRUCTURE_INFO_MAX_SIZE; $i++) {
      $delim = @shmop_read ($gi->shmid, $offset, 3);
      $offset += 3;
      if ($delim == (chr(255).chr(255).chr(255))) {
        $gi->databaseType = ord(@shmop_read ($gi->shmid, $offset, 1));
        $offset++;
        break;
      }
      else $offset -= 4;
    }
    $gi->databaseSegments = GEOIP_COUNTRY_BEGIN;
  }
  else {
    $filepos = ftell($gi->filehandle);
    fseek($gi->filehandle, -3, SEEK_END);
    for ($i = 0; $i < STRUCTURE_INFO_MAX_SIZE; $i++) {
      $delim = fread($gi->filehandle,3);
      if ($delim == (chr(255).chr(255).chr(255))) {
        $gi->databaseType = ord(fread($gi->filehandle,1));
        break;
      }
      else fseek($gi->filehandle, -4, SEEK_CUR);
    }
    $gi->databaseSegments = GEOIP_COUNTRY_BEGIN;
    fseek($gi->filehandle,$filepos,SEEK_SET);
  }
  return $gi;
}

function geoip_open($filename, $flags) {
  $gi = new GeoIP;
  $gi->flags = $flags;
  if ($gi->flags & GEOIP_SHARED_MEMORY) $gi->shmid = @shmop_open (GEOIP_SHM_KEY, "a", 0, 0);
  else {
    $gi->filehandle = fopen($filename,"rb");
    if ($gi->flags & GEOIP_MEMORY_CACHE) {
      $s_array = fstat($gi->filehandle);
      $gi->memory_buffer = fread($gi->filehandle, $s_array['size']);
    }
  }
  $gi = _setup_segments($gi);
  return $gi;
}

function geoip_close($gi) {
  if ($gi->flags & GEOIP_SHARED_MEMORY) { return true; }
  return fclose($gi->filehandle);
}

function geoip_country_id_by_addr($gi, $addr) {
  $ipnum = ip2long($addr);
  return _geoip_seek_country($gi, $ipnum) - GEOIP_COUNTRY_BEGIN;
}

function _geoip_seek_country($gi, $ipnum) {
  $offset = 0;
  for ($depth = 31; $depth >= 0; --$depth) {
    if ($gi->flags & GEOIP_MEMORY_CACHE) $buf = substr($gi->memory_buffer, 2 * $gi->record_length * $offset, 2 * $gi->record_length);
    elseif ($gi->flags & GEOIP_SHARED_MEMORY) $buf = @shmop_read ($gi->shmid, 2 * $gi->record_length * $offset, 2 * $gi->record_length );
    else {
      fseek($gi->filehandle, 2 * $gi->record_length * $offset, SEEK_SET) == 0 or die("fseek failed");
      $buf = fread($gi->filehandle, 2 * $gi->record_length);
    }
    $x = array(0,0);
    for ($i = 0; $i < 2; ++$i) for ($j = 0; $j < $gi->record_length; ++$j) $x[$i] += ord($buf[$gi->record_length * $i + $j]) << ($j * 8);
    if ($ipnum & (1 << $depth)) {
      if ($x[1] >= $gi->databaseSegments) return $x[1];
      $offset = $x[1];
    }
    else {
      if ($x[0] >= $gi->databaseSegments) return $x[0];
      $offset = $x[0];
    }
  }
  return false;
}

?>