/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
   config.filebrowserBrowseUrl = sitename+'/admin/assets/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = sitename+'/admin/assets/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = sitename+'/admin/assets/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl =sitename+ '/admin/assets/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = sitename+'/admin/assets/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl =sitename+ '/admin/assets/kcfinder/upload.php?type=flash';
};
