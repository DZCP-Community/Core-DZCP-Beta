/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.plugins.add( 'smiley', {
    requires: 'dialog,bbcode', //DZCP 1.7
    lang: 'de,uk', // %REMOVE_LINE_CORE%
    icons: 'smiley', // %REMOVE_LINE_CORE%

    init: function( editor ) {
        editor.addCommand( 'smiley', new CKEDITOR.dialogCommand( 'smiley', {
            allowedContent: 'img[alt,height,!src,title,width]',
            requiredContent: 'img'
        } ) );

        editor.ui.addButton && editor.ui.addButton( 'Smiley', {
            label: editor.lang.smiley.toolbar,
            command: 'smiley',
            toolbar: 'insert,50'
        } );

        //Add Dialog
        CKEDITOR.dialog.add( 'smiley', this.path + 'dialogs/smiley.js' );
    }
} );

/*
Export to bbcode plugin:
CKEDITOR.config.smiley_images
CKEDITOR.config.smiley_descriptions
CKEDITOR.config.smiley_columns
CKEDITOR.config.smiley_path
 */