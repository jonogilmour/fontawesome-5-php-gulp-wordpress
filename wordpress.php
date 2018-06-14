<?php
if(!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Actions and filters for easily placing FA 5 SVG icon markup into your WordPress templates.
 */

if(!function_exists('printFaIcon')) {
  /**
   * Includes template for a given FontAwesome 5 SVG icon
   *
   * `do_action('fa-icon','fa-times-circle')`
   *
   * @param  string $name The class of your desired icon, eg fa-abc-xyz
   */
  function printFaIcon($name) {
    do_action('include-template', "fa/$name"); // EDIT: change 'fa/' to the folder your FA icon templates are kept
  }
  add_action('fa-icon', 'printFaIcon', 10, 1);
}

if(!function_exists('includeTemplate')) {
  /**
   * Includes a template file if it exists.
   *
   * `do_action('include-template','relative/path/to/template/file')`
   *
   * @param  string $path The path to the file to include
   */
  function includeTemplate($path) {
    if($fullPath = apply_filters('get-template', $path))
      include $fullPath;
  }
  add_action('include-template', 'includeTemplate', 10, 2);
}

if(!function_exists('getTemplate')) {
  /**
   * Returns the path to a given file in the templates directory.
   *
   * `do_action('get-template','relative/path/to/template/file')`
   *
   * @param  string $path Relative path to the template file
   * @return mixed        The full path to the file in your theme, or false if the file doesn't exist
   */
  function getTemplate($path) {
    $fullPathTheme = apply_filters('get-file-path', $path, 'templates'); // EDIT: change the last argument from 'templates' to the folder where all of your template files are kept.
    if(file_exists($fullPathTheme))
      return $fullPathTheme;
    return false;
  }
  add_filter('get-template', 'getTemplate');
}

if(!function_exists('getFileForPath')) {
  /**
   * Gets the full path to a PHP file in your theme, inside a given folder.
   *
   * `do_action('get-file-path','my-file')`
   *
   * @param  string $path   The relative path to the file, can just be the file name without .php
   * @param  string $folder (optional) The folder path to the file
   * @return string         Full path to the file within the active theme, with .php added to the filename.
   */
  function getFileForPath($path, $folder = '/') {
    $path = apply_filters('add-extension', $path, '.php'); // EDIT: if you're saving your icons to .txt files or any other file type, change the extension here (third argument)
    $path = apply_filters('clean-path',$path);
    $path = ltrim($path, '/');

    return get_theme_file_path("/$folder/$path");
  }
  add_filter('get-file-path', 'getFileForPath', 10, 2);
}

if(!function_exists('addExt')) {
  /**
   * Adds an extension to the end of a string.
   *
   * Checks if the string has the the given extension at the end; if so then it just returns the string unaltered, otherwise it adds the extension and returns it.
   *
   * `apply_filters('add-extension','aFile','anExtension')`
   *
   * @param  string $str The target string
   * @param  string $ext The extension to add
   * @return string      The string with the given extension
   */
  function addExt($str, $ext) {
    if(!preg_match('/'.$ext.'$/',$str)) {
      return $str . $ext;
    }
    return $str;
  }
  add_filter('add-extension', 'addExt', 10, 2);
}

if(!function_exists('cleanPath')) {
  /**
   * Cleans a file path to prevent hacks.
   *
   * Removes any case of './' and '../' from a file path
   *
   * `apply_filters('clean-path','path/to/clean')`
   *
   * @param  string $path The path to clean
   * @return string       The cleaned path
   */
  function cleanPath($path) {
    return preg_replace('/\.?\.\//', '', $path);
  }
  add_filter('clean-path', 'cleanPath');
}
