<?php
/**
 * Grain
 *
 * Here is where you can specify all of the filters,
 * actions, shortcodes, helpers and any other methods
 * that the theme will need.
 *
 * Usage:
 * You can use this class throughout the theme in the
 * following ways.
 *
 * For static methods (good for helpers):
 * Grain::myStaticMethod();
 *
 * For instance methods (good for singleton needs):
 * Rye::$grain->myInstanceMethod();
 *
 * @packaged rye
 **/
class Grain
{
    /**
     * Constructor
     *
     * This is a good place to add hooks.
     *
     * @return void
     **/
    public function __construct()
    {
        add_action('init', array($this, '_init'));
    }

    /**
     * Called on WP's init.
     *
     * @reference http://codex.wordpress.org/Plugin_API/Action_Reference/init
     * @return void
     **/
    public function _init()
    {
        // Any init stuff here.
    }

    /**
     * Add more methods!
     *
     * @return void
     **/
    public function somethingElse()
    {
    }
} // END class Grain extends Rye
