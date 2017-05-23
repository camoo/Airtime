<?php
namespace CAMOO;
/**
 *
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/CAMOO/Base.php
 * updated: Mai 2017
 * Created by: Epiphane Tchabom (e.tchabom@camoo.cm)
 * Description: CAMOO API Base
 *
 * @link http://www.camoo.cm
*/

use CAMOO\Exceptions\CamooException;
class Base {

  const DS = '/';
    protected $sEndPoint = 'https://api.camoo.cm';
    
   protected static $_create = null;

   public static function create()
   {
       if ( is_null(static::$_create) )
       {
           static::$_create = new self;
       }
       return static::$_create;
   }

   protected $oModule = null;
   protected $ohCredentials = null;

   /**
     * @param $sApiKey
     * @param $sApiSecret
     */
    public function setCredentials($sApiKey, $sApiSecret)
    {
        $this->ohCredentials = new Authentifications\Credentials($sApiKey, $sApiSecret);
	return $this;
    }

    public function getCredentials() {
	    return $this->ohCredentials;
    }
   /**
     * @param $ohCalledClass
     */
    public function setModule(\CAMOO\Common\CalledClass $ohCalledClass)
    {
	return $this->oModule = $ohCalledClass;
    }


   protected function __clone() {}
 
   /**
    * constructor
    *
    */
   protected function __construct() {
   }

     /**
     * @var string The resource name as it is known at the server
     */
    protected $resourceName = NULL;
    /**
     * @param $resourceName
     */
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }
    /**
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }
        
      /**
      * Target version for "Classic" Camoo API
      */
     protected $camooClassicApiVersion = 'v2';
     /**
      * Returns the CAMOO API URL
      *-
      * @return string
      * @author Epiphane Tchabom 
      **/
     public function getEndPointUrl() {
         $sUrlTmp = $this->sEndPoint.static::DS.$this->camooClassicApiVersion.static::DS;
         $sResource = '';
         if ( $this->getResourceName() !== NULL) {
         	$sResource = static::DS.$this->getResourceName();
         }
         return sprintf($sUrlTmp.$this->oModule->name.$sResource.'%s','.json');
     }


     /**
      * decode json string
      * @throw CamooException
      * @author Epiphane Tchabom 
      */
     protected function decode($sJSON, $bAsHash=false) {
         try {
             if (   ($xData = json_decode($sJSON, $bAsHash)) === NULL
                 && (json_last_error() !== JSON_ERROR_NONE) ) {
                     throw new CamooException(json_last_error_msg());
                 }
         } catch ( \Exception $e ) {
             return $e->getMessage();
         }
         return $xData;
     }
}
