<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 11:34 AM
 */

namespace Diress\PostType;

use Diress\Metabox\SimpleMetabox;
use Diress\PostType\Base;
use Diress\Util;

class Feature extends Base{

	public function __construct(){

		$this->postType = 'feature';
		$this->singularName ='Feature';
		$this->pluralName = 'Features';
		$this->menuName = 'Feature';
		$this->slug = 'feature';
		$this->args = array(
			'supports'=>array( 'title', 'editor', 'thumbnail')
		);

		$this->meta_fields = array(
				'feature_icon'=>array(
						'type' => 'select',
						'name' => 'feature_icon',
						'title'=>'Feature\'s icon',
						'value' => 'icon-book-open',
						'choices' => Util::getElegantIconList()
				),
				'number'=>array(
						'type' => 'range',
						'name' => 'feature_icon',
						'title'=>'Feature\'s icon',
						'value' => '5',
						'max'=>10,
						'min'=>0,
						'step'=>5

				)
		);

	}

	public function init() {
		add_action( 'init', array( $this, 'registerPostType' ));
		if(is_admin()){
			$this->initMetabox();
		}
	}
	public function initMetabox(){
		$id='feature_metabox';
		$title="Meta";
		$args = array(
			'post_type'=>'feature'
		);
		$metabox = new SimpleMetabox($id, $title, $args, $this->meta_fields);
		$metabox->init();
	}
	/**
	 * Render the icon
	 * @param $postId
	 */
	public function renderIcon($postId){
		if(has_post_thumbnail($postId)){
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$args = array('thumbnail_id'=>$post_thumbnail_id, 'size'=>array(50,60));
			$imageSrc = $this->getThumbnailSrc($args);
			echo "<img height='60px' src='{$imageSrc}'>";
		}
		else {
			$iconField = get_post_meta( $postId, 'feature_icon', true );
			if ( ! $iconField ) {
				$iconField = 'icon-shield';
			}
			echo "<span class='icon {$iconField}'></span>";
		}
	}
}