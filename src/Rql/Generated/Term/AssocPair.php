<?php
namespace Rql\Generated\Term;

// @@protoc_insertion_point(namespace:Rql.Generated.Term.AssocPair)

/**
 * Generated by the protocol buffer compiler.  DO NOT EDIT!
 * source: q2.proto
 *
 * -*- magic methods -*-
 *
 * @method string getKey()
 * @method void setKey(\string $value)
 * @method Rql\Generated\Term getVal()
 * @method void setVal(Rql\Generated\Term $value)
 */
class AssocPair extends \ProtocolBuffers\Message
{
  // @@protoc_insertion_point(traits:Rql.Generated.Term.AssocPair)
  
  /**
   * @var string $key
   * @tag 1
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $key;
  
  /**
   * @var Rql\Generated\Term $val
   * @tag 2
   * @label optional
   * @type \ProtocolBuffers::TYPE_MESSAGE
   **/
  protected $val;
  
  
  // @@protoc_insertion_point(properties_scope:Rql.Generated.Term.AssocPair)

  // @@protoc_insertion_point(class_scope:Rql.Generated.Term.AssocPair)

  /**
   * get descriptor for protocol buffers
   * 
   * @return \ProtocolBuffersDescriptor
   */
  public static function getDescriptor()
  {
    static $descriptor;
    
    if (!isset($descriptor)) {
      $desc = new \ProtocolBuffers\DescriptorBuilder();
      $desc->addField(1, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "key",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(2, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "val",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
        "message" => '\Rql\Generated\Term',
      )));
      // @@protoc_insertion_point(builder_scope:Rql.Generated.Term.AssocPair)

      $descriptor = $desc->build();
    }
    return $descriptor;
  }

}
