<?php
function generate_token() {
  return hash('sha256', session_id());
}
function validate_token($token) {
  return $token === generate_token();
}
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>