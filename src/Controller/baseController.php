<?php
namespace VirtualRoom\Controller;

/**
 * Base class for all controllers in the app.
 * it provide a repository and error variables.
 */
class baseController
{
    /**
     * @var $repo The repository of the controller
     */
    protected  $repo;
    /**
     * @var $error Contains the error data
     */
    protected $error;
   
    /**
     * Verify if all the given keys exist in the given array
     * @param array $keys An array containing all the keys to verify
     * @param array $arr The array to compare against
     * @return bool True if all the keys exist in the array
     */
    protected function arrayKeysExists(array $keys, array $arr) {
        return !array_diff_key(array_flip($keys), $arr);
     }
}