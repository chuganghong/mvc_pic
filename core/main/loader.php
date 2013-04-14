<?php
class loader
{
    private static $loaded = array();
	static function load($object)
	{
	    $valid = array("library","view","model","helper","router","config","hook","cache","db","admin");
		if( !in_array($object,$valid) )
		{
		    throw new Exception("Not a valid object '{$object}' to load");
		}
		
		if( empty(self::$loaded[$object]) )
		{
		    self::$loaded[$object] = new $object();
		}
		return self::$loaded[$object];
	}
}