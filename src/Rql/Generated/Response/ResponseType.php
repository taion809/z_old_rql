<?php
namespace Rql\Generated\Response;

// @@protoc_insertion_point(namespace:Rql.Generated.Response.ResponseType)

/**
 * Generated by the protocol buffer compiler.  DO NOT EDIT!
 * source: q2.proto
 *
 */
class ResponseType extends \ProtocolBuffers\Enum
{
  // @@protoc_insertion_point(traits:Rql.Generated.Response.ResponseType)
  
  /**
   * These response types indicate success.
   */
  const SUCCESS_ATOM = 1;
  const SUCCESS_SEQUENCE = 2;
  const SUCCESS_PARTIAL = 3;
  /**
   * datatypes.  If you send a [CONTINUE] query with
   * the same token as this response, you will get
   * more of the sequence.  Keep sending [CONTINUE]
   * queries until you get back [SUCCESS_SEQUENCE].
   */
  const SUCCESS_FEED = 5;
  const WAIT_COMPLETE = 4;
  /**
   * These response types indicate failure.
   */
  const CLIENT_ERROR = 16;
  /**
   * client sends a malformed protobuf, or tries to
   * send [CONTINUE] for an unknown token.
   */
  const COMPILE_ERROR = 17;
  /**
   * checking.  For example, if you pass too many
   * arguments to a function.
   */
  const RUNTIME_ERROR = 18;
  
  // @@protoc_insertion_point(const_scope:Rql.Generated.Response.ResponseType)
  
  // @@protoc_insertion_point(class_scope:Rql.Generated.Response.ResponseType)
  
  /**
   * @return \ProtocolBuffers\EnumDescriptor
   */
  public static function getEnumDescriptor()
  {
    static $descriptor;
    if (!$descriptor) {
      $builder = new \ProtocolBuffers\EnumDescriptorBuilder();
      $builder->addValue(new \ProtocolBuffers\EnumValueDescriptor(array(
        "value" => self::SUCCESS_ATOM,
        "name"  => 'SUCCESS_ATOM',
      )));
      $builder->addValue(new \ProtocolBuffers\EnumValueDescriptor(array(
        "value" => self::SUCCESS_SEQUENCE,
        "name"  => 'SUCCESS_SEQUENCE',
      )));
      $builder->addValue(new \ProtocolBuffers\EnumValueDescriptor(array(
        "value" => self::SUCCESS_PARTIAL,
        "name"  => 'SUCCESS_PARTIAL',
      )));
      $builder->addValue(new \ProtocolBuffers\EnumValueDescriptor(array(
        "value" => self::SUCCESS_FEED,
        "name"  => 'SUCCESS_FEED',
      )));
      $builder->addValue(new \ProtocolBuffers\EnumValueDescriptor(array(
        "value" => self::WAIT_COMPLETE,
        "name"  => 'WAIT_COMPLETE',
      )));
      $builder->addValue(new \ProtocolBuffers\EnumValueDescriptor(array(
        "value" => self::CLIENT_ERROR,
        "name"  => 'CLIENT_ERROR',
      )));
      $builder->addValue(new \ProtocolBuffers\EnumValueDescriptor(array(
        "value" => self::COMPILE_ERROR,
        "name"  => 'COMPILE_ERROR',
      )));
      $builder->addValue(new \ProtocolBuffers\EnumValueDescriptor(array(
        "value" => self::RUNTIME_ERROR,
        "name"  => 'RUNTIME_ERROR',
      )));
      // @@protoc_insertion_point(builder_scope:Rql.Generated.Response.ResponseType)
      $descriptor = $builder->build();
    }
    return $descriptor;
  }
}
