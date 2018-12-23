CKEDITOR.editorConfig = function( config ) {
	// display characters (rawurldecode)
	config.extraPlugins = 'wordcount,notification'; 
	config.htmlEncodeOutput = false;
	config.entities = false;
	// allow custom code (fontawesome, classes)
	config.protectedSource.push( /<i class[\s\S]*?\>/g );
	config.protectedSource.push( /<\/i>/g );
	config.allowedContent = true;
	config.wordcount = {

	    // Whether or not you want to show the Paragraphs Count
	    showParagraphs: false,

	    // Whether or not you want to show the Word Count
	    showWordCount: true,

	    // Whether or not you want to show the Char Count
	    showCharCount: false,

	    // Whether or not you want to count Spaces as Chars
	    countSpacesAsChars: false,

	    // Whether or not to include Html chars in the Char Count
	    countHTML: false,
	    
	    // Maximum allowed Word Count, -1 is default for unlimited
	    maxWordCount: -1,

	    // Maximum allowed Char Count, -1 is default for unlimited
	    maxCharCount: -1,

	    // Add filter to add or remove element before counting (see CKEDITOR.htmlParser.filter), Default value : null (no filter)
	    filter: new CKEDITOR.htmlParser.filter({
	        elements: {
	            div: function( element ) {
	                if(element.attributes.class == 'mediaembed') {
	                    return false;
	                }
	            }
	        }
	    })
	};	
};
