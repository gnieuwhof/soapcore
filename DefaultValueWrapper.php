<?php

/**
 * @file
 * @brief This file contains the class DefaultValueWrapper.
 */

/**
 * @brief Wrapper class to handle default values in objects.
 * 
 * NOTE:
 * If a property in the target does not exist, null is returned by default.
 * Otherwise the value in the defaults array is used.
 * 
 * Usage:
 * $o = new DefaultValueWrapper( new stdClass, array( 'foo' => 42 ) );
 * echo $o->foo; // 42
 */
class DefaultValueWrapper
{
    
    private $targetObject;

    private $defaults;
    
    
    /**
     * @brief Constructs the wrapper.
     * 
     * @param object $targetObject
     * @param array $defaults Assosiative array key = property, value is the default value.
     */
    public function __construct( $targetObject, array $defaults = array() )
    {
        if(!is_object($targetObject))
            throw new ArgumentException('Argument must be of type object.', 'targetObject');
        
        $this->targetObject = $targetObject;
        
        $this->defaults = $defaults;
    }
    
    /**
     * @brief All property access goes through this function.
     * 
     * This function is automagically called whenever an inaccessible property
     * is accessed. As there are no public properties, accessing a property
     * will always call this function (except for isset).
     * @param string $property Name of the property.
     * @return mixed Reference to the object member or the default value.
     */
    public function &__get( $property )
    {
        if( property_exists( $this->targetObject, $property ) )
        {
            return $this->targetObject->$property;
        }
        
        if( array_key_exists( $property, $this->defaults ) )
        {
            return $this->defaults[ $property ];
        }
        
        $null = null;
        return $null;
    }
    
    /**
     * @brief Returns whether the property exists in the target object and is not null.

     * Note: It is probably faster to call isset on the target itself.
     * @param string $property Name of the property.
     * @return bool
     */
    public function __isset( $property )
    {
        return isset( $this->targetObject->$property );
    }
    
}
