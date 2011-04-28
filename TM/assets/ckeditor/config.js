/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	    config.toolbar = 'MyToolbar';

    config.toolbar_MyToolbar =
    [
        ['Source','Preview'],['Cut','Copy','Paste','PasteText','PasteFromWord','-','Scayt'],['Undo','Redo'],
		['Find','Replace','-','SelectAll','RemoveFormat'],['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],['Link','Unlink','Anchor'],['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
        '/',
		['Styles','Format','Font','FontSize'],
		,'/',
    	['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'], ['TextColor','BGColor'],['Maximize', 'ShowBlocks'],['BidiLtr', 'BidiRtl']
 
    
    ];

};
