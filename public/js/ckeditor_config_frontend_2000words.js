CKEDITOR.editorConfig = function( config ) {
	// display characters (rawurldecode)
	config.htmlEncodeOutput = false;
	config.entities = false;
	// allow custom code (fontawesome, classes)
	config.protectedSource.push( /<i class[\s\S]*?\>/g );
	config.protectedSource.push( /<\/i>/g );
	config.extraPlugins = 'wordcount,notification'; 
	// config.allowedContent = true;
	config.allowedContent =
	    'p blockquote strong em b i ul li ol sub sup;' +
	    'a[!href];' +
	    'style[text-align];' +
	    'img[!src,alt,width,height];';
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Outdent,Indent,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,Font,FontSize,BGColor,ShowBlocks,About';
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
	    maxWordCount: 2000,

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