/* tabs */
;(function(factory){if(typeof define==='function'&&define.amd){define(['jquery'],factory)}else{factory(jQuery)}}(function($,undefined){    
    var pluginName = 'tabs',
        defaults = {
			tabContentBox:	null,			//tab content 容器
			initState:		0,				//默认显示
			event:			'mouseenter',	//事件
			timer:			200				//hover切换的间隔时间
        };
    function Plugin (element,options) {
        this.element = element;
        this.options = $.extend( {}, defaults, options) ;
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }
    Plugin.prototype.init = function () {

		var $el = $(this.element);
		var tabContentBox = this.options.tabContentBox, initState = this.options.initState, event = this.options.event, timer = this.options.timer;
		var delay = 0;
		var tabTitle = $el.children(), tabContent = $(tabContentBox).children();
		
		tabTitle.eq(initState).addClass("selected");
		tabContent.hide().eq(initState).show();

		if (event == 'mouseenter') {
			tabTitle.mouseenter(function() {
				var obj = $(this);
				show(obj);
			}).click(function() {
				var obj = $(this);
				action(obj);
			});
		} else if (event == 'click') {
			tabTitle.click(function() {
				var obj = $(this);
				action(obj);
			});
		}

		function action(obj) {
			tabTitle.removeClass("selected");
			obj.addClass("selected");
			var i = obj.index();
			$(tabContent).eq(i).show();
			$(tabContent).eq(i).siblings().hide();
		}
		function show(obj) {
			clearTimeout(delay);
			delay = setTimeout(function() {
				action(obj);
				clearTimeout(delay);
			},timer)
		}

	};
	$.fn[pluginName]=function(options){return this.each(function(){if(!$.data(this,'plugin_'+pluginName)){$.data(this,'plugin_'+pluginName,new Plugin(this,options))}})}
}));