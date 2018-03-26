/*
 Copyright (c) 2007-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://cksource.com/ckfinder/license
 */

var config = {};

// Set your configuration options below.

// Examples:
// config.language = 'pl';
// config.skin = 'jquery-mobile';

CKFinder.define( config );
config.toolbar = [
   ['Save','NewPage','Preview','-','Templates'],
   ['Source','Preview','Templates'],
   ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
   ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
   '/',
   ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
   ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
   ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
   ['BidiLtr', 'BidiRtl' ],
   ['Link','Unlink','Anchor'],
   ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
   '/',
   ['Styles','Format','Font','FontSize'],
   ['TextColor','BGColor'],
   ['Maximize','ShowBlocks','Syntaxhighlight']
 ];
