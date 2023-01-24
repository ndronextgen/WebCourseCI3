var KTAppOptions = {
	colors: {
		state: {
			brand: "#366cf3",
			light: "#ffffff",
			dark: "#282a3c",
			primary: "#5867dd",
			success: "#34bfa3",
			info: "#36a3f7",
			warning: "#ffb822",
			danger: "#fd3995",
		},
		base: {
			label: ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
			shape: ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"],
		},
	},
};

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(";");
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == " ") {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

const toBase64 = (file) =>
	new Promise((resolve, reject) => {
		const reader = new FileReader();
		reader.readAsDataURL(file.files[0]);
		let fullPath = file.value;
		let filename = null;
		if (fullPath) {
			var startIndex =
				fullPath.indexOf("\\") >= 0
					? fullPath.lastIndexOf("\\")
					: fullPath.lastIndexOf("/");
			filename = fullPath.substring(startIndex);
			if (filename.indexOf("\\") === 0 || filename.indexOf("/") === 0) {
				filename = filename.substring(1);
			}
		}
		reader.onload = () => {
			let response = {
				context: reader.result,
				file_name: filename,
			};
			resolve(response);
		};
		reader.onerror = (error) => reject(error);
	});

// appAlert
(function (define) {
	define(["jquery"], function ($) {
		return (function () {
			var appAlert = {
				info: info,
				success: success,
				warning: warning,
				error: error,
				options: {
					container: "body", // append alert on the selector
					duration: 0, // don't close automatically,
					showProgressBar: true, // duration must be set
					clearAll: true, //clear all previous alerts
					animate: true, //show animation
				},
			};

			return appAlert;

			function info(message, options) {
				this._settings = _prepear_settings(options);
				this._settings.alertType = "info";
				_show(message);
				return "#" + this._settings.alertId;
			}

			function success(message, options) {
				this._settings = _prepear_settings(options);
				this._settings.alertType = "success";
				_show(message);
				return "#" + this._settings.alertId;
			}

			function warning(message, options) {
				this._settings = _prepear_settings(options);
				this._settings.alertType = "warning";
				_show(message);
				return "#" + this._settings.alertId;
			}

			function error(message, options) {
				this._settings = _prepear_settings(options);
				this._settings.alertType = "error";
				_show(message);
				return "#" + this._settings.alertId;
			}

			function _template(message) {
				var className = "info";
				if (this._settings.alertType === "error") {
					className = "danger";
				} else if (this._settings.alertType === "success") {
					className = "success";
				} else if (this._settings.alertType === "warning") {
					className = "warning";
				}

				if (this._settings.animate) {
					className += " animate";
				}

				return (
					'<div id="' +
					this._settings.alertId +
					'" class="app-alert alert alert-' +
					className +
					' alert-dismissible alert-fixed" role="alert">' +
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
					'<div class="app-alert-message alert-text">' +
					message +
					"</div>" +
					'<div class="progress">' +
					'<div class="progress-bar progress-bar-' +
					className +
					' hide" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
					"</div>" +
					"</div>" +
					"</div>"
				);
			}

			function _prepear_settings(options) {
				if (!options) var options = {};
				options.alertId = "app-alert-" + _randomId();
				return (this._settings = $.extend({}, appAlert.options, options));
			}

			function _randomId() {
				var id = "";
				var keys = "abcdefghijklmnopqrstuvwxyz0123456789";
				for (var i = 0; i < 5; i++)
					id += keys.charAt(Math.floor(Math.random() * keys.length));
				return id;
			}

			function _clear() {
				if (this._settings.clearAll) {
					$(".app-alert[role='alert']").remove();
				}
			}

			function _show(message) {
				_clear();
				var container = $(this._settings.container);
				if (container.length) {
					if (this._settings.animate) {
						//show animation
						setTimeout(function () {
							$(".app-alert").animate(
								{
									opacity: 1,
									right: "40px",
								},
								500,
								function () {
									$(".app-alert").animate(
										{
											right: "15px",
										},
										300
									);
								}
							);
						}, 20);
					}

					$(this._settings.container).prepend(_template(message));
					_progressBarHandler();
				} else {
					console.log("appAlert: container must be an html selector!");
				}
			}

			function _progressBarHandler() {
				if (this._settings.duration && this._settings.showProgressBar) {
					var alertId = "#" + this._settings.alertId;
					var $progressBar = $(alertId).find(".progress-bar");

					$progressBar.removeClass("hide").width(0);
					var css = "width " + this._settings.duration + "ms ease";
					$progressBar.css({
						WebkitTransition: css,
						MozTransition: css,
						MsTransition: css,
						OTransition: css,
						transition: css,
					});

					setTimeout(function () {
						if ($(alertId).length > 0) {
							$(alertId).remove();
						}
					}, this._settings.duration);
				}
			}
		})();
	});
})(function (d, f) {
	window["appAlert"] = f(window["jQuery"]);
});

function validateForm(form, customSubmit) {
	//add custom method
	$.validator.addMethod(
		"greaterThanOrEqual",
		function (value, element, params) {
			var paramsVal = params;
			if (params && (params.indexOf("#") === 0 || params.indexOf(".") === 0)) {
				paramsVal = $(params).val();
			}
			if (!/Invalid|NaN/.test(new Date(value))) {
				return (
					new Date(convertDateToYMD(value)) >=
					new Date(convertDateToYMD(paramsVal))
				);
			}
			return (
				(isNaN(value) && isNaN(paramsVal)) || Number(value) >= Number(paramsVal)
			);
		},
		"Must be greater than {0}."
	);

	//add custom method
	$.validator.addMethod(
		"greaterThan",
		function (value, element, params) {
			var paramsVal = params;
			if (params && (params.indexOf("#") === 0 || params.indexOf(".") === 0)) {
				paramsVal = $(params).val();
			}
			if (!/Invalid|NaN/.test(new Number(value))) {
				return new Number(value) > new Number(paramsVal);
			}
			return (
				(isNaN(value) && isNaN(paramsVal)) || Number(value) > Number(paramsVal)
			);
		},
		"Must be greater than."
	);

	//add custom method
	$.validator.addMethod(
		"mustBeSameYear",
		function (value, element, params) {
			var paramsVal = params;
			if (params && (params.indexOf("#") === 0 || params.indexOf(".") === 0)) {
				paramsVal = $(params).val();
			}
			if (!/Invalid|NaN/.test(new Date(convertDateToYMD(value)))) {
				var dateA = new Date(convertDateToYMD(value)),
					dateB = new Date(convertDateToYMD(paramsVal));
				return dateA && dateB && dateA.getFullYear() === dateB.getFullYear();
			}
		},
		"The year must be same for both dates."
	);

	$(form).validate({
		submitHandler: function (form) {
			if (customSubmit) {
				customSubmit(form);
			} else {
				return true;
			}
		},
		highlight: function (element) {
			$(element).closest(".form-control").addClass("is-invalid");
		},
		unhighlight: function (element) {
			$(element).closest(".form-control").removeClass("is-invalid");
		},
		errorElement: "span",
		errorClass: "invalid-feedback",
		ignore: ":hidden:not(.validate-hidden)",
		focusInvalid: true,
		errorPlacement: function (error, element) {
			if (element.parent(".input-group").length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		},
	});
	//handeling the hidden field validation like select2
	$(".validate-hidden").on("click", function () {
		$(this)
			.closest(".form-group")
			.removeClass("has-error")
			.find(".invalid-feedback")
			.hide();
	});
}

jQuery(document).ready(function () {
	$.ajaxSetup({ cache: false });

	$("body").on("click", "[data-act=ajax-modal]", function () {
		var data = { ajaxModal: 1 },
			url = $(this).attr("data-url"),
			isLargeModal = $(this).attr("data-modal-lg"),
			isXLargeModal = $(this).attr("data-modal-xl"),
			title = $(this).attr("data-title");
		if (!url) {
			console.log("Ajax Modal: Set data-action-url!");
			return false;
		}
		if (title) {
			$("#ajaxModalTitle").html(title);
		} else {
			$("#ajaxModalTitle").html($("#ajaxModalTitle").attr("data-title"));
		}

		if (isXLargeModal === "1") {
			$("#ajaxModal").find(".modal-dialog").addClass("modal-xl");
		} else if (isLargeModal === "1") {
			$("#ajaxModal").find(".modal-dialog").addClass("modal-lg");
		}

		$("#ajaxModalContent").html($("#ajaxModalOriginalContent").html());
		$("#ajaxModalContent")
			.find(".original-modal-body")
			.removeClass("original-modal-body")
			.addClass("modal-body");
		$("#ajaxModal").modal({
			show: true,
			backdrop: "static",
			keyboard: false,
		});

		$(this).each(function () {
			$.each(this.attributes, function () {
				if (this.specified && this.name.match("^data-post-")) {
					var dataName = this.name.replace("data-post-", "");
					data[dataName] = this.value;
				}
			});
		});
		ajaxModalXhr = $.ajax({
			url: url,
			data: data,
			cache: false,
			type: "POST",
			success: function (response) {
				$("#ajaxModal").find(".modal-dialog").removeClass("mini-modal");

				$("#ajaxModalContent").html(response);
			},
			statusCode: {
				404: function () {
					$("#ajaxModalContent")
						.find(".modal-body")
						.html("<p class='text-center'>404: Page not found.</p>");
				},
			},
			error: function () {
				$("#ajaxModalContent")
					.find(".modal-body")
					.html("<p class='text-center'>500: Internal Server Error.</p>");
			},
		});
		return false;
	});

	//abort ajax request on modal close.
	$("#ajaxModal").on("hidden.bs.modal", function (e) {
		ajaxModalXhr.abort();
		$("#ajaxModal").find(".modal-dialog").removeClass("modal-xl");
		$("#ajaxModal").find(".modal-dialog").removeClass("modal-lg");
		$("#ajaxModal").find(".modal-dialog").addClass("mini-modal");

		$("#ajaxModalContent").html("");
	});
});
