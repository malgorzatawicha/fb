<?php namespace Fb\Models\Gallery;

use Baum\Node;

/**
* GalleryCategory
*/
class GalleryCategory extends Node {

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'gallery_categories';

  public static function tree()
  {
      return self::all()->toHierarchy();
  }
}
