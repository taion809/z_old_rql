<?php
namespace Rql\Generated;

// @@protoc_insertion_point(namespace:Rql.Generated.Term)

/**
 * Generated by the protocol buffer compiler.  DO NOT EDIT!
 * source: q2.proto
 *
 * A [Term] is either a piece of data (see **Datum** above), or an operator and
 * its operands.  If you have a [Datum], it's stored in the member [datum].  If
 * you have an operator, its positional arguments are stored in [args] and its
 * optional arguments are stored in [optargs].
 * 
 * A note about type signatures:
 * We use the following notation to denote types:
 *   arg1_type, arg2_type, argrest_type... -> result_type
 * So, for example, if we have a function `avg` that takes any number of
 * arguments and averages them, we might write:
 *   NUMBER... -> NUMBER
 * Or if we had a function that took one number modulo another:
 *   NUMBER, NUMBER -> NUMBER
 * Or a function that takes a table and a primary key of any Datum type, then
 * retrieves the entry with that primary key:
 *   Table, DATUM -> OBJECT
 * Some arguments must be provided as literal values (and not the results of sub
 * terms).  These are marked with a `!`.
 * Optional arguments are specified within curly braces as argname `:` value
 * type (e.x `{use_outdated:BOOL}`)
 * Many RQL operations are polymorphic. For these, alterantive type signatures
 * are separated by `|`.
 * 
 * The RQL type hierarchy is as follows:
 *   Top
 *     DATUM
 *       NULL
 *       BOOL
 *       NUMBER
 *       STRING
 *       OBJECT
 *         SingleSelection
 *       ARRAY
 *     Sequence
 *       ARRAY
 *       Stream
 *         StreamSelection
 *           Table
 *     Database
 *     Function
 *     Ordering - used only by ORDER_BY
 *     Pathspec -- an object, string, or array that specifies a path
 *   Error
 *
 * -*- magic methods -*-
 *
 * @method Rql\Generated\Term\TermType getType()
 * @method void setType(Rql\Generated\Term\TermType $value)
 * @method Rql\Generated\Datum getDatum()
 * @method void setDatum(Rql\Generated\Datum $value)
 * @method array getArgs()
 * @method void appendArgs(Rql\Generated\Term $value)
 * @method array getOptargs()
 * @method void appendOptargs(Rql\Generated\Term\AssocPair $value)
 */
class Term extends \ProtocolBuffers\Message
{
  // @@protoc_insertion_point(traits:Rql.Generated.Term)
  
  /**
   * @var Rql\Generated\Term\TermType $type
   * @tag 1
   * @label optional
   * @type \ProtocolBuffers::TYPE_ENUM
   * @see Rql\Generated\Term\TermType
   **/
  protected $type;
  
  /**
   * This is only used when type is DATUM.
   *
   * @var Rql\Generated\Datum $datum
   * @tag 2
   * @label optional
   * @type \ProtocolBuffers::TYPE_MESSAGE
   **/
  protected $datum;
  
  /**
   * @var array $args
   * @tag 3
   * @label optional
   * @type \ProtocolBuffers::TYPE_MESSAGE
   * @see Rql\Generated\Term
   *
   * Holds the positional arguments of the query.
   *
   **/
  protected $args;
  
  /**
   * @var array $optargs
   * @tag 4
   * @label optional
   * @type \ProtocolBuffers::TYPE_MESSAGE
   * @see Rql\Generated\Term\AssocPair
   *
   * Holds the optional arguments of the query.
   *
   **/
  protected $optargs;
  
  
  // @@protoc_insertion_point(properties_scope:Rql.Generated.Term)

  // @@protoc_insertion_point(class_scope:Rql.Generated.Term)

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
        "type"     => \ProtocolBuffers::TYPE_ENUM,
        "name"     => "type",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(2, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "datum",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
        "message" => '\Rql\Generated\Datum',
      )));
      $desc->addField(3, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "args",
        "required" => false,
        "optional" => false,
        "repeated" => true,
        "packable" => false,
        "default"  => null,
        "message" => '\Rql\Generated\Term',
      )));
      $desc->addField(4, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "optargs",
        "required" => false,
        "optional" => false,
        "repeated" => true,
        "packable" => false,
        "default"  => null,
        "message" => '\Rql\Generated\Term\AssocPair',
      )));
      // @@protoc_insertion_point(builder_scope:Rql.Generated.Term)

      $descriptor = $desc->build();
    }
    return $descriptor;
  }

}
