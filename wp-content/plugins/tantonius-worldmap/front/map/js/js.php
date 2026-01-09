<script>
	class TantoniusWorldMap {

		constructor() {
			this.screenWidth = jQuery(window).outerWidth();
			this.screenHeight = jQuery(window).outerHeight();
			this.dataArray = <?php echo (json_encode(TantoniusMap::activeCountries())); ?>;
			this.initialize(this);
			// this.panZoomInstance = undefined;
			this.initializeEvents(this);
			this.enableOpenCountryPageClick = false;
		}

		/**
		 * 
		 */
		initialize(thisObj) {
			thisObj.screenWidth = jQuery(window).outerWidth();
			thisObj.screenHeight = jQuery(window).outerHeight();

			let dblClickZoomEnabled = (thisObj.screenWidth >= 768) ? true : false;


			let position = thisObj.getMapPostisionAndZoom(thisObj);
			thisObj.panZoomInstance = undefined

			thisObj.panZoomInstance = svgPanZoom('.destinations-map svg', {
				zoomEnabled: true,
				controlIconsEnabled: true,
				fit: true,
				center: false,
				minZoom: 0.1,
				dblClickZoomEnabled: dblClickZoomEnabled,
				preventMouseEventsDefault: true,
			});

			if (thisObj.panZoomInstance) {
				thisObj.panZoomInstance.pan({
					x: position.x,
					y: position.y
				});
				thisObj.panZoomInstance.zoom(position.zoomLevel)
			}

		}

		getMapPostisionAndZoom(thisObj) {
			var worldMapWrapperWidth = jQuery('.map-control-buttons').width();
			let ratio = parseFloat(thisObj.screenWidth / thisObj.screenHeight);
			//alert(thisObj.screenWidth + ' '+ thisObj.screenHeight)

			let x = 0;
			let y = 0;
			let zoomLevel = 1;

			// mobile
			if (thisObj.screenWidth < 768) {
				zoomLevel = 0.8;
				x = -65;
			}

			// Tablets
			if (thisObj.screenWidth > 800 && thisObj.screenWidth < 900) {
				x = -65;
				zoomLevel = 0.8;
			}

			// Desktops
			if (thisObj.screenWidth >= 1200) {
				x = 50;
				zoomLevel = 1.3;
				y = -83;
			}

			if (thisObj.screenWidth >= 1300) {
				x = 100;
				zoomLevel = 1.2;
				y = -80;
			}

			if (thisObj.screenWidth >= 1500) {
				x = 200;
				zoomLevel = 1.5;
				y = -80;
			}


			// Iphone SE
			if (thisObj.screenWidth == 320 && thisObj.screenHeight == 568) {
				x = -118;
			}
			// Ipad Mini
			if (thisObj.screenWidth == 768 && thisObj.screenHeight == 948) {
				x = 55;
			}
			// Galaxy Tab S7
			if (thisObj.screenWidth == 800 && thisObj.screenHeight == 1195) {
				x = 150
			}

			if (x == 0) {
				x = (ratio > 0.7) ? 0 : -1 * parseInt(worldMapWrapperWidth / 2);
			}

			let params = {
				x: x,
				y: y,
				zoomLevel: zoomLevel
			};
			//console.log('screen width + height ' + thisObj.screenWidth + ' '+ thisObj.screenHeight)
			//console.log('ratios ' + thisObj.screenWidth / thisObj.screenHeight+ ' '+ thisObj.screenHeight/thisObj.screenWidth )
			//console.log(params);
			return params;

		}

		initializeEvents(thisObj) {
			jQuery(window).on("resize", function() {
				window.location.reload();
			});
			jQuery(".map-control-buttons svg").on("click tap touchstart", "g[id]:not(.svg-pan-zoom_viewport)", function() {
				//console.log('zoom ' + thisObj.panZoomInstance.getZoom())
				//console.log('pan ')
				//console.log(thisObj.panZoomInstance.getPan())
				//console.log('size ')
				//console.log(thisObj.panZoomInstance.getSizes())
				thisObj.openCountryInfo(this, thisObj);
			})


			jQuery('.destinations-map').on('touchmove', function(e) {
				e.preventDefault();
			});



			jQuery('.info-box .close').on('click', function() {
				jQuery('.info-box').toggle();
			});


			jQuery('.tantoniusWorldMapLink').on('click', function(e) {
				e.preventDefault();
				thisObj.openCountryPage(this, thisObj);
			});

			jQuery('.map-overlay').on('click', function() {
				jQuery('.info-box').toggle();
				jQuery('.map-overlay').toggle();
			})

			jQuery('#tantoniusWorldMapCountryListButton').on('click', function() {
				jQuery('.tantonius_world_map_country_list').toggle();
			})

		}



		/** 
		 * Open country info 
		 * 
		 * */
		openCountryInfo(countryArea, thisObj) {
			var posY = jQuery(countryArea).position().top - jQuery('.info-box').outerHeight() - 10;
			var posX = jQuery(countryArea).position().left - (jQuery('.info-box').outerWidth() / 2);
			var countryName = jQuery(countryArea).attr("id");

			var countryData = thisObj.dataArray.find(country => country.wm_country === countryName);
			if (countryData == undefined) {
				return;
			}

			jQuery('.info-box .content img').attr('src', countryData.wm_image_url);
			jQuery('.info-box .content a').attr('href', countryData.wm_url);
			jQuery('.info-box .country .fill').html(countryData.wm_country_title);

			var areaW = jQuery('.map-control-buttons').width() / 2;
			jQuery('.info-box').addClass('center-it');
			jQuery('.info-box').show();
			thisObj.enableOpenCountryPageClick = false;
			setTimeout(
				function() {
					thisObj.acitvateCountryClick(thisObj);
				},
				1000
			);
		}

		/**
		 * Activate country link 
		 * 
		 * With mobile we need a delay after opening the info box
		 */
		acitvateCountryClick(thisObj) {
			thisObj.enableOpenCountryPageClick = true;
		}

		/**
		 * Open country page
		 */
		openCountryPage(link, thisObj) {
			if (thisObj.enableOpenCountryPageClick) {
				let url = jQuery(link).attr('href');
				window.open(url, '_blank').focus();
			}
		}
	}
	jQuery(document).ready(function() {
		let tantoniusWorldMap = new TantoniusWorldMap();

	});
</script>