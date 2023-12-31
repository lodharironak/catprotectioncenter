<?php

class WCML_Editor_Save_Filters {

	private $trid;
	private $language;

	public function __construct( $trid, $language ) {
		$this->trid     = $trid;
		$this->language = $language;

		add_filter( 'wpml_tm_save_post_trid_value', [ $this, 'wpml_tm_save_post_trid_value' ], 10, 2 );
		add_filter( 'wpml_tm_save_post_lang_value', [ $this, 'wpml_tm_save_post_lang_value' ], 10, 2 );
		add_filter( 'wpml_save_post_trid_value', [ $this, 'wpml_save_post_trid_value' ], 10, 2 );
		add_filter( 'wpml_save_post_lang', [ $this, 'wpml_save_post_lang_value' ], 10 );
	}

	public function __destruct() {
		remove_filter( 'wpml_tm_save_post_trid_value', [ $this, 'wpml_tm_save_post_trid_value' ], 10 );
		remove_filter( 'wpml_tm_save_post_lang_value', [ $this, 'wpml_tm_save_post_lang_value' ], 10 );
		remove_filter( 'wpml_save_post_trid_value', [ $this, 'wpml_save_post_trid_value' ], 10 );
		remove_filter( 'wpml_save_post_lang', [ $this, 'wpml_save_post_lang_value' ], 10 );
	}

	// translation-management $trid filter
	public function wpml_tm_save_post_trid_value( $trid, $post_id ) {
		$trid = $this->trid ? $this->trid : $trid;
		return $trid;
	}

	// translation-management $lang filter
	public function wpml_tm_save_post_lang_value( $lang, $post_id ) {
		if ( isset( $_POST['action'] ) && $_POST['action'] === 'wpml_translation_dialog_save_job' ) {
			$lang = $this->language ? $this->language : $lang;
		}
		return $lang;
	}

	// sitepress $trid filter
	public function wpml_save_post_trid_value( $trid, $post_status ) {
		if ( $post_status !== 'auto-draft' ) {
			$trid = $this->trid ? $this->trid : $trid;
		}
		return $trid;
	}

	// sitepress $lang filter
	public function wpml_save_post_lang_value( $lang ) {
		$lang = $this->language ? $this->language : $lang;
		return $lang;
	}

}
