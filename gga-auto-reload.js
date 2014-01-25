	jQuery(document).ready(function() {
		setTimeout(gga_auto_reload_reloadOnNewVersion, 250);
	});

	window.onbeforeunload = function(e) {
		gga_auto_reload_setNewVersion();
	}

	function gga_auto_reload_setNewVersion() {
		jQuery.ajax({
			async: false, 
			url: gga_all_browsers_auto_reload.admin_ajax,
			type: 'POST',
			data: { 'action': 'gga_all_browsers_auto_reload', 'new':1 }
		}).done(function(results) { });
	}

	function gga_auto_reload_reloadOnNewVersion() {

		jQuery.post(gga_all_browsers_auto_reload.admin_ajax, { 'action':'gga_all_browsers_auto_reload' }, function(results) {

			if (gga_all_browsers_auto_reload.version == '')
				gga_all_browsers_auto_reload.version = results;
			else if (gga_all_browsers_auto_reload.version != results) {
				window.onbeforeunload = null;
				window.location.reload(true);
			}

			console.log(gga_all_browsers_auto_reload.version);

			setTimeout(gga_auto_reload_reloadOnNewVersion, 250);
		}, 'text');

	}
