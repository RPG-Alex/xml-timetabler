<?php
class input_helper {
  public function cleanInputNoSpaceToLower($input){
    //This function will remove anything in a string that is not a-z 0-9 and make it lower case
    $trim = trim($input);
    $sanitized = preg_replace("/[^a-zA-Z0-9]+/", "", $trim);
    $toLower = strtolower($sanitized);
    return $toLower;
  }

  public function cleanInputToLower($input){
    //This will remove anything that isn't an a-z 0-9 or a space and make the string letters all lowercase
    $sanitized = preg_replace("/[^a-zA-Z0-9 ]+/", "", $input);
    $toLower = strtolower($sanitized);
    return $toLower;
  }
  public function cleanInputNoSpace($input){
    //This function will remove anything in a string that is not a-z 0-9
    $trim = trim($input);
    $sanitized = preg_replace("/[^a-zA-Z0-9]+/", "", $trim);
    return $sanitized;
}
public function cleanInputPeriodsNoSpaces($input){
  //Will remove anything not a-z, A-Z, 0-9, or . (period/full stop)
  $sanitized = preg_replace("/[^a-zA-Z0-9.]+/", "", $input);
  return $sanitized;
}
  //May neeed to extend this class for inputs for logging in etc.
}
