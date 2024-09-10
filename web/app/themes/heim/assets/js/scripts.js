(function($) {
	
	'use strict';
	
	function HeimTheme() {
		this.init();
	};
	
	HeimTheme.prototype = {
	
		/**
		 * Initialize
		 */
		init: function() {
			var self = this;
            
            // CSS classes
            self.classMobileMenuOpen = 'mobile-menu-open';
            self.classSearchOpen = 'header-search-open';
            self.classSearchFadeOut = 'header-search-fade-out';
            self.classShopFiltersPanelOpen = 'shop-filters-open';
            self.classShopSidebarOpen = 'shop-sidebar-open';
            self.classOverlayShow = 'overlay-show';
            self.classOverlayFadeOut = 'overlay-fade-out';
            
            // Breakpoints
            self.breakpointProductGallery = ( heim_data.breakpoint_product_gallery ) ? heim_data.breakpoint_product_gallery : 1023;
            
            // Page elements
            self.$window = $(window);
            self.$document = $(document);
            self.$body = $('body');
			self.$headerCartButtonWrapper = $('#site-header-cart');
            
            // Panel
            self.panelAnimSpeed = 400;
            
            if (self.$headerCartButtonWrapper.length) {
                // Mini cart: Add body class to show cart-count when its container element changes/mutates
                var $headerCartCount = self.$headerCartButtonWrapper.children('.wc-block-mini-cart'),
                    headerCartCountObserver = new MutationObserver((mutationList, observer) => {
                        self.$body.addClass('heim-cart-count-show');
                        observer.disconnect();
                    });
                
                headerCartCountObserver.observe($headerCartCount[0], {attributes: false, childList: true, subtree: true});
                
                // Mini cart: Resfresh count (needed for cached pages)
                if (heim_data.mini_cart_count_refresh) {
                    self.miniCartRefreshCount(self.$headerCartButtonWrapper);
                }
            }
            
            // Add ":hover" support class
            if (matchMedia('(hover: hover)').matches) {
                self.$body.addClass('has-hover');
            }
            
            // Add touch device class
            if (self.isTouchDevice()) {
                self.$body.addClass('heim-has-touch');
            } else {
                self.$body.addClass('heim-no-touch');
            }
            
            self.scrollbarCalcWidth();
            
            self.bind();
            
            self.shopBind();
            
            // Shop: Filters
            self.$shopFilters = $('#heim-shop-filters');
            if (self.$shopFilters.length) {
                self.$shopFilterWidgetBlocks = $('#heim-shop-filters').children();
                self.$shopFiltersClickedButton = null;
                
                // Get URL params (used for setting active filter-widgets)
                var urlSearchParams = new URLSearchParams(window.location.search);
                self.urlParams = Object.fromEntries(urlSearchParams.entries());
                
                // Aside panel
                self.$shopFiltersPanel = $('#aside-panel-shop-filters');
                if (self.$shopFiltersPanel.length) {
                    self.$shopFiltersButtons = $('#heim-shop-toolbar-buttons');

                    self.shopFiltersPanelAddButtons();
                    self.shopFiltersPanelBind();
                }
                
                self.shopFiltersBind();
            }
            
            // Shop: Active filters - Move "clear all" button
            var $shopActiveFilters = $('#heim-shop-active-filters');
            if ($shopActiveFilters.length) {
                self.shopActiveFiltersBind($shopActiveFilters);
            }
            
            // Product page: Gallery - Do functions after WooCommerce has initialized gallery
            $('.woocommerce-product-gallery').on('wc-product-gallery-after-init', self.productGalleryInit);
            
            /* Avatars (comments): Set default */
            var $comments = $('#comments');
            if ($comments.length) {
                self.avatarsSetDefault($comments);
            }
            
            // Content: Add fade-in animation class
            if (self.$body.hasClass('has-fade-in')) {
                //self.$window.on('load', function() {
                    self.$body.addClass('fade-in');
                //});
            }
		},
		
        /**
		 * Check for touch screen support: https://stackoverflow.com/questions/4817029/whats-the-best-way-to-detect-a-touch-screen-device-using-javascript
		 */
        isTouchDevice: function() {
            return (('ontouchstart' in window) ||
                /* Returns "256" on desktop now for some reason: (navigator.maxTouchPoints > 0) ||*/
                (navigator.msMaxTouchPoints > 0));
        },
        
		/**
		 * Bind elements
		 */
		bind: function() {
			var self = this;
            
            if (self.$body.hasClass('header-sticky')) {
                var headerScrollTimer,
                    currentScrollTop,
                    lastScrollTop = self.$window.scrollTop(),
                    scrollUpDistance = 0,
                    lastScrollUpDistance = null,
                    scrollDistanceTimer,
                    $topBar = $('.woocommerce-store-notice'),
                    $header = $('#masthead'),
                    headerStart = ($topBar.length) ? Math.round($topBar.outerHeight()) : 0, // Note: Don't use offset().top since this value changes on page scroll
                    headerEnd = Math.round($header.outerHeight()) + headerStart + 250; // Added a 250 pixel tolerance since there's no need for a sticky header near the top
                
                /* Bind: Window scroll - Add classes for "sticky" header */
                window.addEventListener('scroll', function() {
                    if (headerScrollTimer) {
                        window.cancelAnimationFrame(headerScrollTimer);
                    }
                    
                    headerScrollTimer = window.requestAnimationFrame(function() {
                        currentScrollTop = self.$window.scrollTop();
                        
                        if (currentScrollTop <= headerStart) {
                            self.$body.removeClass('header-is-fixed header-is-sticky');
                        } else if (currentScrollTop > headerEnd) {
                            self.$body.addClass('header-is-fixed');
                            
                            if (currentScrollTop < lastScrollTop) {
                                // Calculate scroll speed/distance - based on: https://stackoverflow.com/a/22599173
                                if (lastScrollUpDistance != null) {
                                    scrollUpDistance = lastScrollUpDistance - currentScrollTop;
                                }
                                lastScrollUpDistance = currentScrollTop;
                                clearTimeout(scrollDistanceTimer);
                                scrollDistanceTimer = setTimeout(function() {
                                    lastScrollUpDistance = null;
                                    scrollUpDistance = 0;
                                }, 50); // Scroll needs to finish within this time, or distance will be reset
                                if (scrollUpDistance > 18) {
                                    self.$body.addClass('header-is-sticky');
                                }
                            } else {
                                self.$body.removeClass('header-is-sticky');
                            }
                        }
                        
                        lastScrollTop = currentScrollTop;
                    });
                });
            }
            
            /* Bind: Color mode switcher */
            $('.color-mode-switch').on('click', function(e) {
                e.preventDefault();
                
                // Disable in WP customizer
                if (typeof wp !== 'undefined' && wp.customize) {
                    console.log('Heim: Color mode switch disabled in WP Customizer');
                    return false;
                }
                
                self.colorModeSwitch();
            });
            
			/* Bind: Mobile menu - Button */
            $('#site-menu-button').on('click.heimMobileMenuBtn', 'a', function(e) {
				e.preventDefault();
                self.asidePanelShow(self.classMobileMenuOpen);
			});
            
            /* Bind: Mobile menu - Toggle arrows */
            $('#aside-panel-mobile-menu').on('click.heimMobileMenuToggleArrow', '.menu-item-toggle', function(e) {
                var $toggle = $(this),
                    $menuLi = $toggle.parent('li'),
                    $subMenu = $toggle.next('.sub-menu');
                
                if ($menuLi.hasClass('active')) {
                    $subMenu.slideUp(300);
                    $menuLi.removeClass('active');
                } else {
                    $subMenu.slideDown(300);
                    $menuLi.addClass('active');
                }
			});
			
            /* Bind: Search panel button */
			$('#site-header-search').children('a').on('click.heimSearchPanelBtn', function(e) {
				e.preventDefault();
                
                if (self.$body.hasClass(self.classSearchOpen)) {
                    self.searchHide();
                } else {
                    e.stopPropagation(); // Prevent click event below from triggering
                    
                    self.$body.addClass(self.classSearchOpen);
                    
                    /* Bind: Outside search panel */
                    self.$document.on('click.heimSearchOutsideClick', function(e) {
                        var $target = $(e.target);
                        if (! $target.closest('.site-search').length) {
                            self.searchHide();
                        }
                    });
                }
			});
            
            /* Bind: Aside panel close button */
            $('.aside-panel-close').on('click.heimPanelCloseBtn', 'a', function() {
                self.asidePanelHide();
                self.overlayHide();
            });
            
			/* Bind: Overlay */
            $('#overlay').on('click', function() {
                self.asidePanelHide();
                self.overlayHide();
            });
            
            /* Bind: Window resize */
			var windowResizeTimer = null;
            self.$window.on('resize', function() {
				if (windowResizeTimer) { clearTimeout(windowResizeTimer); }
				windowResizeTimer = setTimeout(function() {
                    // Browser scrollbar: Calculate width and set CSS variable - Source: https://stackoverflow.com/a/66726233
                    self.scrollbarCalcWidth();
				}, 250);
			});
		},
        
        /**
		 * Browser scrollbar: Calculate width and set CSS variable
		 */
        scrollbarCalcWidth: function() {
            document.documentElement.style.setProperty('--page--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + 'px');
        },
        
        /**
		 * Mini cart: Resfresh count (needed for cached pages)
		 */
        miniCartRefreshCount: function($headerCartButtonWrapper) {
            var $headerCartButton = $headerCartButtonWrapper.find('.wc-block-mini-cart__button'),
                headerCartButtonEvent = new Event('mouseover'),
                interval,
                intervals = 0;
            
            // Using intervals to trigger cart-button event since there's no way of knowing when the event is available
            interval = setInterval(function() {
                intervals++;
                if (intervals > 5) { clearInterval(interval); }
                $headerCartButton[0].dispatchEvent(headerCartButtonEvent);
            }, 100);
        },
        
        /**
		 * Color mode: Switch mode
		 */
        colorModeSwitch: function() {
            var self = this;
            
            // Prevent color animations when switching
            self.$body.addClass('color-mode-switched');
            
            var currentColorMode = self.$body.attr('data-color-mode'),
                newColorMode;

            if ('auto' === currentColorMode) {
                // Is the browser in "dark mode"
                newColorMode = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'light' : 'dark';
            } else {
                newColorMode = ('light' === currentColorMode) ? 'dark' : 'light';
            }

            self.$body.attr('data-color-mode', newColorMode);

            // Set/update cookie - based on: https://stackoverflow.com/a/24103596
            document.cookie = 'heim_theme_color_mode='+newColorMode+'; path=/';
            
            setTimeout(function() {
                self.$body.removeClass('color-mode-switched');
            }, self.panelAnimSpeed);
        },
        
        /**
		 * Aside panel: Show
		 */
		asidePanelShow: function(panelClass) {
			var self = this;
            self.$document.trigger('heim_aside_panel_show', panelClass);
            self.overlayShow();
            self.$body.addClass(panelClass);
		},
        
        /**
		 * Aside panel: Hide
		 */
		asidePanelHide: function() {
			var self = this;
            self.$document.trigger('heim_aside_panel_hide');
            
            // Filter-widgets panel: Close all widgets after panel is closed
            if (self.$body.hasClass(self.classShopFiltersPanelOpen)) {
                setTimeout(function() {
                    self.shopFiltersCloseWidgets();
                }, self.panelAnimSpeed);
            }
            
            self.$body.removeClass(self.classMobileMenuOpen + ' ' + self.classShopFiltersPanelOpen);
            // Close sidebar panel as well
            self.$body.removeClass(self.classShopSidebarOpen);
		},
        
        /**
		 * Overlay: Show
		 */
		overlayShow: function() {
			var self = this;
            self.$body.addClass(self.classOverlayShow);
		},
        
        /**
		 * Overlay: Hide
		 */
		overlayHide: function() {
			var self = this;
            self.$body.addClass(self.classOverlayFadeOut); // Fade out
            setTimeout(function() {
                self.$body.removeClass(self.classOverlayShow + ' ' + self.classOverlayFadeOut); // Hide
            }, self.panelAnimSpeed);
		},
        
        /**
		 * Search: Hide
		 */
		searchHide: function() {
			var self = this;
            self.$document.off('click.heimSearchOutsideClick'); // Unbind outside panel click
            self.$body.addClass(self.classSearchFadeOut); // Fade out
            setTimeout(function() {
                self.$body.removeClass(self.classSearchOpen + ' ' + self.classSearchFadeOut); // Hide
            }, self.panelAnimSpeed);
		},
        
        /*
         * Avatars (comments): Set default avatar/tag when no image is loaded
         *
         * Note: Filter-hooks has been added to remove the image width/height attributes and return a 404 error instead the default image
         */
        avatarsSetDefault: function($comments) {
            var self = this,
                $avatarImages = $comments.find('.avatar');
            
            // Based on: https://gist.github.com/draeton/1210357/734fdfe03e82b4a14014c38d0c64f249d4e4e613
            $avatarImages.one('load', function() {
                var $this = $(this);
                
                if ($this.width() == 0) {
                    // Image width is 0 after loading, replace
                    self.avatarsReplaceImage($this);
                }
            }).one('error', function() {
                var $this = $(this);
                
                // 404 error returned when loading image, replace
                self.avatarsReplaceImage($this);
            }).each(function() {
                if (this.complete) {
                    // If the image is already complete (i.e. cached), trigger the "load" event
                    $(this).trigger('load');
                }
            });
        },
        
        /*
         * Avatars (comments): Replace default "img" tag
         */
        avatarsReplaceImage: function($avatarImage) {
            var self = this,
                $authorName = (self.$body.hasClass('single-product')) ? $avatarImage.closest('.comment_container').find('.woocommerce-review__author') : $avatarImage.next('.fn'),
                authorFirstCharacter = ($authorName.length) ? $authorName.text().charAt(0) : '<i class="heim-icon-user"></i>';
            
            $avatarImage.replaceWith('<span class="avatar heim-avatar-character">' + authorFirstCharacter + '</span>');
        },
        
        /**
		 * Shop: Bind elements
		 */
        shopBind: function() {
            var self = this;
            
            /* Bind: Quantity buttons */
            self.$body.on('click', '.heim-qty', function(e) {
                e.preventDefault();
                self.quantityFieldUpdate(this);
            });
            
            /* Bind: Shop - Ordering select */
            $('.woocommerce-ordering').on('input', 'select', function() {
                var $select = $(this),
                    $selectedOption = $select.children(':selected'),
                    $wrapper = $select.closest('.woocommerce-ordering'),
                    defaultVal = $wrapper.data('select-default');
                
                if ($selectedOption.val() != defaultVal) {
                    $wrapper.addClass('is-active');
                } else {
                    $wrapper.removeClass('is-active');
                }
                
                $wrapper.attr('data-select-label', $selectedOption.text());
            });
            
            /* Bind: Shop - AJAX pagination button */
            var $ajaxPaginationButton = $('#heim-woocommerce-ajax-pagination-button');
            if ($ajaxPaginationButton.length) {
                // Add page URL data attribute for current products
                if (heim_data.shop_ajax_pagination_set_page_url !== '0') {
                    $('#main ul.products:first').children().attr('data-page-url', window.location.href);
                }
                
                $ajaxPaginationButton.on('click', function(e) {
                    e.preventDefault();
                    self.shopAjaxPaginationLoadPage(this);
                });
                
                /* Bind: Window scroll - Set shop-page URL */
                if (heim_data.shop_ajax_pagination_set_page_url !== '0' && window.history && window.history.pushState) {
                    var pageUrlScrollTimer = null;
                    self.$window.on('scroll', function() {
                        if (pageUrlScrollTimer) { clearTimeout(pageUrlScrollTimer); }
                        pageUrlScrollTimer = setTimeout(function() {
                            self.shopAjaxPaginationSetPageUrl();
                        }, 250);
                    });
                }
            }
            
            /* Bind: Checkout - Order review heading (toggle products table) */
            $('#order_review_heading').on('click', function() {
                var $orderReviewTable = $('#order_review').find('.woocommerce-checkout-review-order-table');
                
                // Make sure an the order review table isn't loading
                if ($orderReviewTable.children('.blockUI').length) {
                    return;
                }
                
                $(this).toggleClass('has-toggled-close');
                $orderReviewTable.children('tbody').toggleClass('is-hidden');
            });
            
            /* Bind: Checkout - Make sure hidden products table stays hidden after checkout is updated via Ajax */
            self.$document.on('updated_checkout', function() {
                if ($('#order_review_heading').hasClass('has-toggled-close')) {
                    $('#order_review').find('.woocommerce-checkout-review-order-table').children('tbody').addClass('is-hidden');
                }
            });
            
            /* Bind: Checkout - Coupon form */
            self.$document.on('click', '.heim-woocommerce-checkout-coupon-form-button', function(e) {
                e.preventDefault();
                self.checkoutCouponFormSubmit(this);
            });
            
            // Checkout: Override jQuery slide-toggle functions to disable animations
            if (self.$body.hasClass('woocommerce-checkout')) {
                $.fn.slideUp = function() { console.log('Heim: $.slideUp overwritten'); $(this).hide() };
                $.fn.slideDown = function() { console.log('Heim: $.slideDown overwritten'); $(this).show() };
            }
            
            /* Bind: Login/register - Toggle buttons */
            $('#heim-woocommerce-customer-login-toggle').on('click', 'a', function() {
                var $buttonLi = $(this).parent();
                $buttonLi.parent().children('.active').removeClass('active');
                $buttonLi.addClass('active');
                $('#customer_login').toggleClass('registration-active');
            });
        },
        
        /*
         * Shop - Filters panel: Add toolbar buttons
         */
        shopFiltersPanelAddButtons: function() {
            var self = this,
                $widgetBlock,
                $widget,
                $widgetTitle,
                widgetButtonId,
                widgetTitleText;

            self.$shopFilterWidgetBlocks.each(function() {
                $widgetBlock = $(this);
                $widget = $widgetBlock.children(':first');
                widgetButtonId = '#heim-shop-filter-button-'+$widgetBlock.attr('id');
                
                if ($widget.hasClass('widget-button-exclude')) {
                    $(widgetButtonId).parent('li').remove();
                    return; // = continue
                }
                
                $widgetTitle = $widget.children(':first');
                widgetTitleText = ($widgetTitle.children().length) ? $widgetTitle.children(':first').text() : $widgetTitle.text();
                
                if (widgetTitleText.length > 1) {
                    $(widgetButtonId).text(widgetTitleText);
                    $(widgetButtonId).parent('li').removeClass('is-placeholder');
                } else {
                    $(widgetButtonId).parent('li').remove();
                }
            });
        },
        
        /*
         * Shop - Filters panel: Bind events
         */
        shopFiltersPanelBind: function() {
            var self = this;
            
            /* Bind: Filter-widget "toolbar" buttons */
            self.$shopFiltersButtons.on('click', '.heim-shop-filter-button', function() {
                self.shopFiltersClickedButton = this;
                self.shopFiltersClickedButtonId = $(this).data('widget-id');
                
                self.shopFiltersPanelSetScrollPosition(false); // Arg: animate
                self.asidePanelShow(self.classShopFiltersPanelOpen);
            });
            
            /* Bind: All filters "toolbar" button */
            $('#heim-shop-aside-panel-button').on('click', function() {
                self.$shopFiltersPanel.scrollTop(0);
                self.asidePanelShow(self.classShopFiltersPanelOpen);
            });
            
            /* Bind: Filters panel - Close when page unloads */
            if (heim_data.shop_filters_panel_close_on_unload !== '0') {
                self.$window.on('beforeunload', function(e) {
                    self.asidePanelHide();
                    self.overlayHide();
                });
            }
        },
        
        /*
         * Shop - Filters panel: Set scroll position
         */
        shopFiltersPanelSetScrollPosition: function(animate) {
            var self = this,
                widgetId = $(self.shopFiltersClickedButton).data('widget-id'),
                $widget = $('#'+widgetId);
            
            self.shopFiltersOpenWidget($widget);
            
            var widgetOffsetTop = (Math.round($widget.offset().top) - self.$window.scrollTop()) + self.$shopFiltersPanel.scrollTop(),
                panelViewportHeight = self.$shopFiltersPanel.height(),
                panelViewportCenter = (panelViewportHeight - Math.round($widget.height())) / 2,
                offsetTolerance = 30,
                newScrollTop = 0;
            
            if ((widgetOffsetTop - offsetTolerance) > panelViewportCenter) {
                newScrollTop = widgetOffsetTop - panelViewportCenter; // Scroll widget to center of filters panel
            } else {
                newScrollTop = 0;
            }
            
            if (animate) {
                setTimeout(function() {
                    self.$shopFiltersPanel.animate({scrollTop: newScrollTop}, 300);
                }, self.panelAnimSpeed);
            } else {
                self.$shopFiltersPanel.scrollTop(newScrollTop);
            }
        },
        
        /*
         * Shop - Filters: Bind events
         */
        shopFiltersBind: function() {
            var self = this;
            
            /* Bind: Sidebar toggle button (shown on tablet/mobile) */
            $('#heim-shop-sidebar-button').on('click', function() {
                $('.heim-shop-sidebar').scrollTop(0);
                self.$document.trigger('heim_sidebar_panel_show', self.classShopSidebarOpen);
                self.overlayShow();
                self.$body.addClass(self.classShopSidebarOpen);
            });
            
            if (self.$shopFilters.hasClass('has-toggle')) {
                /* Bind: Filter-widget toggle */
                self.$shopFilterWidgetBlocks.find(':header:first-child:first').on('click', function() {
                    self.shopFiltersToggleWidget(this);
                });
            }
            
            /*
             * Bind: MutationObserver - After each filter-widget has loaded/mutated
             */
            var $loadingWidgets = self.$shopFilterWidgetBlocks.children('div[data-filter-type]');
            if ($loadingWidgets.length) {
                $loadingWidgets.each(function() {
                    var $loadingWidget = $(this);
                    
                    // Add "loading" class to widget's toolbar button
                    $('#heim-shop-filter-button-'+$loadingWidget.closest('.widget').attr('id')).parent().addClass('is-loading');
                    
                    var loadingWidgetsObserver = new MutationObserver((mutationList, observer) => {
                        for (let mutation of mutationList) {
                            if (mutation.type === 'childList') {
                                var $loadedWidgetTarget = $(mutation.target),
                                    $loadedWidget = $loadedWidgetTarget.closest('.widget');
                                
                                // Count mutation events and disconnect after X amount
                                var mutationEvents = ($loadedWidget.data('mutationEvents')) ? $loadedWidget.data('mutationEvents') : 1;
                                if (mutationEvents > 3) {
                                    observer.disconnect();
                                    return false;
                                }
                                mutationEvents++;
                                $loadedWidget.data('mutationEvents', mutationEvents);
                                
                                // If the widget is loading, return
                                if ($loadedWidgetTarget.find('.is-loading').length) {
                                    return false;
                                }
                                
                                var loadedWidgetId = $loadedWidget.attr('id'),
                                    $loadedWidgetToolbarButton = $('#heim-shop-filter-button-'+loadedWidgetId).parent();
                                
                                // Add "hidden" class if widget is hidden
                                setTimeout(function() {
                                    var $hiddenWidget = $loadedWidget.children().children('[hidden]');
                                    if ($hiddenWidget.length) {
                                        self.shopFilterSetHidden($loadedWidgetToolbarButton, $hiddenWidget);
                                    }
                                    
                                    // Remove "loading" class from widget's toolbar button
                                    $loadedWidgetToolbarButton.removeClass('is-loading');
                                }, 50); // Seems like some widgets (like the "stock" widget) has a "hidden" attribute on its container very briefly, so a short timeout is needed                         
                                
                                // Run once: Set widget-panel's scroll position if widget's toolbar button was clicked and panel is open
                                if (self.shopFiltersClickedButton && self.$body.hasClass(self.classShopFiltersPanelOpen)) {
                                    if (self.shopFiltersClickedButtonId == loadedWidgetId) {
                                        self.shopFiltersPanelSetScrollPosition(false);
                                        self.shopFiltersClickedButton = null; // Only run once
                                    }
                                }
                                
                                // Run once: If widget is active and toggle is enabled, add "active" class to widget
                                /*Works, but necessary? if (! $loadedWidget.hasClass('active-checked') && self.$shopFilters.hasClass('has-toggle')) {
                                    $loadedWidget.addClass('active-checked'); // Only run once
                                    self.shopFilterSetActive($loadedWidget);
                                }*/
                                
                                break; // Only run code above once per "mutation"
                            }
                        }
                    });
                    loadingWidgetsObserver.observe($loadingWidget[0], {attributes: false, childList: true, subtree: true});
                });
            }
        },
        
        /*
         * Shop - Filters: Open (no animation)
         */
        shopFiltersOpenWidget: function($widget) {
            $widget.addClass('no-anim is-open');
        },
        
        /*
         * Shop - Filters: Close all (no animation)
         */
        shopFiltersCloseWidgets: function() {
            var self = this;
            self.$shopFilters.children('.is-open').addClass('no-anim').removeClass('is-open');
        },
        
        /*
         * Shop - Filters: Toggle open/close
         */
        shopFiltersToggleWidget: function(widgetHeading) {
            $(widgetHeading).closest('.widget').removeClass('no-anim').toggleClass('is-open');
        },
        
        /*
         * Shop - Filter: Set "hidden" classes for hidden widget
         */
        shopFilterSetHidden: function($loadedWidgetToolbarButton, $hiddenWidget) {
            $loadedWidgetToolbarButton.addClass('is-hidden');
            $hiddenWidget.addClass('stay-hidden');
        },
        
        /*
         * Shop - Filter: Set "active" class
         */
        /*shopFilterSetActive: function($widgetBlock) {
            var self = this,
                $widget = $widgetBlock.children(':first');
                
                if (! $widget.hasClass('no-toggle')) {
                    var widgetType = $widget.data('filter-type'),
                        widgetActiveClass = 'is-active';
                    
                    if (widgetType == 'attribute-filter') {
                        //ALT: (check for matching input IDs): for (const param in self.urlParams) {
                            //if ($widget.find('input#'+self.urlParams[param]).length) {
                                //$widgetBlock.addClass(widgetActiveClass);
                            //}
                        //}
                        if ($widget.find('input:checked').length || $widget.find('.components-form-token-field__token').length) {
                            $widgetBlock.addClass(widgetActiveClass);
                        }
                    } else if (widgetType == 'price-filter') {
                        if (self.urlParams['min_price'] || self.urlParams['max_price']) {
                            $widgetBlock.addClass(widgetActiveClass);
                        }
                    } else if (widgetType == 'rating-filter') {
                        if (self.urlParams['rating_filter']) {
                            $widgetBlock.addClass(widgetActiveClass);
                        }
                    } else if (widgetType == 'stock-filter') {
                        if (self.urlParams['filter_stock_status']) {
                            $widgetBlock.addClass(widgetActiveClass);
                        }
                    }
                }
        },*/
        
        /*
         * Shop - Active filters: Move "clear all" button
         */
        shopActiveFiltersMoveButton: function($shopActiveFilters, shopActiveFiltersObserver) {
            if (! $shopActiveFilters.find('.wc-block-active-filters--loading').length) {
                var $activeFiltersClearButton = $shopActiveFilters.find('.wc-block-active-filters__clear-all'),
                    $activeFiltersList = $activeFiltersClearButton.prev('.wc-block-active-filters__list');

                if ($activeFiltersClearButton.length && $activeFiltersList.length) {
                    $activeFiltersClearButton.detach();
                    setTimeout(function() { // Using a small timeout to make sure the button is appended after the other appending elements
                        if ($activeFiltersList.find('.wc-block-active-filters__list-item').length == 1) {
                            $shopActiveFilters.addClass('single-active-filter');
                        }
                        $activeFiltersList.append($activeFiltersClearButton);
                    }, 200);
                }

                if (shopActiveFiltersObserver) {
                    shopActiveFiltersObserver.disconnect();
                }
            }
        },
        
        /*
         * Shop - Active filters: Bind
         */
        shopActiveFiltersBind: function($shopActiveFilters) {
            var self = this;
            
            // Try moving button before binding MutationObserver in case active filters have already loaded
            self.shopActiveFiltersMoveButton($shopActiveFilters, null);
            
            // Bind MutationObserver on active filters wrapper
            var shopActiveFiltersObserver = new MutationObserver((mutationList, observer) => {
                self.shopActiveFiltersMoveButton($shopActiveFilters, shopActiveFiltersObserver);
            });
            shopActiveFiltersObserver.observe($shopActiveFilters[0], {attributes: false, childList: true, subtree: true});
        },
        
        /*
         * Shop - AJAX pagination: Load page
         */
        shopAjaxPaginationLoadPage: function(button) {
            var self = this,
                $nextPageLink = $('.woocommerce-pagination').find('a.next');

            if ($nextPageLink.length) {
                var nextPageUrl = $nextPageLink.attr('href'),
                    $buttonContainer = $(button).parent();

                $buttonContainer.addClass('is-loading');

                $.ajax({
                    url: nextPageUrl,
                    dataType: 'html',
                    method: 'GET',
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log('Heim: AJAX error - Pagination - ' + errorThrown);
                    },
                    complete: function() {
                        $buttonContainer.removeClass('is-loading');
                    },
                    success: function(response) {
                        var $response = $(response),
                            $newProducts = $response.find('#main ul.products:first').children('li'),
                            $newPagination = $response.find('.woocommerce-pagination'),
                            $newResultCount = $response.find('#heim-woocommerce-ajax-pagination').children('.woocommerce-result-count');
                        
                        self.$document.trigger('heim_woocommerce_ajax_pagination_before');
                        
                        // Replace default pagination
                        $('.woocommerce-pagination').replaceWith($newPagination);
                        
                        // Add data attribute with page-number for new products
                        $newProducts.attr('data-page-url', nextPageUrl);
                        
                        // Append products
                        $('#main ul.products:first').append($newProducts);
                        
                        // Replace product-count text
                        $buttonContainer.children('.woocommerce-result-count').replaceWith($newResultCount);
                        
                        if (! $('.woocommerce-pagination').find('a.next').length) {
                            $buttonContainer.addClass('is-last-page');
                        }
                        
                        // Trigger scroll so page URL can be updated
                        self.$window.trigger('scroll');
                        
                        self.$document.trigger('heim_woocommerce_ajax_pagination_after');
                    }
                });
            }
        },
        
        /*
         * Shop - AJAX pagination: Add shop-page URL to history.pushState() from first product displayed above the browser window's center
         */
        shopAjaxPaginationSetPageUrl: function() {
            var self = this,
                $products = $('#main ul.products:first').children(),
                $product,
                productOffsetTop,
                viewportCenter = Math.round(self.$window.scrollTop() + (self.$window.height() / 2));

            // Reverse loop
            for (var i = $products.length - 1; i >= 0; i--) {
                $product = $($products[i]);
                productOffsetTop = Math.round($product.offset().top);

                // Is produts above browser window's center?
                if (productOffsetTop < viewportCenter) {
                    var pageUrl = $product.data('page-url');

                    if (pageUrl) {
                        window.history.pushState(null, null, pageUrl);
                    }

                    break;
                }
            }
        },
        
        /*
         * Product page - Gallery: Get PhotoSwipe items
         *
         * Note: Based on code in "../plugins/woocommerce/assets/js/frontend/single-product.js"
         */
        productGalleryPhotoswipeGetItems: function(e) {
            var self = this,
                items = [];
            
            self.$productGalleryImages.each(function(i, el) {
                var img = $(el).find('img');
                
                if (img.length) {
                    var large_image_src = img.attr('data-large_image'),
                        large_image_w = img.attr('data-large_image_width'),
                        large_image_h = img.attr('data-large_image_height'),
                        alt = img.attr('alt'),
                        item = { alt: alt, src: large_image_src, w: large_image_w, h: large_image_h };
                    
                    items.push(item);
                }
            });

            return items;
        },
        
        /*
         * Product page - Gallery: Open PhotoSwipe
         *
         * Note: Based on code in "../plugins/woocommerce/assets/js/frontend/single-product.js"
         */
        productGalleryPhotoswipeOpen: function(e) {
            e.preventDefault();
            
            var self = $.heimTheme,
                $eventTarget = $(e.target),
                $clicked,
                items = self.productGalleryPhotoswipeGetItems();
            
            if ($eventTarget.closest('.woocommerce-product-gallery__trigger').length) {
                $clicked = self.$productGallery.find('.flex-active-slide');
            } else {
                $clicked = $eventTarget.closest('.woocommerce-product-gallery__image');
            }
            
            // Flexslider "infinite loop" fix: Subtract 1 from index since cloned gallery element/image increases its count by 1
            var index = ($clicked.index() - 1 < 0) ? $clicked.index() : $clicked.index() - 1;
            
            var options = $.extend({index: index}, wc_single_product_params.photoswipe_options ),
                photoswipe = new PhotoSwipe($('.pswp')[0], PhotoSwipeUI_Default, items, options);
            
            photoswipe.init();
        },
        
        /*
         * Product page - Gallery: Set prev/next arrows position
         */
        productGalleryArrowsSetPosition: function() {
            var self = this;
            
            // No need to set arrow position for desktop layout
            if (self.$window.width() > self.breakpointProductGallery) {
                return;
            }
            
            var thumbnailsHeight = Math.ceil(self.$productGallery.children('.flex-control-thumbs').outerHeight()),
                arrowsOffset = (thumbnailsHeight / 2);
            
            self.$productGallery.children('.flex-direction-nav').css('margin-top', '-'+arrowsOffset+'px');
        },
        
        /*
         * Product page - Gallery: Set thumbnail position
         */
        productGalleryThumbnailsSetPosition: function(slider) {
            var $container = $(slider[0]).children('.flex-control-thumbs'),
                containerHeight = Math.round($container.height()),
                containerScrollTop = $container.scrollTop(),
                $activeThumbnail = $container.find('.flex-active').parent(),
                $prevThumbnail = $activeThumbnail.prev(),
                $prevThumbnail = ($prevThumbnail.length) ? $prevThumbnail : $activeThumbnail,
                prevThumbnailOffset = Math.round($prevThumbnail.position().top),
                $nextThumbnail = $activeThumbnail.next(),
                $nextThumbnail = ($nextThumbnail.length) ? $nextThumbnail : $activeThumbnail,
                nextThumbnailOffset = Math.round($nextThumbnail.position().top),
                nextThumbnailOffsetHeight = nextThumbnailOffset + Math.round($nextThumbnail.height()),
                newScrollTop = null;
                        
            if (nextThumbnailOffsetHeight > containerHeight) { // Active or Next thumbnail is below bottom
                newScrollTop = containerScrollTop + (nextThumbnailOffsetHeight - containerHeight);
            } else if (prevThumbnailOffset < 0) { // Active or Prev thumbnail is above top
                newScrollTop = containerScrollTop - Math.abs(prevThumbnailOffset);
            }
            
            if (newScrollTop !== null) {
                $container.animate({scrollTop: newScrollTop}, 300);
            }
        },
        
        /*
         * Product page - Gallery: Init
         */
        productGalleryInit: function(event, productGallery, wc_single_product_params) {
            var self = $.heimTheme; // Can't use "this" since it refers to the "wc-product-gallery-after-init" event
            
            self.$productGallery = $(productGallery);
            self.$productGalleryImages = self.$productGallery.find('.woocommerce-product-gallery__image:not(.clone)');
            
            // Remove "woocommerce-product-gallery__image" class from cloned images - otherwise variation images are set on the hidden cloned image
            self.$productGallery.find('.clone').removeClass('woocommerce-product-gallery__image');
            
            if (self.$productGalleryImages.length > 1) {
                // Arrows
                setTimeout(function() { // Let Flexslider layout complete
                    self.productGalleryArrowsSetPosition();
                }, 100);
                
                // Arrows - Bind: Set position after resize
                var galleryResizeTimer = null;
                self.$window.on('resize', function() {
                    if (galleryResizeTimer) { clearTimeout(galleryResizeTimer); }
                    galleryResizeTimer = setTimeout(function() {
                        self.productGalleryArrowsSetPosition();
                    }, 250);
                });
                
                // Flexslider: Get gallery instance and use "before" callback to set thumbnail position when needed
                //
                // Note: Using the "before" callback since "after" runs after every CSS animation (including arrows hover)
                var galleryData = self.$productGallery.data('flexslider');
                if (galleryData) {
                    galleryData.vars.before = function(slider) {
                        if (self.$window.width() < self.breakpointProductGallery) { // No need to set thumbnail position for mobile layout
                            return;
                        }
                        setTimeout(function() { // Wait for "active" thumbnail class change
                            self.productGalleryThumbnailsSetPosition(slider);
                        }, 100);
                    };
                }
            }
            
            // PhotoSwipe: Custom gallery instance that works with Flexslider's infinite loop
            //
            // Note: Based on code in "../plugins/woocommerce/assets/js/frontend/single-product.js"
            if (self.$productGalleryImages.length > 0) {
                self.$productGallery.prepend('<a href="#" class="woocommerce-product-gallery__trigger">🔍</a>');
                
                // Bind; Gallery "zoom" button */
                self.$productGallery.on('click', '.woocommerce-product-gallery__trigger', self.productGalleryPhotoswipeOpen);
                
                // Bind/unbind: Gallery image-links click
                self.$productGallery.off('click', '.woocommerce-product-gallery__image a'); // Unbind default WooCommerce event
                self.$productGallery.on('click', '.woocommerce-product-gallery__image a', self.productGalleryPhotoswipeOpen);
            }
        },
        
        /*
         * Quantity field: Update
         */
        quantityFieldUpdate: function(qtyButton) {
            var $qtyButton = $(qtyButton),
                $qtyInput  = $qtyButton.closest('.quantity').find('.qty'),
                currentVal = parseFloat($qtyInput.val()),
                max		   = parseFloat($qtyInput.attr('max')),
                min		   = parseFloat($qtyInput.attr('min')),
                step	   = $qtyInput.attr('step');

            // Format values
            if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
            if (max === '' || max === 'NaN') max = '';
            if (min === '' || min === 'NaN') min = 0;
            if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;
            
            // Update input value
            if ($qtyButton.hasClass('heim-qty-plus')) {
                if (max && (max == currentVal || currentVal > max)) {
                    $qtyInput.val(max);
                } else {
                    $qtyInput.val(currentVal + parseFloat(step));
                }
            } else {
                if (min && (min == currentVal || currentVal < min)) {
                    $qtyInput.val(min);
                } else if (currentVal > 0) {
                    $qtyInput.val(currentVal - parseFloat(step));
                }
            }
            
            $qtyInput.trigger('change');
        },
        
        /*
         * Checkout - Coupon form: Submit
         *
         * Based on "wc_checkout_coupons.submit()" function in "../plugins/woocommerce/assets/js/frontend/checkout.js" file
         */
        checkoutCouponFormSubmit: function(submitButton) {
            var $couponFormWrapper = $(submitButton).closest('.heim-woocommerce-checkout-coupon'),
                data = {
                    security: wc_checkout_params.apply_coupon_nonce,
                    coupon_code: $couponFormWrapper.find('#coupon_code').val(),
                };
            
            $couponFormWrapper.children('td').children('[role=alert]').remove(); // Remove any previous message in the coupon form
            
            $.ajax({
                type: 'POST',
                url: wc_checkout_params.wc_ajax_url.toString().replace('%%endpoint%%', 'apply_coupon'),
                data: data,
                success: function(message) {
                    if (message) {
                        $('#main').find('.entry-content > .woocommerce').children('.woocommerce-message').remove(); // Remove any "success" messages at the top of the page
                        $couponFormWrapper.children('td').prepend(message);
                        
                        var timeout = ( $(message).hasClass('woocommerce-message') ) ? 1000 : 0;
                        setTimeout(function() { // Let the "success" message display for a moment
                            $(document.body).trigger('applied_coupon_in_checkout', [data.coupon_code]);
                            $(document.body).trigger('update_checkout', { update_shipping_method: false });
                        }, timeout);
                    }
                },
                dataType: 'html'
            });
        }
	};
    
    /**
     * Document ready - ".ready()" doesn't work with nested ".load()" functions in jQuery 3.0+
     *
     * Source: http://stackoverflow.com/questions/9899372/pure-javascript-equivalent-to-jquerys-ready-how-to-call-a-function-when-the/9899701#9899701
     */
    $.heimReady = function(fn) {
        // See if DOM is already available
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            // Call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    };
    
    $.heimReady(function() {
		// Initialize script
		$.heimTheme = new HeimTheme();
	});
    
    /*
     * WooCommerce $.scroll_to_notices function: Override to improve scroll position
     *
     * Code from "../plugins/woocommerce/assets/js/frontend/woocommerce.js" file
     */
    $(function() {
        $.scroll_to_notices = function($notice) {
            if ($notice.length) {
                var $body = $('body'),
                    pageScrollTop = Math.round($('html, body').scrollTop()),
                    headerOffset = ($body.hasClass('header-sticky')) ? Math.round($('#masthead').height()) : 0,
                    noticeOffsetTop = Math.round($notice.offset().top);
                
                if ((pageScrollTop + headerOffset) > noticeOffsetTop) {
                    var newScrollTopOffset = ($body.hasClass('header-sticky')) ? 10 : 30;
                    
                    $('html, body').animate({
                        scrollTop: (noticeOffsetTop - (headerOffset + newScrollTopOffset))
                    }, 600);
                }
            }
        };
    });
	
})(jQuery);
