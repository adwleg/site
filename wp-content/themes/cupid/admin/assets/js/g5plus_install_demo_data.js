/**
 * Created by Administrator on 8/27/14.
 */
g5plus_install_demo_data = {
	htmlTag : {
		wrapper : '#install_demo_data',
		core : '#core',
		theme_options : '#theme_options',
		slider : '#slider'
	},
	vars : {
		is_disabled : false,
		width_process_bar : 345,
		animate_loading_timeout : ''
	},

	install : function(method){
		if (g5plus_install_demo_data.vars.is_disabled) return;
		g5plus_install_demo_data.vars.is_disabled = true;
		g5plus_install_demo_data.install_type('setting',method);
		jQuery(document).ready(function () {
			g5plus_install_demo_data.animate_loading(g5plus_install_demo_data.htmlTag.theme_options + ' [role="progressbar"]');
		});


	},
	install_type : function(type, method){
		jQuery(document).ready(function () {
			jQuery(g5plus_install_demo_data.htmlTag.wrapper).slideDown('fast');

			var data = {
				type: type,
				method : method,
				action: 'g5plus_make_site',
				security: true
			};

			jQuery.ajax({
				type   : 'POST',
				data   : data,
				url    : ajaxurl,
				success: function (html) {
					if (html == 'done'){
						g5plus_install_demo_data.vars.is_disabled = false;

						jQuery(g5plus_install_demo_data.htmlTag.slider + ' [role="progressbar"]',g5plus_install_demo_data.htmlTag.wrapper).css({width : '100%'});
						jQuery(g5plus_install_demo_data.htmlTag.slider + ' [role="progressbar"]',g5plus_install_demo_data.htmlTag.wrapper).parent().removeClass('active').removeClass('progress-striped');
						var success_popup = jQuery('#of-popup-install-data');
						success_popup.fadeIn();
						window.setTimeout(function(){
							location.reload();
							//success_popup.fadeOut();
						}, 1000);
					}
					else if ((html == 'setting') || (html == 'slider') || (html == 'core')) {
						switch (html) {
							case 'core':
								jQuery(g5plus_install_demo_data.htmlTag.theme_options + ' [role="progressbar"]',g5plus_install_demo_data.htmlTag.wrapper).css({width : '100%'});
								jQuery(g5plus_install_demo_data.htmlTag.theme_options + ' [role="progressbar"]',g5plus_install_demo_data.htmlTag.wrapper).parent().removeClass('active').removeClass('progress-striped');
								g5plus_install_demo_data.animate_loading(g5plus_install_demo_data.htmlTag.core + ' [role="progressbar"]', 1.5);

								break;

							case 'slider':
								jQuery(g5plus_install_demo_data.htmlTag.core + ' [role="progressbar"]',g5plus_install_demo_data.htmlTag.wrapper).css({width : '100%'});
								jQuery(g5plus_install_demo_data.htmlTag.core + ' [role="progressbar"]',g5plus_install_demo_data.htmlTag.wrapper).parent().removeClass('active').removeClass('progress-striped');
								g5plus_install_demo_data.animate_loading(g5plus_install_demo_data.htmlTag.slider + ' [role="progressbar"]');
								break;
						}
						g5plus_install_demo_data.install_type(html, method);
					}
					else {
						g5plus_install_demo_data.vars.is_disabled = false;
						clearTimeout(g5plus_install_demo_data.vars.animate_loading_timeout);
						var fail_popup = jQuery('#of-popup-fail');
						fail_popup.fadeIn();
						window.setTimeout(function(){
							fail_popup.fadeOut();
						}, 2000);
					}
				},
				error : function(html) {
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();
					}, 2000);
					g5plus_install_demo_data.vars.is_disabled = false;
				}
			});

		});
	},
	animate_loading : function(processbar, numberAdd) {
		if (numberAdd == undefined) numberAdd = 18;
		if (numberAdd <= 0) return;
		var currentPercent = jQuery(processbar).attr('style');
		if (currentPercent == 'width: 100%;') {return;}

		var width = parseInt(jQuery(processbar).width(),10);
		var percent = (width*1.0  / g5plus_install_demo_data.vars.width_process_bar) * 100  ;
		percent += numberAdd;
		if (percent < 90)
		{
			jQuery(processbar).css({width:  percent + '%'});
			g5plus_install_demo_data.vars.animate_loading_timeout =  setTimeout(function() {
				if (numberAdd <= 2) return;
				g5plus_install_demo_data.animate_loading(processbar, numberAdd - 2);
			},2000);
		}
		else
		{
			clearTimeout(g5plus_install_demo_data.vars.animate_loading_timeout);
		}
	}
}